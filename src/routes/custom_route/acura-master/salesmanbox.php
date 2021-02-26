<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('salesmanbox/',[App\Http\Controllers\AcuraMaster\SalesManBoxController::class, 'index']);
    Route::get('salesmanbox/grid',[App\Http\Controllers\AcuraMaster\SalesManBoxController::class, 'grid']);
    Route::get('salesmanbox/edit/{id}',[App\Http\Controllers\AcuraMaster\SalesManBoxController::class, 'edit']);
    Route::post('salesmanbox/save',[App\Http\Controllers\AcuraMaster\SalesManBoxController::class, 'save']);
});
