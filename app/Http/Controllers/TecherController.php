<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\specialization;
use App\Models\Techer;
use Illuminate\Http\Request;

class TecherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techer = Techer::all();
        $specialization = specialization::all();
        $gender = gender::all();
        return view('pages.techer.index', compact('techer', 'specialization', 'gender'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialization = specialization::all();
        $gender = gender::all();
        return view('pages.techer.add_techer', compact('specialization', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'address' => 'required',
            'Joining_Date' => 'required',
            'National_ID' => 'required',
            'phone' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',

        ]);
        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];

        Techer::create([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'joining_data' => $request->Joining_Date,
            'National_ID' => $request->National_ID,
            'phone' => $request->phone,
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
        ]);
        return redirect()->route('teacher.index')->with('success', __('main_tans.added_successfully'));
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
        $y = Techer::find($id);
        $specialization = specialization::all();
        $gender = gender::all();
        return view('pages.techer.edit_techer', compact('y', 'specialization', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|email',

            'address' => 'required',
            'Joining_Date' => 'required',
            'National_ID' => 'required',
            'phone' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',

        ]);
        $y = Techer::find($id);

        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];
        $y->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'joining_data' => $request->Joining_Date,
            'National_ID' => $request->National_ID,
            'phone' => $request->phone,
            'specialization_id' => $request->specialization_id,
            'gender_id' => $request->gender_id,
        ]);
        return redirect()->route('teacher.index')->with('info', __('main_tans.updated_successfully'));;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $x = Techer::Find($request->id);
        $x->delete();
        return redirect()->route('teacher.index')->with('error', __('main_tans.deleted_successfully'));
    }
}
