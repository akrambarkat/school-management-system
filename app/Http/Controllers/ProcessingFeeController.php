<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use App\Models\ProcessingFee;
use App\Models\Student_accounts;
use Illuminate\Support\Facades\DB;

class ProcessingFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.processing_fees.index', compact('ProcessingFees'));
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
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $ProcessingFee = new ProcessingFee();
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new Student_accounts();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('processing_fees.index')->with('success', __('main_tans.added_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $student = student::findOrfail($id);
        return view('pages.processing_fees.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.processing_fees.edit', compact('ProcessingFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProcessingFee $processingFee)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProcessingFee::findorfail($request->id);;
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = Student_accounts::where('processing_id', $request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('processing_fees.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, String $id)
    {
        $processingFee = ProcessingFee::FindOrfail($id);
        $processingFee->delete();
        return redirect()->route('processing_fees.index')->with('error', __('main_tans.deleted_successfully'));
    }
}
