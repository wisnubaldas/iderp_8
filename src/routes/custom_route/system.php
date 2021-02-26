<?php
use App\Http\Controllers\System\UserController;
Route::prefix('system')->group(function() {
    Route::get('user_manager/{any?}',[UserController::class,'index']);
    Route::get('add_user',[UserController::class,'add_user']);
    Route::post('set_active',[UserController::class,'set_active']); 
});