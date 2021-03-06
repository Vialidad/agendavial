<?php

Route::get('welcome', function()
{
	return view('welcome');
});


Route::get('/',[
	'as' 	=> 'tickets.open',
	'uses'  => 'TicketsController@open'
	]);

Route::get('/popular',[
	'as' 	=> 'tickets.popular',
	'uses'  => 'TicketsController@popular'
	]);

Route::get('/pendientes',[
	'as' 	=> 'tickets.open',
	'uses'  => 'TicketsController@open'
	]);

Route::get('/finalizadas',[
	'as' 	=> 'tickets.closed',
	'uses'  => 'TicketsController@closed'
	]);

Route::get('/solicitud/{id}',[
	'as' 	=> 'tickets.details',
	'uses'  => 'TicketsController@details'
	]);

Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::group(['middleware' => ['auth']], function () {
	//Crear solicitudes
	Route::get('/solicitar', [
		'as' 	=> 'tickets.create',
		'uses' 	=> 'TicketsController@create'
		]);

	Route::post('/solicitar', [
		'as' 	=> 'tickets.store',
		'uses' 	=> 'TicketsController@store'
		]);

	//Votar
	Route::post('votar/{id}', [
		'as' 	=> 'votes.submit',
		'uses' 	=> 'VotesController@submit'
		]);

	Route::delete('votar/{id}',[
		'as'	=> 'votes.destroy',
		'uses'	=> 'VotesController@destroy'
		]);

	//Comentar
	Route::post('comentar/{id}', [
	    'as'    => 'comments.submit',
        'uses'  => 'CommentsController@submit',
    ]);

    //cambiar status
    Route::get('/status/{id}', [
		'as' 	=> 'tickets.status',
		'uses' 	=> 'TicketsController@status'
		]);

});

Route::get("test-email", 'TicketsController@sendMail' );
