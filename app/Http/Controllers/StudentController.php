<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\gender;
use App\Models\section;
use App\Models\student;
use App\Models\religion;
use App\Models\ClassRoom;
use App\Models\image;
use App\Models\my_parent;
use App\Models\Nationalitie;
use App\Models\ReceiptStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::all();
        return view('pages.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gender = gender::all();
        $parents = my_parent::all();
        $my_classes = grade::all();
        $Nationalitie = Nationalitie::all();
        $religion = religion::all();
        $religion = religion::all();
        return view('pages.student.add_student', compact(
            'gender',
            'parents',
            'my_classes',
            'Nationalitie',
            'religion'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'National_ID' => 'required',
                'Date_Birth' => 'required',
                'gender_id' => 'required',
                'Religion' => 'required',
                'Nationality' => 'required',
                'Grade_id' => 'required',
                'Classroom_id' => 'required',
                'section_id' => 'required',
                'parent_id' => 'required',
                'academic_year' => 'required',
            ]);
            $name = [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ];
            $students = student::create([
                'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'National_ID' => $request->National_ID,
                'Date_Birth' => $request->Date_Birth,
                'gender_id' => $request->gender_id,
                'Religion_id' => $request->Religion,
                'Nationality_id' => $request->Nationality,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $img_name = rand() . time() . $file->getClientOriginalName();
                    $file->move(public_path('Attachment/students/' . $request->name_en), $img_name);

                    $students->image()->create([
                        'filename' => $img_name,
                        'imageable_id' => $students->id,
                        'imageable_type' => 'App\Models\student'
                    ]);
                }
            }
            return redirect()->route('student.create')->with('success', __('main_tans.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Student = Student::findOrFail($id);
        $receipt = ReceiptStudent::with('studentAccounts')->find($id);
        return view('pages.student.show', compact('Student', 'receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = student::findorfail($id);
        $gender = gender::all();
        $parents = my_parent::all();
        $my_classes = grade::all();
        $Nationalitie = Nationalitie::all();
        $religion = religion::all();
        return view('pages.student.edit', compact('student', 'gender', 'parents', 'my_classes', 'Nationalitie', 'religion', 'religion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        try {
            $request->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email',
                'password' => 'nullable|confirmed|size:8',
                'National_ID' => 'required',
                'Date_Birth' => 'required',
                'gender_id' => 'required',
                'Religion' => 'required',
                'Nationality' => 'required',
                'Grade_id' => 'required',
                'Classroom_id' => 'required',
                'section_id' => 'required',
                'parent_id' => 'required',
                'academic_year' => 'required',
            ]);
            $name = [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ];
            $student->update([
                'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'National_ID' => $request->National_ID,
                'Date_Birth' => $request->Date_Birth,
                'gender_id' => $request->gender_id,
                'Religion_id' => $request->Religion,
                'Nationality_id' => $request->Nationality,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);
            return redirect()->route('student.index')->with('info', __('main_tans.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->page_id == 1) {
            $x = student::Find($request->id);
            $x->forcedelete();
            return redirect()->route('student.index')->with('error', __('main_tans.deleted_successfully'));
        } else {

            $x = student::Find($id);
            $x->delete();
            return redirect()->route('student.index')->with('error', __('main_tans.deleted_successfully'));
        }
    }



    public function Get_classrooms($id)
    {
        $list_classes = ClassRoom::where("Grade_id", $id)
            ->get()
            ->mapWithKeys(function ($classroom) {
                $name = json_decode($classroom->name, true);
                $translatedName = $name[app()->getLocale()] ?? $name['en'];
                return [$classroom->id => $translatedName];
            });

        return response()->json($list_classes);
    }


    public function Get_Sections($id)
    {
        $list_sections = Section::where("Class_id", $id)
            ->get()
            ->mapWithKeys(function ($section) {
                $name = json_decode($section->name, true);
                $translatedName = $name[app()->getLocale()] ?? $name['en'];
                return [$section->id => $translatedName];
            });

        return response()->json($list_sections);
    }

    public function Download_attachment($studentsname, $filename)
    {

        $path = public_path('Attachment/students/' . $studentsname . '/' . $filename);
        if (!file_exists($path)) {
            return abort(404, 'File not found.');
        }

        $customFileName = $studentsname . '_' . $filename; // اسم مخصص
        return response()->download($path, $customFileName);
    }


    public function Delete_attachment(String $id)
    {
        $attachment = image::find($id);
        $student = student::findOrFail($attachment->imageable_id);

        $filePath = public_path('Attachment/students/' . $student->name_en . '/' . $attachment->filename);
        $folderPath = public_path('Attachment/students/' . $student->name_en);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        image::where('id', $id)->where('filename', $attachment->filename)->delete();
        if (is_dir($folderPath) && count(scandir($folderPath)) == 2) {
            rmdir($folderPath);
        }



        return redirect()->back()->with('error', __('main_tans.deleted_successfully'));
    }




    public function add_attachment(Request $request)
    {
        if (!$request->hasFile('photos')) {
            return redirect()->back()->with('error', __('main_tans.photo_std'));
        }

        $validator = Validator::make($request->all(), [
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = student::find($request->student_id);

        foreach ($request->file('photos') as $file) {
            $img_name = rand() . time() . $file->getClientOriginalName();
            $file->move(public_path('Attachment/students/' . $request->student_name), $img_name);

            $student->image()->create([
                'filename' => $img_name,
                'imageable_id' => $student->id,
                'imageable_type' => 'App\Models\student'
            ]);
        }

        return redirect()->back()->with('success', __('main_tans.added_successfully'));
    }
}
