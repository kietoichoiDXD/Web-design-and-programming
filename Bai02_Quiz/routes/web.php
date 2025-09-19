<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes - Bài 02: Quiz System
|--------------------------------------------------------------------------
|
| Routes cho hệ thống bài thi trắc nghiệm đọc từ file text
|
*/

// Quiz routes
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.start');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');
Route::get('/quiz/restart', [QuizController::class, 'restart'])->name('quiz.restart');