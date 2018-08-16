<?php

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
	return view('tarefas.index');
    //return view('layouts.welcome');
});

Route::resource('tarefas', 'TarefasController');
// Rota para salvar a reordenação da lista
Route::post('/tarefas', 'TarefasController@reorder')->name('tarefas.reordenar');
