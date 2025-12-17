<?php

namespace App\Http\Controllers;

use App\Models\religion;
use App\Models\my_parent;
use App\Models\Nationalitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $my_parents = my_parent::all();
        $nationalities = Nationalitie::all();
        $religions = religion::all();

        return view('pages.parent.index', compact('my_parents', 'nationalities', 'religions'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $y = my_parent::find($id);
        $Nationalitie = Nationalitie::all();
        $religion = religion::all();
        return view('pages.parent.edit_parent', compact('y', 'Nationalitie', 'religion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required',
            'address' => 'required',
            'National_ID' => 'required',
            'phone' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'Religion' => 'required',
            'Nationality' => 'required',
            'job' => 'nullable',



        ]);
        $y = my_parent::find($id);
        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];
        $y->update([
            'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
            'Email' => $request->email,
            'Password' => Hash::make($request->password),
            'Address' => $request->address,
            'National_ID' => $request->National_ID,
            'Phone' => $request->phone,
            'Job' => $request->job,
            'Nationality_id' => $request->Nationality,
            'Religion_id' => $request->Religion,
        ]);
        return redirect()->route('parent.index')->with('info', __('main_tans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        $x = my_parent::where('id', $request->id);
        $x->delete();
        return back()->with('error', __('main_tans.deleted_successfully'));
    }
}
