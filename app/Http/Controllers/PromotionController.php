<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\student;
use App\Models\promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade::all();
        return view('pages.student.promotion.index', compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotions = promotion::all();
        $Grades = grade::all();
        return view('pages.student.promotion.mangment', compact('promotions', 'Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            // التحقق من بيانات الطلب
            $students = student::where('grade_id', $request->Grade_id)
                ->where('classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();
            if ($students->count() < 1) {
                // إرسال رسالة الخطأ
                return redirect()->back()->withErrors(['error_promotions' => __('لاتوجد بيانات في جدول الطلاب')]);
            }

            foreach ($students as $student) {
                $ide = explode(',', $student->id);
                student::wherein('id', $ide)
                    ->update([
                        'grade_id' => $request->Grade_id_new,
                        'classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                promotion::updateorcreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_classRoom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_classRoom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,

                ]);
            }

            DB::commit();

            return redirect()->back()->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd($id);
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
    public function destroy(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            if ($request->page_id == 1) {
                $promotions = promotion::all();

                foreach ($promotions as $promotion) {
                    $ide = explode(',', $promotion->student_id);

                    student::whereIn('id', $ide)
                        ->update([
                            'grade_id' => $promotion->from_grade,
                            'classroom_id' => $promotion->from_classRoom,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year,
                        ]);
                }

                // بعد إتمام التحديثات لكل الطلاب، قم بتفريغ جدول الترقية
                promotion::truncate();

                // التزام التغييرات
                DB::commit();

                return redirect()->back()->with('info', __('main_tans.updated_successfully'));
            } else {
                $promotion = promotion::findorfail($request->id);
                student::where('id', $promotion->student_id)
                    ->update([
                        'grade_id' => $promotion->from_grade,
                        'classroom_id' => $promotion->from_classRoom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);
                Promotion::destroy($request->id);
                DB::commit();
                return redirect()->back()->with('info', __('main_tans.updated_successfully'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
