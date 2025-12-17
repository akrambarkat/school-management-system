<?php

namespace App\Http\Controllers\teacher\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Degree;
use App\Models\grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzeController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', Auth::user()->id)->get();
        return view('pages.techer.dashboard.Quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', Auth::user()->id)->get();
        return view('pages.techer.dashboard.Quizzes.create', $data);
    }


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
            $quizzes->teacher_id = Auth::user()->id;
            $quizzes->duration_minutes = $request->duration_minutes;

            $quizzes->save();
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = grade::all();
        $data['subjects'] = Subject::where('teacher_id', Auth::user()->id)->get();
        return view('pages.techer.dashboard.Quizzes.edit', $data, compact('quizz'));
    }


    public function update(Request $request)
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
            $quizz->teacher_id =  Auth::user()->id;
            $quizz->duration_minutes = $request->duration_minutes;
            $quizz->save();
            return redirect()->route('Quizzes.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function Get_classrooms($id)
    {
        // الحصول على البيانات مع ترجمة الاسم
        $list_classes = ClassRoom::where("Grade_id", $id)
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

    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizze::findorFail($id);
        return view('pages.techer.dashboard.Questions.index',compact('questions','quizz'));
    }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quizze_id', $quizze_id)->get();
        return view('pages.techer.dashboard.Quizzes.student_quizze', compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('quizze_id', $request->quizze_id)->delete();
        
        return redirect()->back()->with('success','تم فتح الاختبار مرة اخرى للطالب');
    }
}
