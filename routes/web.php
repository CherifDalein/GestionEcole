<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\classeController;
use App\Http\Controllers\inscriptionController;
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
    return view('index');
});
// Pour le Module
Route::prefix('modules')->name('module.')->group(function(){
    Route::get('/', [ModuleController::class, 'index']);
    Route::get('/add', [ModuleController::class, 'create'])->name('add');
    Route::post('/add', [ModuleController::class, 'store'])->name('store');
    Route::post('/toggle/{id}', [ModuleController::class, 'state'])->name('state');
    Route::delete('/delete/{id}', [ModuleController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ModuleController::class, 'update'])->name('update');
    Route::get('/show/{id}', [ModuleController::class, 'show'])->name('show');
});

// Pour les Classes
Route::prefix('classe')->name('classe.')->group(function(){
    Route::get('/', [classeController::class, 'index']);
    Route::get('/add', [classeController::class, 'create'])->name('add');
    Route::post('/add', [classeController::class, 'store'])->name('store');
    Route::post('/toggle/{id}', [classeController::class, 'state'])->name('state');
    Route::delete('/delete/{id}', [classeController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [classeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [classeController::class, 'update'])->name('update');
    Route::get('/show/{id}', [classeController::class, 'show'])->name('show');
});

// Pour les Inscriptions
Route::prefix('inscription')->name('inscription.')->group(function(){
    Route::get('/', [inscriptionController::class, 'index']);
    Route::get('/add', [inscriptionController::class, 'create'])->name('add');
    Route::post('/add', [inscriptionController::class, 'store'])->name('store');
    Route::post('/toggle/{id}', [inscriptionController::class, 'state'])->name('state');
    Route::delete('/delete/{id}', [inscriptionController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [inscriptionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [inscriptionController::class, 'update'])->name('update');
    Route::get('/show/{id}', [inscriptionController::class, 'show'])->name('show');
});














Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
