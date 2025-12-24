<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

// Route to FrontController's viewPage method
Route::get('/view-page', [
    frontController::class, 
    'viewPage'
    ])->name('viewPage');

Route::get('/add-new', [
    staffController::class, 
    'staffView'
    ])->name('staffView');

Route::get('/staff-list', [
    StaffController::class,
    'staffList'
    ])->name('staffList');

Route::get('/staff/{id}/edit', [
    StaffController::class,
    'edit'
    ])->name('staff.edit');

Route::put('/staff/{id}', [
    StaffController::class,
    'update'
    ])->name('staff.update');

Route::delete('/staff/{id}', [
    StaffController::class,
    'destroy'
    ])->name('staff.destroy');

// Handle staff creation form
Route::post('/staff', [
    StaffController::class,
    'staff'
    ])->name('staff.store');


// --- Teacher routes (mirrors staff) ---
// Show add teacher form
Route::get('/add-teacher', [
    TeacherController::class,
    'teacherView'
    ])->name('teacherView');

Route::get('/teacher-list', [
    TeacherController::class,
    'teacherList'
    ])->name('teacherList');

Route::get('/teacher/{id}/edit', [
    TeacherController::class,
    'edit'
    ])->name('teacher.edit');

Route::put('/teacher/{id}', [
    TeacherController::class,
    'update'
    ])->name('teacher.update');

Route::delete('/teacher/{id}', [
    TeacherController::class,
    'destroy'
    ])->name('teacher.destroy');

// Handle teacher creation form
Route::post('/teacher', [
    TeacherController::class,
    'teacher'
    ])->name('teacher.store');


// --- Student routes (mirrors staff) ---
// Show add student form
Route::get('/add-student', [
    StudentController::class, 
    'studentView'
    ])->name('studentView');

Route::get('/student-list', [
    StudentController::class,
    'studentList'
    ])->name('studentList');

Route::get('/student/{id}/edit', [
    StudentController::class,
    'edit'
    ])->name('student.edit');

Route::put('/student/{id}', [
    StudentController::class,
    'update'
    ])->name('student.update');

Route::delete('/student/{id}', [
    StudentController::class,
    'destroy'
    ])->name('student.destroy');

// Handle student creation form
Route::post('/student', [
    StudentController::class,
    'student'
    ])->name('student.store');

