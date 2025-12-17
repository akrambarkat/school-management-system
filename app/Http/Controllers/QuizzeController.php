<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Techer;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quizze::all();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['grades'] = grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Techer::all();
        return view('pages.Quizzes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $quizzes = new Quizze();
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $quizzes->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->duration_minutes = $request->duration_minutes;
            $quizzes->save();
            return redirect()->route('Quizze.index')->with('success', __('main_tans.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quizze $quizze)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Techer::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quizze $quizze)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $quizz->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();

            return redirect()->route('Quizze.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Quizze::destroy($request->id);

            return redirect()->back()->with('error', __('main_tans.deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
