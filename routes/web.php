<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('backend.master');
});

Route::get('/', function () {
    return view('frontend.master');
});

Route::get('/index',[ProductController::class,'index'])->name('index');
Route::get('/create',[ProductController::class,'create'])->name('create');
Route::post('/store',[ProductController::class,'store'])->name('store');
Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
Route::post('/update/{id}',[ProductController::class,'update'])->name('update');
Route::get('/delete/{id}',[ProductController::class,'delete'])->name('delete');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
