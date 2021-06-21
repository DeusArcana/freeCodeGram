<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|*/

Auth::routes();

Route::post('follow/{user}', 'FollowsController@store');

Route::resource('posts', 'PostsController')->except('index');
Route::get('/', 'PostsController@index')->name('posts.index');

				
Route::resource('user', 'ProfilesController',
				['names' => [
					'show' => 'profile.show',
					'edit' => 'profile.edit',
					'update' => 'profile.update'
				]
			])->only(['show', 'edit', 'update']);
