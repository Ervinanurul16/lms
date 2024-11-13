<?php

namespace App\Http\Controllers\Student;

use App\Member;
use App\Grade;
use App\Exam;
use App\ExamResult;
use App\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolMemberFormRequest;
use Illuminate\Support\Facades\Cache;
use App\Traits\HandleImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use HandleImageTrait;

    public function index(Request $request)
    {
        // Ambil filter dari permintaan
        $gradeFilter = $request->input('grade');
        $subjectFilter = $request->input('subject');

        //dd ($request->all());

        $query = DB::table('members')->select(
                'members.id',
                'members.name',
                'members.identity_number',
                'members.grade',
                DB::raw('MAX(subjects.name) as subject_name'),
                DB::raw('MAX(exams.title) as exam_title'),
                DB::raw('MAX(exam_results.total_answered_question) as total_answered_question'),
                DB::raw('MAX(exam_results.total_correct_answer) as total_correct_answer')
            )
            ->join('grades', 'grades.name', '=', 'members.grade')
            ->leftJoin('exam_results', 'exam_results.user_id', '=', 'members.id')
            ->leftJoin('exams', 'exam_results.exam_id', '=', 'exams.id')
            ->leftJoin('subjects', 'subjects.id', '=', 'exams.subject_id');
        
        // Apply grade filter if present
        if (!empty($gradeFilter)) {
            $query->where('grades.name', '=', $gradeFilter);
        }
        
        // Apply subject filter if present
        if (!empty($subjectFilter)) {
            $query->where('exams.subject_id', '=', $subjectFilter);
        }
        
        // Group by non-aggregated columns
        $murid = $query->groupBy('members.id', 'members.name', 'members.identity_number', 'members.grade')->get();
    
        // Fetch exam results with optional filters
        $exam_results = DB::table('exam_results')
            ->select('grades.name as grade', 'exams.title', DB::raw('AVG(exam_results.final_score) as averageScore'))
            ->join('users', 'exam_results.user_id', '=', 'users.id')
            ->join('grades', 'users.grade_id', '=', 'grades.id')
            ->join('exams', 'exam_results.exam_id', '=', 'exams.id')
            ->when($gradeFilter, function ($query) use ($gradeFilter) {
                return $query->where('grades.name', $gradeFilter);
            })
            ->when($subjectFilter, function ($query) use ($subjectFilter) {
                return $query->where('exams.subject_id', $subjectFilter);
            })
            ->groupBy('grades.name', 'exams.title')
            ->get();

        // Persiapkan data untuk tampilan
        $studentNames = $exam_results->pluck('user');
        $examTitle = $exam_results->pluck('title');
        $gradeName = $exam_results->pluck('grade');
        $studentScores = $exam_results->pluck('averageScore');

        // Dapatkan ID kelas jika filter kelas disetel
        $gradeId = $gradeFilter ? DB::table('grades')->where('name', $gradeFilter)->value('id') : null;

        // Ambil hasil tugas
        $task_results = DB::table('task_submissions')
                        ->select('grades.name as grade', 'tasks.name', DB::raw('AVG(task_submissions.mark) as averageMark'))
                        ->leftJoin('users', 'task_submissions.user_id', '=', 'users.id')
                        ->leftJoin('grades', 'users.grade_id', '=', 'grades.id')
                        ->leftJoin('tasks', 'task_submissions.task_id', '=', 'tasks.id')
                        ->when($gradeId, function ($query) use ($gradeId) {
                            return $query->where('grades.id', $gradeId);
                        })
                        ->when($subjectFilter, function ($query) use ($subjectFilter) {
                            return $query->where('tasks.subject_id', $subjectFilter);
                        })
                        ->groupBy('grades.id','grades.name', 'tasks.name')
                        ->get();

        // Persiapkan data tugas untuk tampilan
        $taskName = $task_results->pluck('name');
        $markScores = $task_results->pluck('averageMark');

        $skill_results = DB::table('skill_submissions')
                        ->select('skills.name', 
                            DB::raw('COUNT(skill_submissions.id) AS jumlah_siswa'),
                            DB::raw('(SUM(COALESCE(skill_submissions.indikator_1, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_2, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_3, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_4, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_5, 0))) * 4 as mark')
                        )
                        ->leftJoin('skills', 'skill_submissions.skill_id', '=', 'skills.id')
                        ->when($gradeId, function ($query) use ($gradeId) {
                            return $query->where('skill_submissions.grade_id', $gradeId);
                        })
                        ->when($subjectFilter, function ($query) use ($subjectFilter) {
                            return $query->where('skills.subject_id', $subjectFilter);
                        })
                        ->groupBy('skill_submissions.skill_id', 'skills.name')
                        ->get();

        // Persiapkan data tugas untuk tampilan
        $skillData = $skill_results->map(function ($item) {
            return [
                'name' => $item->name,
                'average_mark' => $item->mark / $item->jumlah_siswa // Hitung nilai rata-rata
            ];
        });

        // Akses nama dan nilai rata-rata
        $skillName = $skillData->pluck('name');
        $skillScores = $skillData->pluck('average_mark');

        // Ambil grade yang berbeda dari tabel members
        $grades = Member::whereNotNull('grade')->distinct()->pluck('grade');

        // Ambil mata pelajaran
        $subjects = DB::table('subjects')->select('id', 'name')->get();

        // Kembalikan tampilan dengan data yang diperlukan
        return view('admin.student.index', compact('murid', 'grades', 'gradeFilter', 'subjects', 'subjectFilter', 'studentNames', 'examTitle', 'gradeName', 'studentScores', 'taskName', 'markScores', 'skillName', 'skillScores'));
    }

    public function grafik($studentId)
    {   
        

        $student = DB::table('members')->select('members.*')->where('id', $studentId)->get();


        $subjects = DB::table('subjects')
        ->join('exams', 'subjects.id', '=', 'exams.subject_id')
        ->join('exam_results', 'exam_results.exam_id', '=', 'exams.id')
        ->where('exam_results.user_id', $studentId)
        ->select('subjects.name as subject_name')
        ->distinct()
        ->get();

        $task_results = DB::table('task_submissions')
                        ->select('mark', 'tasks.name', 'teacher_notes')
                        ->join('tasks', 'task_submissions.task_id', '=', 'tasks.id')
                        ->where('task_submissions.user_id', $studentId)
                        ->get();
        

        $taskName = $task_results->pluck('name');
        $markScores = $task_results->pluck('mark');
        $teacherNotes = $task_results->pluck('teacher_notes');

        
        $exam_results = DB::table('exam_results')
                        ->select('final_score', 'exams.title AS name')
                        ->join('exams', 'exam_results.exam_id', '=', 'exams.id')
                        ->where('exam_results.user_id', $studentId)
                        ->get();

        $examName = $exam_results->pluck('name');
        $finalScore = $exam_results->pluck('final_score');

        $skill_results = DB::table('skill_submissions')
                        ->select('skills.name', 
                            DB::raw('COUNT(skill_submissions.id) AS jumlah_siswa'),
                            DB::raw('(SUM(COALESCE(skill_submissions.indikator_1, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_2, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_3, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_4, 0)) + 
                                    SUM(COALESCE(skill_submissions.indikator_5, 0))) * 4 as mark')
                        )
                        ->leftJoin('skills', 'skill_submissions.skill_id', '=', 'skills.id')
                        ->where('skill_submissions.user_id', $studentId)
                        ->groupBy('skill_submissions.skill_id', 'skills.name')
                        ->get();

        // Persiapkan data tugas untuk tampilan
        $skillData = $skill_results->map(function ($item) {
            return [
                'name' => $item->name,
                'average_mark' => $item->mark / $item->jumlah_siswa // Hitung nilai rata-rata
            ];
        });

        // Akses nama dan nilai rata-rata
        $skillName = $skillData->pluck('name');
        $skillScores = $skillData->pluck('average_mark');

        //dd($subjects);
        return view('admin.student.grafik', compact('student','teacherNotes', 'subjects', 'taskName', 'markScores', 'examName', 'finalScore', 'skillName', 'skillScores'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(SchoolMemberFormRequest $request)
    {
        Member::create($request->all());
        
        return redirect('admin/students')->with('status', __('messages.student_data_created'));
    }

    public function edit(Member $student)
    {
        return view('admin.student.edit', compact('student'));
    }

    public function update(SchoolMemberFormRequest $request, Member $student)
    {
        $student->update($request->all());

        $user = $student->user;

        if($user)
        {
            $grade_id = Grade::where('name',$request->grade)->first()->id;

            $user->update([
                'grade_id' => $grade_id,
                'name'=> $request->name,
            ]);
        }

        return redirect('admin/students')->with('status', __('messages.student_data_updated'));
    }

    public function grafikSiswa(Request $request)
    {
        $studentId = Auth::id();
        $subjectId = $request->get('subject_id'); // Ambil mata pelajaran yang dipilih

        // Ambil data mata pelajaran
        $subjects = DB::table('subjects')->get();
        $student = DB::table('members')->select('members.*')->where('id', $studentId)->get();

        // Query untuk mendapatkan nilai tugas
        $task_results_query = DB::table('task_submissions')
            ->select('mark', 'tasks.name', 'tasks.subject_id', 'teacher_notes')
            ->join('tasks', 'task_submissions.task_id', '=', 'tasks.id')
            ->where('task_submissions.user_id', $studentId);

        // Filter berdasarkan mata pelajaran yang dipilih
        if ($subjectId) {
            $task_results_query->where('tasks.subject_id', $subjectId);
        }

        $task_results = $task_results_query->get();
        $taskName = $task_results->pluck('name');
        $markScores = $task_results->pluck('mark');
        $teacherNotes = $task_results->pluck('teacher_notes');


        // Query untuk mendapatkan nilai ujian
        $exam_results_query = DB::table('exam_results')
            ->select('final_score', 'exams.title AS name', 'exams.subject_id')
            ->join('exams', 'exam_results.exam_id', '=', 'exams.id')
            ->where('exam_results.user_id', $studentId);

        if ($subjectId) {
            $exam_results_query->where('exams.subject_id', $subjectId);
        }

        $exam_results = $exam_results_query->get();
        $examName = $exam_results->pluck('name');
        $finalScore = $exam_results->pluck('final_score');

        // Query untuk mendapatkan nilai keterampilan
        $skill_results_query = DB::table('skill_submissions')
            ->select('skills.name', 
                DB::raw('COUNT(skill_submissions.id) AS jumlah_siswa'),
                DB::raw('(SUM(COALESCE(skill_submissions.indikator_1, 0)) + 
                        SUM(COALESCE(skill_submissions.indikator_2, 0)) + 
                        SUM(COALESCE(skill_submissions.indikator_3, 0)) + 
                        SUM(COALESCE(skill_submissions.indikator_4, 0)) + 
                        SUM(COALESCE(skill_submissions.indikator_5, 0))) * 4 as mark')
            )
            ->leftJoin('skills', 'skill_submissions.skill_id', '=', 'skills.id')
            ->where('skill_submissions.user_id', $studentId)
            ->groupBy('skill_submissions.skill_id', 'skills.name');

        if ($subjectId) {
            $skill_results_query->where('skills.subject_id', $subjectId);
        }

        $skill_results = $skill_results_query->get();
        $skillData = $skill_results->map(function ($item) {
            return [
                'name' => $item->name,
                'average_mark' => $item->mark / $item->jumlah_siswa // Hitung nilai rata-rata
            ];
        });

        $skillName = $skillData->pluck('name');
        $skillScores = $skillData->pluck('average_mark');
        //dd($studentId);
        return view('student.grafik.index', compact('student','teacherNotes','subjects', 'taskName', 'markScores', 'examName', 'finalScore', 'skillName', 'skillScores', 'subjectId'));
    }

    
}