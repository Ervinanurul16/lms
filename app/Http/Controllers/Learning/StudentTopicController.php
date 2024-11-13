<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\LearningTopic;
use Auth;
use App\Grade;
use Illuminate\Http\Request;
use App\Subject;



class StudentTopicController extends Controller
{
    public function index()
    {
        $topics = LearningTopic::with(['subject','user','grades'])->get();

        return view('student.learning-topic.index', compact('topics'));
    }

    public function indexMyTopic(Request $request)
    {
        // Ambil daftar semua mata pelajaran untuk digunakan dalam dropdown
        $subjects = Subject::select('id', 'name')->get();
    
        // Ambil koleksi topik milik user dan topik yang sesuai dengan grade user
        $topic_collection = Auth::user()->learningTopicCollections()->with('user', 'subject')->get();
        $topics_from_student_grade = Grade::findOrFail(Auth::user()->grade_id)->learningTopics()->with(['subject', 'user'])->get();
    
        // Gabungkan kedua koleksi
        $topics = $topic_collection->merge($topics_from_student_grade);
    
        // Cek apakah ada request untuk filter berdasarkan mata pelajaran
        if ($request->has('subject_id')) {
            $subject_id = $request->get('subject_id');
            $topics = $topics->where('subject.id', $subject_id); // Filter berdasarkan subject_id
        }
    
        // Sorting berdasarkan tingkat kelas
        $topics = $topics->sortBy('grade_level');
    
        // Kembalikan view dengan data yang sudah difilter dan disorting
        return view('student.learning-topic.index-my-topic', compact('topics', 'subjects'));
    }
    
}
