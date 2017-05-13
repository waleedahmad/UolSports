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
    Route::delete('/admin/users', 'AdminController@deleteUser');
    Route::post('/admin/approve/user', 'AdminController@approveUser');
    Route::post('/admin/disapprove/user', 'AdminController@disapproveUser');

    Route::get('/admin/sports', 'AdminController@getSports');
    Route::post('/admin/sports/enable', 'AdminController@enableSport');
    Route::post('/admin/sports/disable', 'AdminController@disableSport');
    Route::get('/admin/sports/teams', 'AdminController@getSportTeams');


    Route::get('/admin/trial/requests', 'AdminController@getSportsJoinRequests');
    Route::get('/admin/trial', 'AdminController@getTrialInfo');
    Route::post('/admin/trial', 'AdminController@processTrialRequest');
    Route::delete('/admin/trial', 'AdminController@deleteTrial');


    Route::get('/admin/trials', 'AdminController@getTrials');
    Route::get('/admin/trials/reject', 'AdminController@rejectPlayer');

    Route::post('/admin/players/assign', 'AdminController@assignTeamToPlayer');
    Route::delete('/admin/players/remove', 'AdminController@removePlayerFromTeam');

    Route::get('/admin/teams', 'AdminController@getTeams');
    Route::get('/admin/teams/edit/{id}','AdminController@editTeam');
    Route::post('/admin/teams/update','AdminController@updateTeam');
    Route::get('/admin/team', 'AdminController@getTeamPlayers');
    Route::delete('/admin/team', 'AdminController@deleteTeam');
    Route::get('/admin/teams/add', 'AdminController@addTeams');
    Route::post('/admin/teams/add', 'AdminController@createTeams');

    Route::get('/admin/events', 'AdminController@getEvents');
    Route::get('/admin/events/create', 'AdminController@getEventForm');
    Route::get('/admin/events', 'AdminController@getEvents');

    Route::post('/admin/event/result', 'AdminController@createOrUpdateEventResult');
    Route::delete('/admin/event/result', 'AdminController@deleteEventResult');

    Route::get('/admin/events/{id}/edit', 'AdminController@editEvent');
    Route::get('/admin/events/{id}/results', 'AdminController@getEventResults');


    Route::post('/admin/event', 'AdminController@createEvent');
    Route::delete('/admin/event', 'AdminController@deleteEvent');
    Route::put('/admin/event', 'AdminController@updateEvent');
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