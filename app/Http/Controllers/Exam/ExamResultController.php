<?php

namespace App\Http\Controllers\Exam;

use App\Grade;
use App\Exam;
use App\ExamResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamResultController extends Controller
{
    public function index(Exam $exam)
    {
        $exam_results = DB::table('exam_results')
                            ->join('users','exam_results.user_id','=','users.id')
                            ->join('grades','users.grade_id','=','grades.id')
                            ->where('exam_id',$exam->id)
                            ->select('exam_results.*','users.name as user','grades.name as grade')
                            ->get();
    
        $grades = $exam->grades->sort();
    
        $exam_result_count = DB::table('exam_results')
                        ->where('exam_id', $exam->id)
                        ->selectRaw("count(case when exam_results.is_remedial = 1 then 1 end) as studentFail")
                        ->selectRaw("count(case when exam_results.is_remedial = 0 then 1 end) as studentPass")
                        ->selectRaw("avg(exam_results.final_score) as averageScore")
                        ->first();
    
        // Map nama dan nilai untuk dikirim ke view dalam bentuk JSON
        $studentNames = $exam_results->pluck('user'); // Mengambil nama siswa
        $studentScores = $exam_results->pluck('final_score'); // Mengambil nilai siswa
    
        return view('admin.exam-result.index', [
            'exam' => $exam,
            'exam_results' => $exam_results,
            'grades' => $grades,
            'exam_result_count' => $exam_result_count,
            'studentNames' => json_encode($studentNames), // Mengirimkan nama siswa dalam bentuk JSON
            'studentScores' => json_encode($studentScores) // Mengirimkan nilai siswa dalam bentuk JSON
        ]);
    }
    

    public function indexByGrade(Exam $exam, Grade $grade)
    {
        $exam_results = DB::table('exam_results')
                            ->join('users','exam_results.user_id','=','users.id')
                            ->join('grades','users.grade_id','=','grades.id')
                            ->where('users.grade_id', $grade->id)
                            ->where('exam_results.exam_id', $exam->id)
                            ->select('exam_results.*','users.name as user','grades.name as grade')
                            ->get();
        $grades = $exam->grades->sort();

        $exam_result_count = DB::table('exam_results')
                        ->join('users','exam_results.user_id','=','users.id')
                        ->where('users.grade_id', $grade->id)
                        ->where('exam_results.exam_id', $exam->id)
                        ->selectRaw("count(case when exam_results.is_remedial = 1 then 1 end) as studentFail")
                        ->selectRaw("count(case when exam_results.is_remedial = 0 then 1 end) as studentPass")
                        ->selectRaw("avg(exam_results.final_score) as averageScore")
                        ->first();

        return view('admin.exam-result.index', compact('exam','exam_results','grades','exam_result_count'));
    }
    
    public function destroy(Request $request, $exam)
    {
        $exam_result_ids = $request->exam_result_id;

        if($exam_result_ids == null){
            return back();
        }

        ExamResult::whereIn('id', $exam_result_ids)->delete();

        return redirect('admin/exams/'.$exam.'/results')->with('status', __('messages.exam_result_deleted'));
    }

    public function showStudentsResponse(Exam $exam)
    {
        // Ambil semua soal dan jawaban yang benar
        $exam_questions = $exam->questions()->with(['answerChoices' => function($query) {
            $query->where('is_answer', 1); // Ambil hanya jawaban yang benar
        }])->get();

        // Ambil hasil ujian, termasuk jawaban siswa
        $exam_results = ExamResult::with(['user', 'examResponses.answerChoice'])->where('exam_id', $exam->id)->get();

        // Hitung jumlah jawaban benar untuk setiap soal
        $correctAnswerCounts = [];
        foreach ($exam_questions as $question) {
            $correctResponses = 0;

            foreach ($exam_results as $exam_result) {
                $userAnswer = $question->examResponses->where('exam_result_id', $exam_result->id)->first();
                if ($userAnswer && $userAnswer->answerChoice && $question->answerChoices->first() && $userAnswer->answerChoice->label == $question->answerChoices->first()->label) {
                    $correctResponses++; // Jawaban benar
                }
            }

            // Simpan jumlah jawaban benar per soal
            $correctAnswerCounts[$question->id] = $correctResponses;
        }

        $grades = $exam->grades;

        // Kirim data jumlah jawaban benar dan soal ke view
        return view('admin.exam-result.show', compact('exam', 'exam_questions', 'exam_results', 'grades', 'correctAnswerCounts'));
    }

    
    
    

    public function showStudentsResponseByGrade(Exam $exam, Grade $grade)
    {
        // $exam_questions = $exam->question;
        // $exam_responses = $exam->examResponses;

        // return view('admin.exam-result.show', compact('exam','exam_questions','exam_responses'));
    }
}
