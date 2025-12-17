<?php

namespace App\Http\Controllers\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quizze::where('grade_id', Auth::user()->grade_id)
            ->where('classroom_id',  Auth::user()->classroom_id)
            ->where('section_id',  Auth::user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('pages.student.dashboard.exams.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($quizze_id)
    {

        $student_id = Auth::user()->id;
        return view('pages.student.dashboard.exams.show',compact('quizze_id','student_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function shows($quiz_id, $student_id)
    {
        $quiz = Quizze::findOrFail($quiz_id);
        $questions = Question::where('quizze_id', $quiz_id)->inRandomOrder()->get();
        return view('pages.student.dashboard.exams.show', compact('quiz', 'questions', 'student_id'));
    }

    public function submit(Request $request)
{
    if (!$request->has('answers') || !is_array($request->answers)) {
        \App\Models\Degree::updateOrCreate([
            'quizze_id'    => $request->quiz_id,
            'student_id'   => $request->student_id,
            'question_id'  => null, 
        ], [
            'score'           => 0,
            'student_answer'  => null,
            'abuse'           => '1',
            'date'            => now(),
        ]);

        return redirect()->route('exam.complete', [$request->quiz_id, $request->student_id]);
    }

    foreach ($request->answers as $question_id => $answer) {
        $question = \App\Models\Question::find($question_id);

        \App\Models\Degree::updateOrCreate([
            'quizze_id'   => $request->quiz_id,
            'student_id'  => $request->student_id,
            'question_id' => $question_id,
        ], [
            'score'           => trim($answer) === trim($question->right_answer) ? $question->score : 0,
            'student_answer'  => $answer,
            'abuse'           => '0',
            'date'            => now(),
        ]);
    }

    return redirect()->route('exam.complete', [$request->quiz_id, $request->student_id]);
}


    public function complete($quiz_id, $student_id)
    {
        $score = Degree::where('quizze_id', $quiz_id)
            ->where('student_id', $student_id)
            ->sum('score');

        return view('pages.student.dashboard.exams.complete', compact('score'));
    }
}
