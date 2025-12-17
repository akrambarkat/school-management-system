<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\grade;
use App\Models\student;
use App\Models\Techer;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade::with(['Sections'])->get();
        $list_Grades = grade::all();
        $teachers = Techer::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
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
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::create([
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = student::with('attendance')->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
