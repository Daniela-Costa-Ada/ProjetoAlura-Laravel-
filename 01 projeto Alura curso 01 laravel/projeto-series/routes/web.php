<?php
use Illuminate\Support\Facades\Route;
//Route::get('/series', 'SeriesController@index');
// Route::get('/', 'SeriesController@index');
// Route::get('series/criar', 'SeriesController@create');
// Route::post('series/criar', 'SeriesController@index');
// Route::get('/',[SeriesController::class, 'index']);
// Route::get('/series',[SeriesController::class, 'index']);
// Route::get('series/criar',[SeriesController::class, 'create']); //chama o formulario
// Route::post('series/criar',[SeriesController::class, 'store']); //chama o método de criar a série
 
Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('series/criar', 'SeriesController@create')
->name('form_criar_serie');
Route::post('series/criar', 'SeriesController@store');
//Route::post('series/remover/{id }', 'SeriesController@destroy');
Route::delete('/series/{id}', 'SeriesController@destroy');

