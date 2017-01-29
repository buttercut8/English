<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => ['web']],function(){
    Route::get('/',[
        'uses' => 'UserController@getLogin',
        'as' => 'user.login'
    ])->middleware('guest');

    Route::post('login',[
        'uses' => 'UserController@postLogin',
    ]);

    Route::post('edit-password',[
        'uses' => 'UserController@editPassword'
    ]);

    Route::get('logout',[
        'uses' => 'UserController@logout',
        'as'   => 'user.logout'
    ])->middleware('auth');


    Route::post('register',[
        'uses' => 'UserController@postRegister',
    ]);

});
// todo
Route::group(['middleware' => 'auth'],function(){
    Route::get('todo-list',[
        'uses' => 'TodoController@view',
        'as' => 'todo.view'
    ]);

    Route::get('chat-room',[
        'uses' => 'TodoController@view',
        'as' => 'chat.room.view'
    ]);
    Route::get('listening-music',[
        'uses' => 'TodoController@view',
        'as' => 'listening.music.view'
    ]);






    Route::post('create-new-todo',[
        'uses' => 'TodoController@postCreateNew',
    ]);

    Route::post('infomation-user',[
        'uses' => 'UserController@infomationUser'
    ]);

    Route::post('update-account',[
        'uses' => 'UserController@updateAccount'
    ]);

    Route::get('list-todo',[
        'uses' => 'TodoController@listTodo'
    ]);

    Route::post('pagination-list-todo',[
        'uses' => 'TodoController@paginationListTodo'
    ]);


});




// $nexmo = app('Nexmo\Client');
// $nexmo->message()->send([
//     'to' => '841665581477',
//     'from' => 'NEXMO',
//     'text' => 'Using the instance to send a message.'
//     secret  71ca774ae5ce40cb
//     'key' => bd95b190
// ]);

//
// 'api_key' => 'bd95b190',
// 'api_secret' => '71ca774ae5ce40cb',
