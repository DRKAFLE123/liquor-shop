<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('catalogue.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/send', [PageController::class, 'contactSend'])->name('contact.send');
