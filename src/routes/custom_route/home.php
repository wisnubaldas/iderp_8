<?php
Route::get('/home/{any?}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('menu')->name('home');