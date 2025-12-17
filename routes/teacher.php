<?php

use App\Http\Controllers\dashboard\StudentController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\teacher\dashboard\ProfileController;
use App\Http\Controllers\teacher\dashboard\QuestionController;
use App\Http\Controllers\teacher\dashboard\QuizzeController as DashboardQuizzeController;
use App\Http\Controllers\teacher\dashboard\StudentController as DashboardStudentController;
use App\Models\Techer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teachers/dashboard', function () {
            $ids = Techer::findorFail(Auth::user()->id)->sections()->pluck('section_id');
            // return $ids;
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();
            return view('pages.techer.dashboard', $data);
        });
        Route::resource('/Quizzes', DashboardQuizzeController::class);
        Route::resource('question', QuestionController::class);

        Route::get('/Get_classroom/{id}', [DashboardQuizzeController::class, 'Get_classrooms']);
        Route::get('/Get_Section/{id}', [DashboardQuizzeController::class, 'Get_Sections']);
        Route::get('student_quizze/{id}',[DashboardQuizzeController::class, 'student_quizze'])->name('student.quizze');
        Route::post('repeat_quizze',[DashboardQuizzeController::class, 'repeat_quizze'])->name('repeat.quizze');
        Route::group(['namespace' => 'dashboard'], function () {
            //==============================students============================
            Route::get('students', [DashboardStudentController::class, 'index'])->name('students.index');
            Route::get('section', [DashboardStudentController::class, 'section'])->name('section');
            Route::post('attendance', [DashboardStudentController::class, 'attendance'])->name('attendance');
            Route::post('edit_attendance', [DashboardStudentController::class, 'editattendance'])->name('attendance.edit_');
            Route::get('attendance_report', [DashboardStudentController::class, 'attendanceReport'])->name('attendance.report');
            Route::post('attendance_report', [DashboardStudentController::class, 'attendanceSearch'])->name('attendance.search');
            Route::get('profile',[ProfileController::class,'index'])->name('profile.show');
            Route::post('profile/{id}',[ProfileController::class,'update'])->name('profile.update');

        });
    }
);
