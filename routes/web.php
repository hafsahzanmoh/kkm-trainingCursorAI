<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/visitors', [App\Http\Controllers\VisitorController::class, 'index'])->name('visitors.index');
Route::get('/visitors/create', [App\Http\Controllers\VisitorController::class, 'create'])->name('visitors.create');
Route::post('/visitors/create', [App\Http\Controllers\VisitorController::class, 'store'])->name('visitors.store');
Route::get('/visitors/{visitor}', [App\Http\Controllers\VisitorController::class, 'show'])->name('visitors.show'); 
Route::get('/visitors/{visitor}/edit', [App\Http\Controllers\VisitorController::class, 'edit'])->name('visitors.edit');
Route::post('/visitors/{visitor}/edit', [App\Http\Controllers\VisitorController::class, 'update'])->name('visitors.update');
Route::get('/visitors/{visitor}/delete', [App\Http\Controllers\VisitorController::class, 'delete'])->name('visitors.delete');

Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs/create', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/{blog}/edit', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
Route::get('/blogs/{blog}/delete', [App\Http\Controllers\BlogController::class, 'delete'])->name('blogs.delete');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

Route::middleware('auth')->group(function () {
    Route::get('/Notification', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/Notification/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::delete('/Notification/delete-all', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
    Route::get('/Notification/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::delete('/Notification/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
