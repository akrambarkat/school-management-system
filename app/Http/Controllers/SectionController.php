<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Techer;
use App\Models\section;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();
        $teachers = Techer::all();

        return view('pages.sections.index', compact('list_Grades', 'Grades', 'teachers'));
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

        // dd($request->all());
        $name = [
            'ar' => $request->Name_Section_Ar,
            'en' => $request->Name_Section_En,
        ];
        // $section = new section();

        // $section->name = json_encode($name, JSON_UNESCAPED_UNICODE); // Convert the array to JSON
        // $section->grade_id = $request->grade_id;
        // $section->class_id = $request->classroom_id;
        // $section->save; // Save the section

        $section = section::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'grade_id' => $request->grade_id,
            'class_id' => $request->Classroom_id,
            'status' => '1',

        ]);
        $section->teachers()->attach($request->teacher_id);
        return redirect()->back()->with('success', __('main_tans.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $section = section::find($request->id);




        if ($request->has('Name_Section_Ar') && $request->has('Name_Section_En')) {
            $section->name = [
                'ar' => $request->Name_Section_Ar,
                'en' => $request->Name_Section_En,
            ];
        }

        if ($request->has('edit_grade_id')) {
            $section->grade_id = $request->edit_grade_id;
        }

        if ($request->has('edit_classroom_id')) {
            $section->class_id = $request->edit_classroom_id;
        }

        $section->status = $request->has('Status') ? 1 : 2;
        // update pivot tABLE
        if (isset($request->teacher_id)) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }
        $section->save();
        return redirect()->back()->with('info', __('main_tans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = section::find($request->id);
        $section->delete();
        return redirect()->back()->with('error', __('main_tans.deleted_successfully'));
    }



    public function getClassroomsByGrade($gradeId)
    {
        $classrooms = Classroom::where('grade_id', $gradeId)->get(['id', 'name']);

        return response()->json($classrooms);
    }

    
}
