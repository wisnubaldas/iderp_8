<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('customer/',[App\Http\Controllers\AcuraMaster\CustomerController::class, 'index']);
    Route::get('customer/grid',[App\Http\Controllers\AcuraMaster\CustomerController::class, 'grid']);
    Route::get('customer/edit/{id}',[App\Http\Controllers\AcuraMaster\CustomerController::class, 'edit']);
    Route::post('customer/save',[App\Http\Controllers\AcuraMaster\CustomerController::class, 'save']);
});
