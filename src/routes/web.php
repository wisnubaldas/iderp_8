<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
// include __DIR__ . '/custom_route/home.php';
// include __DIR__ . '/custom_route/dashboard.php';
// include __DIR__ . '/custom_route/survey.php';

// Auth::routes();

Route::group(['middleware' => ['auth','menu']], function () {
    include_route_files(__DIR__.'/custom_route/');
});

function include_route_files($folder)
{
    try {
        $rdi = new RecursiveDirectoryIterator($folder);
        $it = new RecursiveIteratorIterator($rdi);
        while ($it->valid()) {
            if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }
            $it->next();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}