<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/save')->group(function (){
        Route::post('/team', 'TeamController@save');
        Route::post('/member', 'MemberController@saveFirstMembersOfFirstTeam');
    });

    Route::prefix('/dashboard')->group(function () {
        Route::get('/info', 'UserController@show')->name('dashboard.show');
        Route::prefix('/save')->group(function () {
            Route::post('/team', 'TeamController@save');
            Route::post('/member', 'MemberController@saveMembersOfOthersTeams');
            Route::post('/board', 'BoardController@save');
        });

        Route::prefix('/team')->group(function (){
            Route::post('/about', 'TeamController@show');
            Route::post('/update', 'TeamController@update');
            Route::post('/delete', 'TeamController@delete');
        });

        Route::prefix('/board')->group(function () {
            Route::get('/about/{id}', 'BoardController@view');
            Route::prefix("/update")->group(function (){
                Route::post('/name', 'BoardController@updateName');
                Route::post('/owner', 'BoardController@updateOwner');
            });
        });
    });

    Route::prefix('/ressources')->group(function () {
        Route::get('/category', 'FrontEndController@getAllCategoryList');
        Route::get('/board/backgroundImage', 'FrontEndController@getBoardBackgroundImages');
    });


});

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('/register', 'AuthController@register');


Route::prefix('/postman')->group(function () {
    Route::get('/login', function () {
        Auth::loginUsingId(2);
        return response()->json('Authenticated', 200);
    });
    Route::get('/logout', function () {
        Auth::logout();
        return response()->json('Logged Out', 200);
    });


});
