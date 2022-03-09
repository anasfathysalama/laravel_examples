<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::post("books", [BooksController::class, 'store'])->middleware('auth');
Route::get("books/create", [BooksController::class, 'create'])->middleware("can:create,App\Models\Book");
