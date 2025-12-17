<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = grade::all();
        return view('pages.grades.index', compact('grade'));
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
        if (grade::where('name->ar', $request->name)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->with('error', __('main_tans.Added_error'));
        }
        $request->validate([
            'name_ar' => 'required|unique:grades,name',
            'name_ar' => 'required|unique:grades,name',
        ]);
        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en
        ];

        $notes = [
            'ar' => $request->notes_ar,
            'en' => $request->notes_en
        ];

        grade::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'notes' => json_encode($notes, JSON_UNESCAPED_UNICODE),
        ]);
        return redirect()->route('grades.index')->with('success', __('main_tans.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $grade = grade::find($request->id);
        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en
        ];

        $notes = [
            'ar' => $request->notes_ar,
            'en' => $request->notes_en
        ];

        $grade->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'notes' => json_encode($notes, JSON_UNESCAPED_UNICODE),
        ]);
        return redirect()->route('grades.index')->with('info', __('main_tans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, grade $grade)
    {
        // dd($request->all());

        $my_class = ClassRoom::where('grade_id', $request->id)->pluck('grade_id');
        if ($my_class->count() == 0) {
            $grade = grade::find($request->id);
            $grade->delete();
            return redirect()->route('grades.index')->with('error', __('main_tans.deleted_successfully'));
        } else {
            return redirect()->route('grades.index')->with('error', __('main_tans.error_delete_grade'));
        }
    }
}
