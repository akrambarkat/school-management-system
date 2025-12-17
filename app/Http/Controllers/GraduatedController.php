<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Graduated;
use App\Models\student;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::onlyTrashed()->get();
        return view('pages.student.Graduated.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = grade::all();
        return view('pages.student.Graduated.create', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $student = student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        if ($student->count() == 0) {
            return redirect()->back()->with('error', 'Student Not Found');
        }
        foreach ($student as $std) {
            $ide = explode(',', $std->id);
            $std::whereIn('id', $ide)->delete();
        }
        return redirect()->back()->with('info', __('main_tans.updated_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Graduated $graduated)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graduated $graduated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $std = student::withTrashed()->find($id)->update([
            'deleted_at' => NULL,
        ]);
        return redirect()->back()->with('info', __('main_tans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $std = student::withTrashed()->Find($request->id);
        $std->forceDelete();
        return redirect()->back()->with('error', __('main_tans.deleted_successfully'));
    }
}
