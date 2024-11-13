<?php

namespace App\Http\Controllers\Skill;

use App\Skill;
use App\SkillSubmission;
use App\LearningTopic;
use App\Grade;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SkillSubmissionController extends Controller
{
    public function index(Skill $skill, $grade_id = null)
    {
        $data = json_decode($skill, true);
        $grade_id = $data['grade_id'];
        $skill_id = $data['id'];
        //echo $skill_id;
        $grade = null;
        $submissions = DB::table('users')
                        ->select(
                            'users.*',
                            'grades.name as grade',
                            'members.identity_number',
                            DB::raw("
                                CASE 
                                    WHEN skill_submissions.skill_id = $skill_id THEN 
                                        (COALESCE(skill_submissions.indikator_1, 0) + 
                                        COALESCE(skill_submissions.indikator_2, 0) + 
                                        COALESCE(skill_submissions.indikator_3, 0) + 
                                        COALESCE(skill_submissions.indikator_4, 0) + 
                                        COALESCE(skill_submissions.indikator_5, 0)) * 4
                                    ELSE 0 
                                END as mark
                            ")
                        )
                        ->leftJoin('members', 'members.id', '=', 'users.member_id')
                        ->leftJoin('grades', 'users.grade_id', '=', 'grades.id')
                        ->leftJoin('skill_submissions', 'skill_submissions.user_id', '=', 'users.id')
                        ->where('users.grade_id', '=', $grade_id)
                        ->get();

        $grades = Grade::select('name')->get();
        
        return view('admin.skill-submission.index', compact('skill', 'grades', 'grade', 'submissions','skill_id'));
    }

    public function show(Request $request, $submission_id, $submission_id2)
    {
        $skill_id = $submission_id2;
    
        // Ambil data submission yang dibutuhkan
        $submission = DB::table('users')
            ->leftjoin('skill_submissions', 'skill_submissions.user_id', '=', 'users.id')
            ->leftjoin('skills', 'skill_submissions.skill_id', '=', 'skills.id')
            ->leftjoin('grades', 'users.grade_id', '=', 'grades.id')
            ->where('users.id', '=', $submission_id)
            ->select(
                'skill_submissions.id',
                'skill_submissions.indikator_1',
                'skill_submissions.indikator_2',
                'skill_submissions.indikator_3',
                'skill_submissions.indikator_4',
                'skill_submissions.indikator_5',
                'skills.name as skill',
                'users.name as user',
                'grades.name as grade',
                'users.grade_id',
                'users.id as user_id'
            )
            ->first();
    
        // Ambil data mata pelajaran (subjects)
       // Coba dengan satu join saja terlebih dahulu
        $subjects = DB::table('subjects')
        ->join('skills', 'skills.subject_id', '=', 'subjects.id')
        ->select('subjects.name as subject_name')
        ->first();

         //dd($subjects);


        // dd($submission->id);
        return view('admin.skill-submission.show', compact('submission', 'skill_id', 'subjects'));
    }
    

    public function store(Request $request, SkillSubmission $submission)
    {
        // Validasi input seperti sebelumnya
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grade_id' => 'required|exists:grades,id',
            'skill_id' => 'required|exists:skills,id',
            'indikator_1' => 'required',
            'indikator_2' => 'required',
            'indikator_3' => 'required',
            'indikator_4' => 'required',
            'indikator_5' => 'required',
        ]);

        DB::transaction(function() use ($request) {
            // Gunakan firstOrCreate untuk membuat atau mencari entri
            $submission = SkillSubmission::firstOrCreate(
                [
                    'user_id' => $request->input('user_id'),
                    'skill_id' => $request->input('skill_id')
                ],
                [
                    'grade_id' => $request->input('grade_id'),
                    'indikator_1' => $request->input('indikator_1'),
                    'indikator_2' => $request->input('indikator_2'),
                    'indikator_3' => $request->input('indikator_3'),
                    'indikator_4' => $request->input('indikator_4'),
                    'indikator_5' => $request->input('indikator_5')
                ]
            );

            // Jika entri sudah ada, update dengan nilai baru
            $submission->update([
                'grade_id' => $request->input('grade_id'),
                'indikator_1' => $request->input('indikator_1'),
                'indikator_2' => $request->input('indikator_2'),
                'indikator_3' => $request->input('indikator_3'),
                'indikator_4' => $request->input('indikator_4'),
                'indikator_5' => $request->input('indikator_5')
            ]);
        });

        // Redirect setelah data disimpan atau diupdate
        return redirect('admin/skills/'.$request->input('skill_id').'/submissions')
            ->with('status', __('messages.assignment_score_added'));
    }

    


    public function destroy(Request $request)
    {
        $submission_ids = $request->submission_id;

        if($submission_ids == null){
            return back();
        }

        $submission_path = SkillSubmission::whereIn('id', $submission_ids)->pluck('submission_path')->all();

        for($i=0;$i<count($submission_path);$i++)
        {
            if($submission_path[$i] != null)
            {
                Storage::delete($submission_path[$i]);
            }
        }

        SkillSubmission::whereIn('id', $submission_ids)->delete();

        return back()->with('status', __('messages.assignment_submission_deleted'));
    }
}
