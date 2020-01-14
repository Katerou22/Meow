<?php


	Route::get('/', function () {
		return view('welcome');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');


    Route::post('/tweet', 'TweetController@tweet')->middleware('auth');


    Route::get('/avatar', 'UserController@index');

    Route::post('/home', 'UserController@addAvatar')->name('addAvatar');

    Route::get("follow/{user_id}", 'FollowerController@follow')->middleware('auth');

    Route::get("unfollow/{user_id}", 'FollowerController@unfollow')->middleware('auth');

    Route::get("delete/{tweet}", 'TweetController@delete')->middleware('auth');

    Route::get('/explorer', function() {
        return view('explorer');
    });
