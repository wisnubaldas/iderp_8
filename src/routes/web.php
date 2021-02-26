<?php

use Illuminate\Support\Facades\Route;
use App\Library\MyHelper;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/all_depo',[App\Http\Controllers\Auth\RegisterController::class, 'all_depo']);
Route::get('/terimakasih',[App\Http\Controllers\Auth\RegisterController::class, 'terimakasih']);

Auth::routes();
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::group(['middleware' => ['auth','menu']], function () {
    MyHelper::include_route_files(__DIR__.'/custom_route/');
});
