<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('angkutan/',[App\Http\Controllers\AcuraMaster\AngkutanController::class, 'index']);
    Route::get('angkutan/grid',[App\Http\Controllers\AcuraMaster\AngkutanController::class, 'grid']);
    Route::get('angkutan/edit/{id}',[App\Http\Controllers\AcuraMaster\AngkutanController::class, 'edit']);
    Route::post('angkutan/save',[App\Http\Controllers\AcuraMaster\AngkutanController::class, 'save']);
});
