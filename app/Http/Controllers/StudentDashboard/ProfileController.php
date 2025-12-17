<?php

namespace App\Http\Controllers\StudentDashboard;

use App\Http\Controllers\Controller;
use App\Models\student;
use App\Models\Techer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
     public function index()
    {
        $information = student::findorFail(Auth::user()->id);
        return view('pages.student.dashboard.profile', compact('information'));
    }

    public function update(Request $request,$id)
    {
        $information = Student::findorFail($id);

        if (!empty($request->password)) {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        
        return redirect()->back();
    }

    
}
