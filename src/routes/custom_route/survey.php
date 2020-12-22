<?php
use App\Http\Controllers\Sal\SurveyController;

Route::prefix('report')->group(function () {
    Route::get('/survey',[SurveyController::class,'index']);
    Route::get('/survey/getDepo',[SurveyController::class,'getDepo']);
    // Route::post('/survey/submit','SurveyController@submitSurvey');
    // Route::get('/survey/status_grid','SurveyController@grid_status');
    // Route::get('/survey/get_status','SurveyController@get_status');
    // Route::get('/survey/get_customer','SurveyController@getCustomer');
    // Route::get('/survey/depo_survey/{any?}','SurveyController@depo_survey')->name('report.deposurvey');
    // Route::get('/survey/proses_depo_survey/{id}','SurveyController@proses_depo_survey')->name('report.survey.proses');
    // Route::post('/survey/save_proses_depo_survey','SurveyController@save_proses_depo_survey')->name('saveDepoProsses');
    // Route::get('/survey/post_depo_survey/{id}','SurveyController@post_depo_survey');
    // Route::post('/survey/post_depo_survey','SurveyController@update_data_survey');
    // Route::get('/survey/review_depo/{id}/{siapa?}/{user?}','SurveyController@review_depo')->name('sign_review');
    // Route::get('/survey/approve/{id}','SurveyController@approve_survey');
    // Route::post('/survey/approve/{id}','SurveyController@approve_survey');
    // Route::get('/survey/approve_kadep/{id}/{user}','SurveyController@approve_kadep');
    // Route::get('/survey/reject/{id}','SurveyController@reject_survey');
    // Route::get('/survey/print_survey/{id}','SurveyController@print_survey');
    // Route::post('/survey/upload_data_customer','SurveyController@upload_data_customer');
});
