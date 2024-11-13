<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Exam;
use App\ExamResponse;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    public function index()
    {
        // Mengambil data ujian dan mengecek apakah siswa sudah mengerjakan
        $exams = Exam::with('subject', 'user')
                     ->where('status', 1)
                     ->orderBy('created_at', 'desc')
                     ->get();
    
        // Cek apakah siswa sudah mengerjakan ujian
        $completedExams = ExamResponse::where('user_id', Auth::id())->pluck('exam_id')->toArray(); 
    
        return view('student.exam.index', compact('exams', 'completedExams'));
    }
    
    
}
