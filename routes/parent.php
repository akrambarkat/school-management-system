<?php

use App\Http\Controllers\ParentDashboard\ChildrenController;
use App\Models\student;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parents/dashboard', function () {
            $sons = student::where('parent_id',Auth::user()->id)->get();
            return view('pages.parent.dashboard',compact('sons'));
        });
        Route::get('children', [ChildrenController::class,'index'])->name('sons.index');
        Route::get('results/{id}', [ChildrenController::class,'results'])->name('sons.results');
        Route::get('attendances', [ChildrenController::class,'attendances'])->name('sons.attendances');
        Route::post('attendances',[ChildrenController::class,'attendanceSearch'])->name('sons.attendance.search');

        Route::get('fee', [ChildrenController::class,'fees'])->name('sons.fees');
        Route::get('receipt/{id}', [ChildrenController::class,'receiptStudent'])->name('sons.receipt');
        Route::get('profile/parent', [ChildrenController::class,'profile'])->name('profile.show.parent');
        Route::post('profile/parent/{id}', [ChildrenController::class,'update'])->name('profile.update.parent');
    }
);
