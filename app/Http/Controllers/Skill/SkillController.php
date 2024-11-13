<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Controller;
use App\LearningTopic;
use App\Skill;
use App\Subject;
use App\Grade;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Requests\SkillFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Traits\HandleSkillInputTrait;

class SkillController extends Controller
{
    use HandleSkillInputTrait;

    public function index(Request $request)
    {
        $role = Auth::user()->roles[0]->name;
        $skillId = $request->input('id');

        // Ambil filter dari request
        $filterGrade = $request->input('grade');
        $filterSubject = $request->input('subject');
        
        $user_id = Auth::id();
        
        // Query dasar
        $skills = DB::table('skills')
                    ->join('users','users.id','=','skills.user_id')
                    ->join('members','members.id','=','users.member_id')
                    ->join('subjects','subjects.id','=','skills.subject_id')
                    ->leftjoin('grades','grades.id','=','skills.grade_id')
                    ->where('user_id', $user_id);

        // Filter berdasarkan grade jika ada
        if ($filterGrade) {
            $skills->where('grades.id', $filterGrade);
        }

        // Filter berdasarkan subject jika ada
        if ($filterSubject) {
            $skills->where('subjects.id', $filterSubject);
        }

        // Eksekusi query dan ambil hasilnya
        $skills = $skills->select('skills.id','skills.deadline','skills.status','skills.user_id','skills.name as skill_name','subjects.name as subject','users.name', 'grades.name as grade', 'members.identity_number as identity_number')
                        ->get();

        // Ambil data untuk dropdown filter
        $grades = DB::table('grades')->pluck('name', 'id');
        $subjects = DB::table('subjects')->pluck('name', 'id');

        return view('admin.skill.index', compact('skills', 'grades', 'subjects'));
    }


    public function create()
    {
        $subjects = Subject::select('id','name')->get();
        $grades = Grade::select('id','name')->orderBy('grade_level')->orderBy('name')->get();
        
        // Initialize $skill as null for new skill creation
        $skill = null;

        return view('admin.skill.create', compact('skill', 'subjects', 'grades'));
    }

    public function store(Request $request)
    {
        
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'deadline' => 'required',
        ]);
        
        // Simpan data yang telah divalidasi ke dalam database
        Skill::create([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject_id'),
            'grade_id' => $request->input('grade_id'),
            'deadline' => $request->input('deadline'),
            'user_id' => Auth::id(), // Menyimpan id pengguna yang membuat skill
            'status' => 1, // Status default saat membuat skill baru
        ]);
        //dd($request->all()); // Check what data is being sent
    
        // Redirect setelah data berhasil disimpan
        return redirect()->route('skills.index')->with('status', __('Skill berhasil ditambahkan.'));
    }
    
    public function edit(Skill $skill)
    {
        $subjects = Subject::select('id','name')->get();
        $grades = Grade::select('id','name')->get();

        return view('admin.skill.edit', compact('skill','subjects', 'grades'));
    }

    public function update(SkillFormRequest $request, Skill $skill)
    {
        if($request->attachment_file != null)
        {
            Storage::delete($skill->attachment_path);
            $this->addFileRequestData($request);
        }

        $skill->update($request->all());

        return redirect('admin/skills')->with('status',__('messages.assignment_updated'));
    }

    public function destroy(Request $request)
    {
        $skill_ids = $request->skill_id;

        if($skill_ids == null){
            return back();
        }

        
        Skill::whereIn('id', $skill_ids)->delete();

        return redirect('admin/skills')->with('status', __('messages.assignment_deleted'));
    }

}
