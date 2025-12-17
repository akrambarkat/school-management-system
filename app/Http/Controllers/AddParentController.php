<?php

namespace App\Http\Controllers;

use App\Models\my_parent;
use App\Models\Nationalitie;
use App\Models\religion;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Nationalitie = Nationalitie::all();
        $religion = religion::all();
        return view('pages.parent.add_parent', compact('Nationalitie', 'religion'));
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
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required',
            'address' => 'required',
            'National_ID' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'Religion' => 'required',
            'Nationality' => 'required',
            'job' => 'nullable',



        ]);
        $name = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];
        my_parent::create([
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
        return redirect()->route('parent.index')->with('success', __('main_tans.added_successfully'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
