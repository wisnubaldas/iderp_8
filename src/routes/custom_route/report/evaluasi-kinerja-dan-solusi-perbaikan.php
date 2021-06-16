<?php
Route::group(['prefix'=>'report'],function(){
    Route::match(['get', 'post'], 'evaluasi-kinerja-dan-solusi-perbaikan', [App\Http\Controllers\Report\EvaluasiKerjaController::class, 'index']);
    // Route::controller('evaluasi-kinerja-dan-solusi-perbaikan',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'index']);
    // Route::post('evaluasi-kinerja-dan-solusi-perbaikan',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'get_evaluasi']);
    Route::get('evaluasi-kinerja-dan-solusi-perbaikan/upload_data/{status?}',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'upload_data']);
    Route::post('evaluasi-kinerja-dan-solusi-perbaikan/upload_data/{status?}',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'upload_data']);
    Route::post('post-data-evaluasi',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'post_data_evaluasi']);
    Route::post('pdf-data-evaluasi',[App\Http\Controllers\Report\EvaluasiKerjaController::class, 'pdf_evaluasi']);
});
