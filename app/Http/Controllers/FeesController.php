<?php

namespace App\Http\Controllers;

use App\Models\fees;
use App\Models\grade;
use App\Models\student;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = fees::all();
        $Grades = Grade::all();
        return view('pages.fees.index', compact('fees', 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = grade::all();
        return view('pages.fees.add', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'amount' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'year' => 'required',
            'description' => 'nullable',
        ]);
        $title = [
            'ar' => $request->title_ar,
            'en' => $request->title_en,
        ];
        $fees = fees::create([
            'title' => json_encode($title, JSON_UNESCAPED_UNICODE),
            'amount' => $request->amount,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'year' => $request->year,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', __('main_tans.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(fees $fees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee = fees::find($id);
        $Grades = grade::all();
        return view('pages.fees.edit', compact('fee', 'Grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $title = [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ];
            $fees = fees::findorfail($id)->update([
                'title' => json_encode($title, JSON_UNESCAPED_UNICODE),
                'amount' => $request->amount,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'year' => $request->year,
                'description' => $request->description,
            ]);

            return redirect()->route('fees.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        fees::find($id)->delete();
        return redirect()->route('fees.index')->with('error', __('main_tans.deleted_successfully'));
    }


    function show_fees($id)
    {
        $fees = fees::find($id)->get();
    }
}
