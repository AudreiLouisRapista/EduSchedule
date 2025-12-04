<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------*-
-----------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', function () {
    return view('welcome');
});

Route::get('/', [MainController::class, 'main'])->name('login');
Route::post('/authenticate', [MainController::class, 'auth_user'])->name('auth_user');
Route::post('/save_teacher', [MainController::class, 'save_teacher'])->name('save_teacher');
Route::post('/save_schedule', [MainController::class, 'save_schedule'])->name('save_schedule');
Route::post('/save_subjects', [MainController::class, 'save_subjects'])->name('save_subjects');
Route::post('/save_section', [MainController::class, 'save_section'])->name('save_section');
Route::post('/deact_teacher', [MainController::class, 'deact_teacher'])->name('deact_teacher');
Route::post('/delete_schedule', [MainController::class, 'delete_schedule'])->name('delete_schedule');
Route::post('/update_schedule', [MainController::class, 'update_schedule'])->name('update_schedule');
Route::post('/update_teacher/{teachers_id}', [MainController::class, 'update_teacher'])->name('update_teacher');





// UPDATED: Renamed the route to 'dashboard' for consistency and clarity
Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

// NEW ROUTE: Added the named route for the Profile page
Route::get('/profile', [MainController::class, 'profile'])->name('profile');
Route::get('/schedule', [MainController::class, 'schedule'])->name('schedule');
Route::get('/subject', [MainController::class, 'subject'])->name('subject');
Route::get('/view_section', [MainController::class, 'view_section'])->name('view_section');
Route::get('/TeacherUI', [MainController::class, 'TeacherUI'])->name('TeacherUI');
Route::get('/view_subject', [MainController::class, 'view_subject'])->name('view_subject');
Route::get('/teachers', [MainController::class, 'teachers'])->name('teachers');
Route::get('/view_teachers', [MainController::class, 'view_teachers'])->name('view_teachers');
Route::get('/view_schedule', [MainController::class, 'view_schedule'])->name('view_schedule');
Route::get('/view_grade1', [MainController::class, 'view_grade1'])->name('view_grade1');
Route::get('/view_grade2', [MainController::class, 'view_grade2'])->name('view_grade2');
Route::get('/teacher_status', [MainController::class, 'teacher_status'])->name('teacher_status');
Route::get('/update_subject', [MainController::class, 'update_subject'])->name('update_subject');
Route::get('/updateTeacherStatus', [MainController::class, 'updateTeacherStatus'])->name('updateTeacherStatus');



Route::get('/logout', [MainController::class, 'logout'])->name('logout');

