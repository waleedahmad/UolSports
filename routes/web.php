<?php


Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isAdmin']], function(){
    Route::get('/', 'AppController@getIndex');
    Route::get('/trials/requests', 'AppController@getTrialRequests');

    Route::post('/sport/trial/request', 'SportsController@requestTrial');
});

Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isNotAdmin']], function(){
    Route::get('/admin', 'AdminController@index');

    // Admin /users routes
    Route::get('/admin/users', 'AdminController@getUsers');
    Route::post('/admin/approve/user', 'AdminController@approveUser');
    Route::post('/admin/disapprove/user', 'AdminController@disapproveUser');

    Route::get('/admin/sports', 'AdminController@getSports');
    Route::post('/admin/sports/enable', 'AdminController@enableSport');
    Route::post('/admin/sports/disable', 'AdminController@disableSport');

    Route::get('/admin/players', 'AdminController@getPlayers');
    Route::get('/admin/trial/requests', 'AdminController@getSportsJoinRequests');
    Route::get('/admin/trials', 'AdminController@getTrials');
    Route::get('/admin/teams', 'AdminController@getTeams');
    Route::get('/admin/events', 'AdminController@getEvents');
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