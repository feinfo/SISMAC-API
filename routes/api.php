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

    $router->post('logout', 'Api\\Auth\\AuthController@logout');
    $router->post('refresh', 'Api\\Auth\\AuthController@refresh');
    $router->post('me', 'Api\\Auth\\AuthController@me');

});

Route::group([

    'middleware' => ['cors'],
    'prefix' => 'escola'

], function ($router) {
    $router->post('escolas', 'Api\\EscolaController@index');
    $router->post('ufEscolas', 'Api\\EscolaController@getUfEscolas');
    $router->post('etapas', 'Api\\EscolaController@getEtapas');
    $router->post('ufs', 'Api\\EscolaController@getUFs');
    $router->post('cadastrar', 'Api\\EscolaController@cadastrar');
    $router->post('editar', 'Api\\EscolaController@editar');
    $router->post('etapa/cadastrar', 'Api\\EscolaController@cadastrarEtapa');
    $router->post('filtrar', 'Api\\EscolaController@filtrar');

});

Route::group([

    'middleware' => ['cors'],
    'prefix' => 'aluno'

], function ($router) {
    $router->post('filtrar', 'Api\\AlunoController@filtrar');
    $router->post('editar', 'Api\\AlunoController@editar');
    $router->post('cadastrar', 'Api\\AlunoController@cadastrar');
});
Route::group([

    'middleware' => ['cors'],
    'prefix' => 'avaliacao'

], function ($router) {
    $router->post('etapas', 'Api\\AvaliacaoController@getEtapas');
    $router->post('filtrar', 'Api\\AvaliacaoController@filtrar');
    $router->post('cadastrar', 'Api\\AvaliacaoController@cadastrar');
    $router->post('editar', 'Api\\AvaliacaoController@editar');
});
Route::group([

    'middleware' => ['cors'],
    'prefix' => 'relatorio'

], function ($router) {
    $router->post('avaliacaoaluno', 'Api\\RelatorioController@avaliacaoAluno');
    $router->post('filtrar', 'Api\\AvaliacaoController@filtrar');
    $router->post('cadastrar', 'Api\\AvaliacaoController@cadastrar');
    $router->post('editar', 'Api\\AvaliacaoController@editar');
});

Route::apiResources([
    'usuarioPerfil' => 'Api\\UserPerfilController',
]);



