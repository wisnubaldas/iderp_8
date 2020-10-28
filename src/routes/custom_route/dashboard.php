<?php
Route::get('dashboard/{module}',[App\Http\Controllers\DashboardController::class, 'index'])->middleware('menu')->name('dashboard');