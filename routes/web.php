<?php


Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isAdmin']], function(){
    Route::get('/', 'AppController@getIndex');
});

Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isNotAdmin']], function(){
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/players', 'AdminController@getPlayers');
    Route::get('/admin/teams', 'AdminController@getTeams');
    Route::get('/admin/trials', 'AdminController@getTrials');
    Route::get('/admin/trial/requests', 'AdminController@getTrialRequests');
    Route::get('/admin/events', 'AdminController@getEvents');
    Route::get('/admin/matches', 'AdminController@getMatches');

});

Route::group(['middleware'  =>  ['auth', 'isVerified']], function(){
    Route::get('/verification', 'AuthController@getVerificationForm');
    Route::post('/verification', 'AuthController@processVerification');
});

Route::group(['middleware'   =>  ['auth']], function(){
    Route::get('/logout', 'AuthController@logout');
});


Route::group(['middleware'  =>  ['guest']], function(){

    // Show Registration and Login form
    Route::get('/register', 'AuthController@getRegister');
    Route::get('/login', 'AuthController@getLogin');

    // Register and Authenticate User
    Route::post('/register', 'AuthController@registerUser');
    Route::post('/login','AuthController@authenticateUser');
});