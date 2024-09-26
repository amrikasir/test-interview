<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'insert'])->name('kategori.new');
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    Route::post('/tugas', [TugasController::class, 'insert'])->name('tugas.new');
    Route::get('/tugas/edit/{id}', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::post('/tugas/update/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::get('/tugas/delete/{id}', [TugasController::class, 'delete'])->name('tugas.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

require __DIR__.'/auth.php';
