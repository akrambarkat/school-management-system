<?php

namespace App\Http\Controllers\teacher\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\section;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class StudentController extends Controller
{
    function index()
    {
        $ids = DB::table('section_techer')->where('teacher_id', Auth::user()->id)->pluck('section_id');
        $students = student::whereIn('section_id', $ids)->get();
        return view('pages.techer.dashboard.student', compact('students'));
    }

    function section()
    {
        $ids = DB::table('section_techer')->where('teacher_id', Auth::user()->id)->pluck('section_id');
        $sections = section::whereIn('id', $ids)->get();

        return view('pages.techer.dashboard.section', compact('sections'));
    }

    function attendance(Request $request)
    {
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateorCreate(['student_id' => $studentid, 'attendence_date' => date('Y-m-d')], [
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }


            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    function attendanceReport()
    {
        $ids = DB::table('section_techer')->where('teacher_id', Auth::user()->id)->pluck('section_id');
        $students = student::whereIn('section_id', $ids)->get();
        return view('pages.techer.dashboard.attendanceReport', compact('students'));
    }



    public function attendanceSearch(Request $request)
    {

        $from = Carbon::createFromFormat('m-d-Y', $request->from)->format('Y-m-d');
        $to = Carbon::createFromFormat('m-d-Y', $request->to)->format('Y-m-d');

        $ids = DB::table('section_techer')
            ->where('teacher_id', Auth::user()->id)
            ->pluck('section_id');
        $students = student::whereIn('section_id', $ids)->get();

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
}
