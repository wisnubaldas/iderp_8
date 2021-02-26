<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('coa/{any?}',[App\Http\Controllers\AcuraMaster\CoaController::class, 'index']);
    Route::get('coa/grid',[App\Http\Controllers\AcuraMaster\CoaController::class, 'grid']);
    Route::post('coa/check_id/{id}',[App\Http\Controllers\AcuraMaster\CoaController::class, 'check_id']);
});
