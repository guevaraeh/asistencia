<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssistanceTeacherController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    //return Inertia::render('welcome');
    return redirect(route('login'));
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        //return Inertia::render('dashboard');
        if (!Gate::allows('manage-assistance'))
            return Inertia::location(route('assistance_teacher.create'));
        else return Inertia::location(route('assistance_teacher'));
    })->name('dashboard');

    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
    Route::get('/teacher/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::get('/assistanceteacher/{teacher}/create', [TeacherController::class, 'create_assistance'])->name('teacher.create_assistance');
    Route::get('/teacher-submitted/{teacher}', [TeacherController::class, 'submitted'])->name('teacher.submitted');
    Route::delete('/teacher/{teacher}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    Route::get('/teacher-import', function () {
        return view('teacher.import');
    })->name('import');
    Route::post('/teacher-import', [TeacherController::class, 'import'])->name('teacher.import');

    Route::get('/assistanceteacher', [AssistanceTeacherController::class, 'index'])->name('assistance_teacher');
    Route::get('/assistanceteacher/create', [AssistanceTeacherController::class, 'create'])->name('assistance_teacher.create');
    Route::post('/assistanceteacher/confirm', [AssistanceTeacherController::class, 'confirm'])->name('assistance_teacher.confirm');
    Route::post('/assistanceteacher/store', [AssistanceTeacherController::class, 'store'])->name('assistance_teacher.store');
    Route::get('/assistanceteacher/{assistanceTeacher}', [AssistanceTeacherController::class, 'show'])->name('assistance_teacher.show');
    Route::get('/assistanceteacher/{assistanceTeacher}/edit', [AssistanceTeacherController::class, 'edit'])->name('assistance_teacher.edit');
    Route::put('/assistanceteacher/{assistanceTeacher}/update', [AssistanceTeacherController::class, 'update'])->name('assistance_teacher.update');
    Route::delete('/assistanceteacher/{assistance_teacher}/destroy', [AssistanceTeacherController::class, 'destroy'])->name('assistance_teacher.destroy');
    Route::delete('/assistanceteacher/destroymany', [AssistanceTeacherController::class, 'destroy_many'])->name('assistance_teacher.destroy_many');

    Route::get('/assistances-export', [AssistanceTeacherController::class, 'export'])->name('assistance_teacher.export');
    Route::get('/assistances-export-by-range/{ini?}/{end?}', [AssistanceTeacherController::class, 'export_by_range'])->name('assistance_teacher.export_by_range');
    Route::get('/assistances-export-by-date/{date?}', [AssistanceTeacherController::class, 'export_by_date'])->name('assistance_teacher.export_by_date');
    Route::post('/assistance-comment-ajax', [AssistanceTeacherController::class, 'assistance_comment_ajax'])->name('assistance_teacher.assistance_comment_ajax');
    Route::post('/assistance-select-teacher-ajax', [AssistanceTeacherController::class, 'select_teacher_ajax'])->name('assistance_teacher.select_teacher_ajax');
    Route::post('/assistance-temp-store-ajax', [AssistanceTeacherController::class, 'temp_store_ajax'])->name('assistance_teacher.temp_store_ajax');

    Route::get('/assistances-export/{teacher}', [TeacherController::class, 'export'])->name('teacher.export');
    Route::get('/assistances-export-by-range/{teacher}/{ini?}/{end?}', [TeacherController::class, 'export_by_range'])->name('teacher.export_by_range');
    Route::get('/assistances-export-by-date/{teacher}/{date?}', [TeacherController::class, 'export_by_date'])->name('teacher.export_by_date');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments');

    Route::get('/period', [PeriodController::class, 'index'])->name('period');


    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/{user}/update-password', [UserController::class, 'update_password'])->name('user.update_password');
    Route::get('/user/{user}/reset', [UserController::class, 'reset_password'])->name('user.reset_password');

    Route::get('/download-guide', function () {
        $ruta = public_path("Guia_de_la_plataforma_de_Registro_de_Asistencia.pdf");
        if (file_exists($ruta)) {
            return response()->download($ruta);
            } else {
            abort(404, 'Archivo no encontrado.');
        }
    })->name('download_guide');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
