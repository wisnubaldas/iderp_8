<?php
use App\Http\Controllers\System\UserController;
Route::prefix('system')->group(function() {
    Route::get('user_manager/{any?}',[UserController::class,'index']);
    Route::get('add_user',[UserController::class,'add_user']);
    Route::get('delete-user/{id}',[UserController::class,'delete_user']);
    Route::post('save-user',[UserController::class,'save_user']);
    Route::post('set_active',[UserController::class,'set_active']); 
    Route::match(['GET','POST'],'permission-user',[UserController::class,'add_permission']);
    Route::match(['GET','POST'],'roles-acces',[UserController::class,'add_role']);
    Route::get('roles-acces/delete-roles-ksasd-asdasd-asdasd-asd/{id}',[UserController::class,'delete_role']);
    Route::get('roles-acces/delete-permission-ksasd-asdasd-asdasd-asd/{id}',[UserController::class,'delete_permission']);
    Route::get('async/{id_role}/{method}/{id_permission}',[UserController::class,'async_can']);
});