<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\grade;
use App\Models\section;
use App\Models\Subject;
use App\Models\Techer;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subjects = Subject::all();

        return view('pages.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = grade::all();
        $teachers = Techer::all();
        return view('pages.subjects.create', compact('grades', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $subjects = new Subject();
            $subjects->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = intval($request->Classroom_id);
            $subjects->teacher_id = intval($request->teacher_id);
            $subjects->save();

            return redirect()->route('Subjects.index')->with('success', __('main_tans.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $subject = Subject::find($id);
        $grades = grade::all();
        $teachers = Techer::all();
        return view('pages.subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        try {
            $subjects =  Subject::findorfail($request->id);
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $subjects->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();

            return redirect()->route('Subjects.index')->with('success', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            $subject->delete();
            return redirect()->route('Subjects.index')->with('error', __('main_tans.deleted_successfully'));
        } else {
            return redirect()->back()->with(['error' => __('main_tans.not_found')]);
        }
    }

    public function Get_classrooms($id)
    {
        // الحصول على البيانات مع ترجمة الاسم
        $list_classes = ClassRoom::where("grade_id", $id)
            ->get()
            ->mapWithKeys(function ($classroom) {
                // فك تشفير JSON وإرجاع الاسم حسب اللغة الحالية
                $name = json_decode($classroom->name, true);
                $translatedName = $name[app()->getLocale()] ?? $name['en']; // اللغة الافتراضية الإنجليزية
                return [$classroom->id => $translatedName];
            });

        return response()->json($list_classes);
    }


    public function Get_Sections($id)
    {
        // الحصول على الأقسام مع ترجمة الاسم
        $list_sections = section::where("Class_id", $id)
            ->get()
            ->mapWithKeys(function ($section) {
                // فك تشفير JSON وإرجاع الاسم حسب اللغة الحالية
                $name = json_decode($section->name, true);
                $translatedName = $name[app()->getLocale()] ?? $name['en']; // اللغة الافتراضية الإنجليزية
                return [$section->id => $translatedName];
            });

        return response()->json($list_sections);
    }
}
