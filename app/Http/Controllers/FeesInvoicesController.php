<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\student;
use Illuminate\Http\Request;
use App\Models\Fees_Invoices;
use App\Models\grade;
use App\Models\Student_accounts;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class FeesInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Fee_invoices = Fees_Invoices::all();
        $Grades = grade::all();
        return view('pages.Fees_Invoices.index', compact('Fee_invoices', 'Grades'));
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
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fees_Invoices();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new Student_accounts();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->fee_invoices_id = $Fees->id;
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();
            return redirect()->route('Fees_Invoices.index')->with('success', __('main_tans.added_successfully'));
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
        $fees = fees::where('classroom_id', $student->classroom_id)->get();
        return view('pages.Fees_Invoices.add', compact('student', 'fees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fees_Invoices $fees_Invoices, String $id)
    {
        $fee_invoices = Fees_Invoices::findorfail($id);
        $fees = fees::where('classroom_id', $fees_Invoices->classroom_id)->get();
        return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fees'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fees_Invoices::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = Student_accounts::where('fee_invoice_id', $request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();


            return redirect()->route('Fees_Invoices.index')->with('info', __('main_tans.updated_successfully'));
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
        // dd($id);
        DB::beginTransaction();
        try {
            // حذف البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fees_Invoices::findorfail($id);
            $Fees->delete();
            // // حذف البيانات في جدول حسابات الطلاب
            // $StudentAccount = Student_accounts::where('fee_invoice_id', $id)->first();
            // $StudentAccount->delete();
            DB::commit();
            return redirect()->route('Fees_Invoices.index')->with('error', __('main_tans.deleted_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
