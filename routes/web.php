<?php

use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\SingInController;
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

//Route::get('/', function () {
//    return view('admin/index');
//});

Route::get('/admin', [DefaultController::class, 'index']);

Route::get('/', [SingInController::class, 'index']);
Route::post('sing-in/login', [SingInController::class, 'login']);
