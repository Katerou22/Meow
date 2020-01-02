<?php


	Route::get('/', function () {
		return view('welcome');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');


	Route::post('/tweet', 'TweetController@tweet')->middleware('auth');
