<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\CourseApiController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\SinglePageController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\AchievementController;

Route::prefix('v1')->group(function () {
    // 相簿
    Route::get('albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('albums/{id}', [AlbumController::class, 'show'])->name('albums.show');

    // 最新消息
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{id}', [NewsController::class, 'show'])->name('news.show');

    // 文章分類
    Route::get('post-categories', [PostController::class, 'categories'])->name('post-categories.index');

    // 分類下的文章列表
    Route::get('post-categories/{category}/posts', [PostController::class, 'categoryPosts'])->name('post-categories.posts');

    // 單篇文章詳情
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // 課程列表 API
    Route::get('/courses', [CourseController::class, 'index']);

    // 單個課程詳情 API
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    // 網站設定 API
    Route::get('/setting', [SettingController::class, 'index']);

    // 常見問題 API
    Route::get('/faqs', [FaqController::class, 'index']);

    // 單頁管理 API
    Route::get('/pages', [SinglePageController::class, 'index']);
    Route::get('/pages/{slug}', [SinglePageController::class, 'show']);

    // 教師列表 API
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/{id}', [TeacherController::class, 'show']);

    // 成果展示 API
    Route::get('/achievement-categories', [AchievementController::class, 'categories']);
    Route::get('/achievement-categories/{slug}/achievements', [AchievementController::class, 'categoryAchievements']);
    Route::get('/achievements/{id}', [AchievementController::class, 'show']);
});
