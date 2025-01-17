<?php

namespace App\Http\Controllers\Task;

use App\Task;
use App\TaskSubmission;
use App\LearningTopic;
use App\Grade;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TaskSubmissionController extends Controller
{
    public function index(Task $task, $grade_id = null)
    {
        $grade = null;
        $submissions = TaskSubmission::with('user.grade')
                                    ->whereTaskId($task->id)
                                    ->get();
        
        if ($grade_id != null) {
            $submissions = $submissions->where('user.grade_id', $grade_id); // Tetap sebagai koleksi
            $grade = Grade::findOrFail($grade_id)->name;
        }

        $grades = $task->learningTopic->grades->sortBy('name')->values()->all();

        // Ambil nama siswa, nilai, dan catatan guru
        $studentNames = $submissions->map(function($submission) {
            return $submission->user->name;
        });

        $studentScores = $submissions->map(function($submission) {
            return is_numeric($submission->mark) ? (float) $submission->mark : null;
        })->filter();  // Hanya ambil nilai yang valid (bukan null)

        $teacherNotes = $submissions->map(function($submission) {
            return $submission->teacher_notes;
        });

        // Hitung rata-rata nilai
        $averageScore = $studentScores->avg();
        
        return view('admin.task-submission.index', compact('task', 'grades', 'grade', 'submissions', 'studentNames', 'studentScores', 'teacherNotes', 'averageScore'));
    }


    public function show($submission_id)
    {
        $submission = DB::table('task_submissions')
                            ->join('tasks','task_submissions.task_id','=','tasks.id')
                            ->join('users','task_submissions.user_id','=','users.id')
                            ->join('grades','users.grade_id','=','grades.id')
                            ->where('task_submissions.id','=',$submission_id)
                            ->select('task_submissions.*','tasks.name as task','users.name as user','grades.name as grade')
                            ->first();

        return view('admin.task-submission.show', compact('submission'));
    }

    public function update(Request $request, TaskSubmission $submission)
    {
        $submission->update($request->only(['mark','teacher_notes']));

        return redirect('admin/tasks/'.$submission->task_id.'/submissions')->with('status',__('messages.assignment_score_added'));
    }

    public function destroy(Request $request)
    {
        $submission_ids = $request->submission_id;

        if($submission_ids == null){
            return back();
        }

        $submission_path = TaskSubmission::whereIn('id', $submission_ids)->pluck('submission_path')->all();

        for($i=0;$i<count($submission_path);$i++)
        {
            if($submission_path[$i] != null)
            {
                Storage::delete($submission_path[$i]);
            }
        }

        TaskSubmission::whereIn('id', $submission_ids)->delete();

        return back()->with('status', __('messages.assignment_submission_deleted'));
    }
}
