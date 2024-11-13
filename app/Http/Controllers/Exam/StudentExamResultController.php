<?php

namespace App\Http\Controllers\Exam;

use App\ExamResult;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Subject;
use Illuminate\Http\Request;



class StudentExamResultController extends Controller
{
    public function index(Request $request)
{
    $user_id = Auth::id();
    $subjectId = $request->get('subject_id');

    // Query untuk mendapatkan semua mata pelajaran
    $subjects = Subject::all();

    // Query untuk mendapatkan hasil ujian
    $exam_results_query = ExamResult::with('exam.subject', 'exam')
                                    ->where('user_id', $user_id);

    // Jika mata pelajaran dipilih, filter berdasarkan mata pelajaran tersebut
    if ($subjectId) {
        $exam_results_query->whereHas('exam.subject', function($query) use ($subjectId) {
            $query->where('id', $subjectId);
        });
    }

    // Ambil hasil ujian berdasarkan filter yang diterapkan
    $exam_results = $exam_results_query->get();

    // Data untuk grafik
    $chartData = null;
    if ($subjectId && $exam_results->isNotEmpty()) {
        $labels = [];
        $data = [];

        // Ambil data untuk grafik (nama ujian dan nilainya)
        foreach ($exam_results as $exam_result) {
            $labels[] = $exam_result->exam->title; // Nama ujian
            $data[] = $exam_result->score; // Nilai
        }

        $chartData = [
            'labels' => $labels,
            'data' => $data
        ];
    }

    return view('student.exam-result.index', compact('exam_results', 'subjects', 'chartData'));
}


    public function show(ExamResult $exam_result)
    {
        if($exam_result->correction_status == 1)
        {
            return redirect('student/exams/'.$exam_result->exam->id.'/results')->with('status', __('messages.correction_change_notice'));
        }

        $exam_questions = $exam_result->exam->questions;
        $exam_responses = $exam_result->examResponses;

        $exam_question_raw = \App\ExamQuestion::with('basicCompetency')->where('exam_id',$exam_result->exam_id)->orderBy('number')->get();

        return view('student.exam-response.index', compact('exam_result','exam_questions','exam_responses','exam_question_raw'));
    }
    
}
