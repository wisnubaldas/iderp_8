<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('area_jual/',[App\Http\Controllers\AcuraMaster\AreaJualController::class, 'index']);
    Route::get('area_jual/grid',[App\Http\Controllers\AcuraMaster\AreaJualController::class, 'grid']);
    Route::get('area_jual/edit/{id}',[App\Http\Controllers\AcuraMaster\AreaJualController::class, 'edit']);
    Route::post('area_jual/save',[App\Http\Controllers\AcuraMaster\AreaJualController::class, 'save']);
});
