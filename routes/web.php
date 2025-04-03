<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssistanceTeacherController;
use App\Http\Controllers\PeriodController;
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
    Route::delete('/teacher/{teacher}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');

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

    Route::get('/assistances-export/{teacher}', [TeacherController::class, 'export'])->name('teacher.export');

    Route::get('/period', [PeriodController::class, 'index'])->name('period');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
