<?php

namespace App\Http\Controllers\Task;

use App\TaskSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Subject;



class StudentTaskSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $subjectId = $request->get('subject_id');
    
        // Query TaskSubmission dengan filter berdasarkan subject_id jika ada
        $query = TaskSubmission::with(['user', 'task.learningTopic', 'task.subject'])
                    ->whereUserId(Auth::id());
    
        if ($subjectId) {
            $query->whereHas('task.subject', function($q) use ($subjectId) {
                $q->where('id', $subjectId);
            });
        }
    
        $submissions = $query->get();
        $subjects = Subject::all();
    
        // Cek jika ada data submissions untuk mata pelajaran yang dipilih
        if ($subjectId && $submissions->isNotEmpty()) {
            $labels = [];
            $data = [];
    
            // Misalkan mengambil data dari setiap pertemuan dan nilai
            foreach ($submissions as $submission) {
                $labels[] = $submission->task->learningTopic->name ?? 'Pertemuan Tidak Tersedia'; // Sumbu X (Pertemuan)
                $data[] = $submission->mark; // Sumbu Y (Nilai)
            }
    
            $chartData = [
                'labels' => $labels,
                'data' => $data
            ];
        } else {
            $chartData = null; // Jika tidak ada data
        }
    
        return view('student.task-submission.index', compact('submissions', 'subjects', 'chartData'));
    }
    



}
