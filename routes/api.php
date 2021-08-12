<?php

use Illuminate\Http\Request;

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


//Route::post('login', ['middleware' => 'cors', function(){
Route::post('login','Api\\Auth\\AuthController@login')->middleware(['cors'])->name('login');
//}]);

Route::group([

    'middleware' => ['cors','auth:api'],
    'prefix' => ''

], function ($router) {

    Route::post('logout', 'Api\\Auth\\AuthController@logout');
    Route::post('refresh', 'Api\\Auth\\AuthController@refresh');
    Route::post('me', 'Api\\Auth\\AuthController@me');
    
    

});
Route::apiResources([
    'usuarioPerfil' => 'Api\\UserPerfilController'
]);



