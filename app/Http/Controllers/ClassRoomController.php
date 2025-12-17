<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = grade::all();
        $classRoom = ClassRoom::all();
        return view('pages.classroom.index', compact('classRoom', 'grade'));
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
        // dd($request->all());
        // $request->validate([
        //     'name_ar' => 'required',
        //     'name_en' => 'required',
        //     'grade_id' => 'required',

        // ]);

        $list = $request->List_Classes;
        foreach ($list as $x) {
            $name = [
                'ar' => $x['name_ar'], // استخدم $x بدلاً من $request للوصول للقيم الصحيحة داخل العنصر
                'en' => $x['name_en'],
            ];

            $classRoom = new ClassRoom();
            $classRoom->name = json_encode($name, JSON_UNESCAPED_UNICODE); // ترميز $name
            $classRoom->grade_id = $x['Grade_id']; // الوصول ل grade_id الصحيح من العنصر $x
            $classRoom->save(); // حفظ العنصر الجديد
        }
        return redirect()->back()->with('success', __('main_tans.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $x = ClassRoom::find($request->id);
        $x->delete(); // حذف العنصر
        return redirect()->back()->with('error', __('main_tans.deleted_successfully'));
    }

    function delete_select(Request $request)
    {
        // dd($delete_all_id = explode(",", $request->delete_all_id));
        $delete_all_id = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->Delete();
        return redirect()->back()->with('success', __('main_tans.deleted_successfully'));
    }


    function search_iteam(Request $request)
    {
        $id = $request->grade_id;
        $grade = grade::all();

        $data = ClassRoom::where('grade_id', $id)->get();
        return view('pages.classroom.index', compact('grade'))->with('details', $data);;
    }
}
