<?php
Route::get('/home/{any?}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('menu')->name('home');
Route::get('/tes',[App\Http\Controllers\HomeController::class, 'tes']);