<?php

namespace App\Http\Controllers\ParentDashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fees_Invoices;
use App\Models\my_parent;
use App\Models\ReceiptStudent;
use App\Models\student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index()
    {

        $students = Student::where('parent_id', Auth::user()->id)->get();
        return view('pages.parent.children.index', compact('students'));
    }

    public function results($id)
    {

        $student = student::findorFail($id);

        if ($student->parent_id !== Auth::user()->id) {
            return redirect()->route('sons.index')->with('error', 'يوجد خطا في كود الطالب');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {

            return redirect()->route('sons.index')->with('error', 'لا توجد نتائج لهذا الطالب');
        }

        return view('pages.parent.degrees.index', compact('degrees'));
    }


    public function attendances()
    {
        $students = Student::where('parent_id', Auth::user()->id)->get();
        return view('pages.parent.Attendance.index', compact('students'));
    }

    public function attendanceSearch(Request $request)
    {
        // تحويل التاريخ من m-d-Y إلى Y-m-d
        $from = Carbon::createFromFormat('m-d-Y', $request->from)->format('Y-m-d');
        $to = Carbon::createFromFormat('m-d-Y', $request->to)->format('Y-m-d');

        // الحصول على الأقسام الخاصة بالمعلم
        $ids = DB::table('section_techer')
            ->where('teacher_id', Auth::user()->id)
            ->pluck('section_id');

        // جلب الطلاب المرتبطين بالأقسام
        $students = Student::whereIn('section_id', $ids)->get();

        // جلب الحضور حسب حالة تحديد الطالب
        if ($request->student_id == 0) {
            $Students = Attendance::whereBetween('attendence_date', [$from, $to])
                ->where('teacher_id', Auth::user()->id)
                ->get();
        } else {
            $Students = Attendance::whereBetween('attendence_date', [$from, $to])
                ->where('student_id', $request->student_id)
                ->where('teacher_id', Auth::user()->id)
                ->get();
        }

        return view('pages.techer.dashboard.attendanceReport', compact('Students', 'students'));
    }

    public function fees(){
        $students_ids = Student::where('parent_id', Auth::user()->id)->pluck('id');
        $Fee_invoices = Fees_Invoices::whereIn('student_id',$students_ids)->get();
        return view('pages.parent.fees.index', compact('Fee_invoices'));

    }

    public function receiptStudent($id){

        $student = Student::findorFail($id);
        if ($student->parent_id !== Auth::user()->id) {
            return redirect()->route('sons.fees')->with('error','يوجد خطا في كود الطالب');
        }

        $receipt_students = ReceiptStudent::where('student_id',$id)->get();

        if ($receipt_students->isEmpty()) {
            return redirect()->route('sons.fees')->with('error','لا توجد مدفوعات لهذا الطالب');
        }
        return view('pages.parent.Receipt.index', compact('receipt_students'));

    }

    public function profile()
    {
        $information = My_Parent::findorFail(Auth::user()->id);
        return view('pages.parent.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = my_parent::findorFail($id);

        if (!empty($request->password)) {
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $information->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $information->name = json_encode($name, JSON_UNESCAPED_UNICODE);    
            $information->save();
        }
        return redirect()->back()->with('success','messages.Update');


    }

}
