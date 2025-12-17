<?php

namespace App\Http\Controllers\teacher\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Techer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function index(){
        $information = Techer::findorFail(Auth::user()->id);
        return view('pages.techer.dashboard.profile', compact('information'));

    }

    public function update(Request $request, $id)
    {

        $information = Techer::findorFail($id);

        if (!empty($request->password)) {
            $name = [
                'ar' => $request->Name_ar,
                'en' => $request->Name_en
            ];
            $information->name = json_encode($name, JSON_UNESCAPED_UNICODE);
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back()->with('success', __('main_tans.updated_successfully'));


    }
}
