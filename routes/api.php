<?php

use App\Http\Controllers\Admin\Password\CodeCheckController;
use App\Http\Controllers\Admin\Password\ForgotPasswordController;
use App\Http\Controllers\Admin\Password\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login',\App\Http\Controllers\Admin\Auth\LoginController::class);
Route::post('auth/register',\App\Http\Controllers\Admin\Auth\RegisterController::class);

Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('auth/logout',\App\Http\Controllers\Admin\Auth\LogoutController::class);
    Route::post('auth/me',\App\Http\Controllers\Admin\Auth\MeController::class);

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/',\App\Http\Controllers\Admin\Main\IndexController::class);
        Route::group(['prefix' => 'account'], function (){
            Route::get('/',\App\Http\Controllers\Admin\Account\IndexController::class);
            Route::post('/{user}',\App\Http\Controllers\Admin\Account\UpdateController::class);
        });

        Route::group(['prefix' => 'categories'], function (){
            Route::get('/',\App\Http\Controllers\Admin\Category\IndexController::class);
            Route::post('/store',\App\Http\Controllers\Admin\Category\StoreController::class);
            Route::get('/{category}',\App\Http\Controllers\Admin\Category\ShowController::class);
            Route::put('/{category}',\App\Http\Controllers\Admin\Category\UpdateController::class);
            Route::delete('/{category}',\App\Http\Controllers\Admin\Category\DeleteController::class);
        });

        Route::group(['prefix' => 'tags'], function (){
            Route::get('/',\App\Http\Controllers\Admin\Tag\IndexController::class);
            Route::post('/store',\App\Http\Controllers\Admin\Tag\StoreController::class);
            Route::get('/{tag}',\App\Http\Controllers\Admin\Tag\ShowController::class);
            Route::put('/{tag}',\App\Http\Controllers\Admin\Tag\UpdateController::class);
            Route::delete('/{tag}',\App\Http\Controllers\Admin\Tag\DeleteController::class);
        });

        Route::group(['prefix' => 'users'], function (){
            Route::get('/',\App\Http\Controllers\Admin\User\IndexController::class);
            Route::get('/role',\App\Http\Controllers\Admin\User\UserRoleController::class);
            Route::post('/store',\App\Http\Controllers\Admin\User\StoreController::class);
            Route::get('/{user}',\App\Http\Controllers\Admin\User\ShowController::class);
            Route::put('/{user}',\App\Http\Controllers\Admin\User\UpdateController::class);
            Route::delete('/{user}',\App\Http\Controllers\Admin\User\DeleteController::class);

        });

        Route::group(['prefix' => 'posts'], function (){
            Route::get('/',\App\Http\Controllers\Admin\Post\IndexController::class);
            Route::get('/category',\App\Http\Controllers\Admin\Post\PostCategoryController::class);
            Route::get('/tags',\App\Http\Controllers\Admin\Post\PostTagsController::class);
            Route::post('/store',\App\Http\Controllers\Admin\Post\StoreController::class);
            Route::get('/{post}',\App\Http\Controllers\Admin\Post\ShowController::class);
            Route::put('/{post}',\App\Http\Controllers\Admin\Post\UpdateController::class);
            Route::delete('/{post}',\App\Http\Controllers\Admin\Post\DeleteController::class);
        });
    });




});

Route::group(['prefix' => 'categories'], function (){
    Route::get('/',\App\Http\Controllers\Front\Category\IndexController::class);
//        Route::post('/store',\App\Http\Controllers\Admin\Category\StoreController::class);
//        Route::get('/{category}',\App\Http\Controllers\Admin\Category\ShowController::class);
//        Route::put('/{category}',\App\Http\Controllers\Admin\Category\UpdateController::class);
//        Route::delete('/{category}',\App\Http\Controllers\Admin\Category\DeleteController::class);
});

Route::group(['prefix' => 'tags'], function (){
    Route::get('/',\App\Http\Controllers\Front\Tag\IndexController::class);
//        Route::post('/store',\App\Http\Controllers\Admin\Category\StoreController::class);
//        Route::get('/{category}',\App\Http\Controllers\Admin\Category\ShowController::class);
//        Route::put('/{category}',\App\Http\Controllers\Admin\Category\UpdateController::class);
//        Route::delete('/{category}',\App\Http\Controllers\Admin\Category\DeleteController::class);
});

Route::group(['prefix' => 'posts'], function (){
          Route::get('/home',\App\Http\Controllers\Front\Post\HomeController::class);
          Route::get('/',\App\Http\Controllers\Front\Post\IndexController::class);
          Route::get('/{post}',\App\Http\Controllers\Front\Post\ShowController::class);
});

Route::group(['prefix' => 'contacts'], function (){
    Route::post('/send',\App\Http\Controllers\Front\Contact\MailController::class);
});



