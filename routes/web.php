<?php


Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isAdmin']], function(){
    Route::get('/', 'AppController@getIndex');
});

Route::group(['middleware'  =>  ['auth', 'isNotVerified', 'isNotAdmin']], function(){
    Route::get('/admin', 'AdminController@getVerificationRequests');
});

Route::group(['middleware'  =>  ['auth', 'isVerified']], function(){
    Route::get('/verification', 'AuthController@getVerificationForm');
    Route::post('/verification', 'AuthController@processVerification');
});


Route::group(['middleware'  =>  ['guest']], function(){

    // Show Registration and Login form
    Route::get('/register', 'AuthController@getRegister');
    Route::get('/login', 'AuthController@getLogin');

    // Register and Authenticate User
    Route::post('/register', 'AuthController@registerUser');
    Route::post('/login','AuthController@authenticateUser');
});