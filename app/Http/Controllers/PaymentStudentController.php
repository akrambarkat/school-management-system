<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use App\Models\student;
use Illuminate\Http\Request;
use App\Models\PaymentStudent;
use App\Models\Student_accounts;
use Illuminate\Support\Facades\DB;

class PaymentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index', compact('payment_students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'Debit' => 'required|numeric',
            'description' => 'required'

        ]);
        try {

            // حفظ البيانات في جدول سندات الصرف
            $payment_students = new PaymentStudent();
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;

            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new Student_accounts();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            return redirect()->route('Payment_Students.index')->with('sucess', __('main_tans.added_successfully'));
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
        return view('pages.Payment.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $payment_student = PaymentStudent::findorfail($id);
        return view('pages.Payment.edit', compact('payment_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentStudent $paymentStudent)
    {
        DB::beginTransaction();

        try {

            // تعديل البيانات في جدول سندات الصرف
            $payment_students = PaymentStudent::findorfail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = FundAccount::where('payment_id', $request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = Student_accounts::where('payment_id', $request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();

            return redirect()->route('Payment_Students.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        DB::beginTransaction();
        try {
            $payment_students = PaymentStudent::findorfail($id);
            $payment_students->delete();

            DB::commit();
            return redirect()->route('Payment_Students.index')->with('error', __('main_tans.deleted_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
