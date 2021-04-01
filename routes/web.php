<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FeedbackController;
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
        Route::get('/about', [HomeController::class, 'about'])
            ->name('home.about');
        Route::get('/contact', [HomeController::class, 'contact'])
            ->name('home.contact');
        Route::get('/{slug}', [HomeController::class, 'tag'])
            ->name('home.tag');
        Route::get('/publication/{slug}', [HomeController::class, 'publicationView'])
            ->name('home.publication.view');

        Route::get('comment/create', function () {
            throw new BadRequestHttpException();
        });
        Route::post('comment/create', [CommentController::class, 'create'])
            ->name('comment.create');

        Route::get('feedback/create', function () {
            throw new BadRequestHttpException();
        });
        Route::post('feedback/create', [FeedbackController::class, 'create'])
            ->name('feedback.create');
    });
