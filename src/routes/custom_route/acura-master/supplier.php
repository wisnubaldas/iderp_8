<?php
Route::group(['prefix'=>'acura-master'],function(){
    Route::get('supplier/',[App\Http\Controllers\AcuraMaster\SupplierController::class, 'index']);
    Route::get('supplier/grid',[App\Http\Controllers\AcuraMaster\SupplierController::class, 'grid']);
    Route::get('supplier/edit/{id}',[App\Http\Controllers\AcuraMaster\SupplierController::class, 'edit']);
    Route::post('supplier/save',[App\Http\Controllers\AcuraMaster\SupplierController::class, 'save']);
});
