<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'api/v1'], function(){
    // User Routing
    Route::resource('users', 'UsersController');
    Route::resource('groups', 'GroupsController');
    Route::post('login', 'UsersController@login');
});


Route::group(array('prefix' => 'bootstrap'), function(){

    //Fake a login to get a token
    Route::get('login', function() {
        return View::make('auth/login/login_form');
    });

    //Register a user
    Route::get('register', function() {
        return View::make('auth/register/register_form');
    });

    Route::post('register', function() {
        $user = new User();
        $user->email = Input::get('email');
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->save();
    });
  
});


//Begin Token Granting Routes
// Route::group(array('prefix' => 'api/'), function() {
    
//     Route::group(array('prefix' => 'v1/'), function() {
        
//         Route::group(array('before' => 'auth.token|auth'), function(){
//             Route::get('user', function() {
//                 return User::find(Auth::user()->id);

//             });

//             Route::get('user/{id}', function($id) {
//                 return User::find($id);
//             });

//             Route::get('user/{id}/group', function($id) {
//                 return User::find($id)->groups;
//             });

//             Route::group(array('prefix' => 'group'), function(){

//                 Route::get('/', function() {
//                     return User::find(Auth::user()->id)->groups;
//                 });

//                 Route::get('/{id}', function($id) {
//                     return Group::find($id);
//                 });

//                 Route::get('/{id}/users', function($id) {
//                     return Group::find($id)->users;
//                 });
//             });
//         });
        
//         Route::post('user', function() {
//             $user = new User();
//             $user->email = Input::get('email');
//             $user->username = Input::get('username');
//             $user->password = Hash::make(Input::get('password'));
//             $user->save();
//             return Response::json(array('success' => 'user '.$user->username.' successfully created.'));
//         });

//     });

// });


// Route::post('auth', function() {

//     $credentials = [
//         'username' => Input::get('username'),
//         'password' => Input::get('password')
//     ];

//     if(Auth::attempt($credentials)) {

//        $authToken = AuthToken::create(Auth::user());
//        $publicToken = AuthToken::publicToken($authToken);

//        Session::put('auth_token', $publicToken);

//        return Response::json(array('auth_token' => $publicToken), 200);
//     }

// });
