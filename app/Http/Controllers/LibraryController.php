<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store(Request $request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;

            // حفظ الملف داخل public/Library/Attachment
            $file = $request->file('file_name');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // تأكد من وجود المجلد أولاً، إذا لم يكن موجودًا، يتم إنشاؤه
            $destinationPath = public_path('Attachment/Library');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // إنشاء المجلد مع صلاحيات الكتابة
            }

            // نقل الملف إلى المجلد الجديد
            $file->move($destinationPath, $fileName);

            // تخزين اسم الملف في قاعدة البيانات
            $books->file_name = $fileName;
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->save();

            return redirect()->route('Library.create')->with('success', __('main_tans.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit', compact('book', 'grades'));
    }



    public function update(Request $request, $id)
    {
        try {
            $books = Library::findOrFail($id); // إيجاد الكتاب باستخدام ID

            $books->title = $request->title;

            // إذا تم إرسال ملف جديد
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // تأكد من وجود المجلد أولاً، إذا لم يكن موجودًا، يتم إنشاؤه
                $destinationPath = public_path('Attachment/Library');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); // إنشاء المجلد مع صلاحيات الكتابة
                }

                // نقل الملف إلى المجلد الجديد
                $file->move($destinationPath, $fileName);

                // تحديث اسم الملف في قاعدة البيانات
                $books->file_name = $fileName;
            }

            // تحديث باقي الحقول
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;

            // حفظ التعديلات في قاعدة البيانات
            $books->save();

            return redirect()->route('Library.index')->with('success', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            // العثور على السجل
            $book = Library::findOrFail($request->id);

            // تحديد مسار الملف داخل مجلد public
            $filePath = public_path('Attachment/Library/' . $book->file_name);
            // حذف الملف مباشرة
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // حذف السجل من قاعدة البيانات
            $book->delete();

            // إظهار رسالة نجاح

            return redirect()->route('Library.index')->with('error', __('main_tans.deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function downloadAttachment($file_name)
    {
        $filePath = public_path('Attachment/Library/' . $file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'الملف غير موجود!');
    }
}
