<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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

Route::name('frontend.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])
            ->name('home.index');
        Route::get('/{slug}', [HomeController::class, 'tag'])
            ->name('home.tag');
        Route::get('/publication/{slug}', [HomeController::class, 'publicationView'])
            ->name('home.publication.view');

        Route::get('comment/crate', function () {
            throw new BadRequestHttpException();
        });
        Route::post('comment/crate', [CommentController::class, 'create'])
            ->name('comment.create');

    });
