<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UploadsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
  // Dashboard Route
  Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
  })->name('dashboard');

  // Events Resource Routes
  Route::resource('events', EventsController::class);

  Route::get('/catalogue', function () {
    return Inertia::render('Catalogue/Index');
  })->name('catalogue');

  // Profile Routes
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // API Routes
  Route::prefix('api')->group(function () {
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/uploads', [UploadsController::class, 'store'])->name('api.uploads');
  });
});

require __DIR__.'/auth.php';
