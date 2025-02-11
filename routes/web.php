<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FaqController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
