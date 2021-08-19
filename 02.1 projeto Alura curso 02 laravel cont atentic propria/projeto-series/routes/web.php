<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route; 
Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('autenticador');
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')     
    ->middleware('autenticador');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');
//Auth::routes();
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});
Route::get('/buscarSeriesJS', function () {    
    return \App\Serie::all();
});

// Route::get('/enviando-email', function(){
//     $email = new \App\Mail\NovaSerie('Arrow',
//      5,
//       10
//     );
//     $email->subject = 'Nova Serie Adicionada';
// $user = (object)[
//     'email' => 'daniela.costa@email.com', 
//     'name' => 'Daniela'
// ];
// Mail::to($user)->send($email);
//     return 'Email enviado'; 
// });

