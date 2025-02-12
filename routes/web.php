<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AchievementController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/achievements/category/{slug}', [AchievementController::class, 'category'])->name('achievements.category');
Route::get('/achievements/{id}', [AchievementController::class, 'show'])->name('achievements.show');
