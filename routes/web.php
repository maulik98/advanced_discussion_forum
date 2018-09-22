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
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/channels','ChannelsController');

Route::get('channel.delete',[
    'uses' => 'ChannelsController@destroy',
    'as' => 'channel.delete'
]);

Route::get('/profile',[
   'uses' => 'UserController@edit',
    'as' => 'profile.edit'
]);

Route::post('profile/update/{id}',[
    'uses' => 'UserController@update',
    'as' => 'profile.update'
]);

/*Discussion Controller Routes*/
Route::get('/discussion/create',[
    'uses' => 'DiscussionController@create',
    'as' => 'discussion.create'
]);

Route::post('discussion/store',[
    'uses' => 'DiscussionController@store',
    'as' => 'discussion.store'
]);

Route::get('discussion/edit/{id}/{slug}',[
   'uses' => 'DiscussionController@edit',
    'as' => 'discussion.edit'
]);

Route::get('discussion/delete/{id}',[
    'uses' => 'DiscussionController@destroy',
    'as' => 'discussion.delete'
]);

Route::post('discussion/update/{id}/{slug}',[
    'uses' => 'DiscussionController@update',
    'as' => 'discussion.update'
]);

Route::post('discussion/reply/{id}',[
    'uses' => 'DiscussionController@reply_store',
    'as' => 'discussion.reply.store'
]);

/* Replies Controller Routes*/

Route::get('discussion/reply/edit/{id}',[
    'uses' => 'RepliesController@edit',
    'as' => 'discussion.reply.edit'
]);

Route::post('discussion/reply/update/{id}',[
    'uses' => 'RepliesController@update',
    'as' => 'discussion.reply.update'
]);

/*Route::get('discussion/{id}/{slug}',[
    'uses' => 'DiscussionController@show',
    'as' => 'discussion.reply.view'
]);*/

Route::get('reply/like/{id}',[
   'uses' => 'RepliesController@like',
   'as' => 'reply.like'
]);

Route::get('reply/unlike/{id}',[
    'uses' => 'RepliesController@unlike',
    'as' => 'reply.unlike'
]);

Route::get('replies/best_answer/{id}',[
    'uses' => 'RepliesController@best_answer',
    'as' => 'reply.best_answer'
]);

/*Forum Controller Routes*/
Route::get('forum',[
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);

Route::get('forum/discussion/{id}/{slug}',[
    'uses' => 'ForumsController@show',
    'as' => 'forum.view'
]);

Route::get('channel/{slug}',[
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);

/*Watcher Controller Routes*/

Route::get('discussion/watch/{id}',[
    'uses' => 'WatchersController@watch',
    'as' => 'discussion.watch'
]);

Route::get('discussion/unwatch/{id}',[
    'uses' => 'WatchersController@unwatch',
    'as' => 'discussion.unwatch'
]);