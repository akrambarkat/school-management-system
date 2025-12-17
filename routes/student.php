<?php

use App\Http\Controllers\StudentDashboard\ExamsController;
use App\Http\Controllers\StudentDashboard\ProfileController;
use Illuminate\Http\Request;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/students/dashboard', function () {
            return view('pages.student.dashboard');
        });

            Route::resource('student_exams', ExamsController::class);
            Route::get('/exam/{quiz_id}/{student_id}', [ExamsController::class, 'shows'])->name('exam.show');
            Route::post('/exam/submit', [ExamsController::class, 'submit'])->name('exam.submit');
            Route::get('/exam/complete/{quiz_id}/{student_id}', [ExamsController::class, 'complete'])->name('exam.complete');
            Route::get('profile/student',[ProfileController::class,'index'])->name('profile.std');
            Route::put('profile-std/{id}',[ProfileController::class,'update'])->name('profile-update.std');
    }
);
