<?php
use App\Http\Controllers\UserManagerController as UseMan;
Route::prefix('system')->group(function() {
    Route::get('user_manager',[UseMan::class,'index']);
});