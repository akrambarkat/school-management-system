<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use App\Models\student;
use Illuminate\Http\Request;
use App\Models\ReceiptStudent;
use App\Models\Student_accounts;
use Illuminate\Support\Facades\DB;

class ReceiptStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.Receipt.index', compact('receipt_students'));
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

            // حفظ البيانات في جدول سندات القبض
            $receipt_students = new ReceiptStudent();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات في جدول حساب الطالب
            $fund_accounts = new Student_accounts();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            DB::commit();
            return redirect()->route('Receipt_Student.index')->with('success', __('main_tans.added_successfully'));
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
        $student = student::findorfail($id);
        return view('pages.Receipt.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $receipt_student = ReceiptStudent::findorfail($id);

        return view('pages.Receipt.edit', compact('receipt_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات القبض
            $receipt_students = ReceiptStudent::findorfail($id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // حفظ البيانات في جدول الصندوق
            $fund_accounts = FundAccount::where('receipt_id', $id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات في جدول حساب الطالب
            $fund_accounts = Student_accounts::where('receipt_id', $id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            DB::commit();
            return redirect()->route('Receipt_Student.index')->with('success', __('main_tans.added_successfully'));
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
        DB::beginTransaction();
        try {
            $receipt_students = ReceiptStudent::findorfail($id);
            $receipt_students->delete();
            DB::commit();
            return redirect()->route('Receipt_Student.index')->with('error', __('main_tans.deleted_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
