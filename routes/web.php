<?php


use App\Http\Controllers\AddParentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FeesInvoicesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\MyParentController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\ProcessingFeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TecherController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;





// Authenticated routes group
Route::group([
    'prefix' => LaravelLocalization::setLocale()
    // 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Admin routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin-dashboard', function () {

            return view('dashboard');
        })->name('dashboard');
        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        Route::resource('/grades', GradeController::class);
        Route::resource('/classroom', ClassRoomController::class);
        Route::resource('/sections', SectionController::class);
        Route::resource('/parent', MyParentController::class);
        Route::resource('/add_parent', AddParentController::class);
        Route::resource('/teacher', TecherController::class);
        Route::resource('/student', StudentController::class);
        Route::resource('/Promotion', PromotionController::class);
        Route::resource('/Graduated', GraduatedController::class);
        Route::resource('/fees', FeesController::class);
        Route::resource('/Receipt_Student', ReceiptStudentController::class);
        Route::resource('/Fees_Invoices', FeesInvoicesController::class);
        Route::resource('/processing_fees', ProcessingFeeController::class);
        Route::resource('/Payment_Students', PaymentStudentController::class);
        Route::resource('/Attendance', AttendanceController::class);
        Route::resource('/Subjects', SubjectController::class);
        Route::resource('/Quizze', QuizzeController::class);
        Route::resource('/Questions', QuestionController::class);
        Route::resource('/Library', LibraryController::class);
        Route::resource('/settings', SettingController::class);
        Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');


        Route::post('/delete_select', [ClassRoomController::class, 'delete_select'])->name('delete_all');
        Route::any('/filter_classes', [ClassRoomController::class, 'search_iteam'])->name('search_iteam');
        // Route::get('classes/{id}', [SectionController::class, 'getclasses']); // get classes by id
        Route::get('/get-classrooms-by-grade/{grade}', [SectionController::class, 'getClassroomsByGrade']);
        Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);
        Route::get('/Get_classroom/{id}', [SubjectController::class, 'Get_classrooms']);

        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Download_attachment'); // download attachment
        Route::delete('/delete-attachment/{id}', [StudentController::class, 'Delete_attachment'])->name('delete.attachment');
        Route::post('/add_attachment', [StudentController::class, 'add_attachment'])->name('add_attachment');
        Route::get('show_fees/{id}', [FeesController::class, 'show_fees'])->name('show_fees');
        Route::get('/download/{file_name}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');
        // Add all your admin routes here...


    });
});


Route::get('/logout/{type}', [AuthenticatedSessionController::class, 'destroy'])->name('logout');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});










require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
require __DIR__ . '/parent.php';
require __DIR__ . '/teacher.php';
