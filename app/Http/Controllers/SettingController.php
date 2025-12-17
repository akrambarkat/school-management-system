<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
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
    public function show(Setting $setting)
    {
        echo 'asda';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }



            if ($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();

                // جلب الصورة القديمة من قاعدة البيانات
                $oldLogo = Setting::where('key', 'logo')->value('value');

                // حذف الصورة القديمة إذا كانت موجودة
                $oldLogoPath = public_path('Attachment/logo/' . $oldLogo);
                if ($oldLogo && file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }

                // تحديث اسم الشعار في قاعدة البيانات
                Setting::where('key', 'logo')->update(['value' => $logo_name]);

                // التأكد من وجود المجلد وإنشائه إذا لم يكن موجودًا
                $destinationPath = public_path('Attachment/logo');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // نقل الملف الجديد إلى المسار المطلوب
                $file = $request->file('logo');
                $file->move($destinationPath, $logo_name);
            }



            return back()->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
