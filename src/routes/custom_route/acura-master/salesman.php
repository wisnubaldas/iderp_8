<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('salesman/',[App\Http\Controllers\AcuraMaster\SalesManController::class, 'index']);
    Route::post('salesman/',[App\Http\Controllers\AcuraMaster\SalesManController::class, 'index']);
    Route::get('salesman/grid',[App\Http\Controllers\AcuraMaster\SalesManController::class, 'grid']);
    Route::get('salesman/edit/{id}',[App\Http\Controllers\AcuraMaster\SalesManController::class, 'edit']);
    Route::post('salesman/save',[App\Http\Controllers\AcuraMaster\SalesManController::class, 'save']);


});
