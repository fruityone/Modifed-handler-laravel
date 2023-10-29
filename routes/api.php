<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserEmailController;
use App\Http\Controllers\UserPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/send-reset-email',[UserPasswordController::class,'sendResetEmail']);
Route::post('/upload-image',[ImageController::class,'uploadImage']);
Route::post('/create-blog',[BlogController::class,'create']);
Route::get('/blogs',[BlogController::class,'index']);
Route::post('/blog/{id}/create-article',[ArticleController::class,'create']);
Route::get('/all-articles',[ArticleController::class,'index']);
Route::post('/reset-password',[UserPasswordController::class,'resetPassword']);
Route::get('/search',[SearchController::class,'index']);

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::post('/send-email',[UserEmailController::class,'sendEmail']);
    Route::post('/change-email',[UserEmailController::class,'changeEmail']);
    Route::post('/blog/{id}/create-comment',[CommentController::class,'createBlogComment']);
    Route::post('/article/{id}/create-comment',[CommentController::class,'createArticleComment']);
    Route::post('/blog/{id}/like',[LikeController::class,'createBlogLike']);
    Route::post('/article/{id}/like',[LikeController::class,'createArticleLike']);
    Route::post('/logout',[AuthController::class,'logout']);
});
