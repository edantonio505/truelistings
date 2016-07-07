<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
   
});

Route::group(['middleware' => 'web'], function () {
    
    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);
    Route::get('/dashboard', ['as' => 'dashboard',  'uses' => 'AdminController@dashboard', 'middleware' => ['auth']]);
    Route::get('/brokerdashaboard', ['as' =>'brokerdashboard', 'uses' => 'AdminController@brokerdashboard', 'middleware' => ['auth']]);
    Route::auth();
    Route::get('/search', ['as' => 'searchProperty', 'uses' => 'PropertyController@search']);
    Route::get('/new_property', ['as' => 'newProperty', 'uses' => 'PropertyController@newProperty', 'middleware' => ['auth']]);
    Route::get('/home', 'HomeController@index');
    Route::post('/new_property', ['as' => 'postNewProperty', 'uses' => 'PropertyController@postNewProperty', 'middleware' => ['auth']]);
    Route::get('/super_admin', ['as' => 'superadmindashboard', 'uses' => 'AdminController@superdashboard', 'middleware' => 'auth']);
    Route::post('/Change_Privileges', ['as' => 'changePrivileges', 'uses' => 'AdminController@changePrivileges', 'middleware' => 'auth']);
    Route::get('/edit/property/{id}', ['as' => 'editProperty', 'uses' => 'PropertyController@editProperty', 'middleware' => ['auth']]);
    Route::post('/edit_property/{id}', ['as' => 'postEditProperty', 'uses' => 'PropertyController@postEditProperty', 'middleware' => ['auth']]);
    Route::post('/save_lat_long_neighborhood/', ['as' => 'postNeighborhood', 'uses' => 'AdminController@postNeighborhood', 'middleware' => ['auth']]);
    Route::get('/edit_neighborhood/{id}', ['as' => 'editNeighborhood', 'uses' => 'AdminController@editNeighborhood', 'middleware' => 'auth']);
    Route::post('/upload_photo', 'PropertyController@upload_photo');
    Route::post('/delete_photo/{photo_id}', 'PropertyController@delete_photo');
    Route::post('/save_edited', 'PropertyController@saveEditedProperty');
    Route::post('/property_save_selling_points_on_the_fly', 'PropertyController@saveOnTheFly');
    Route::post('/delete_property', 'PropertyController@deleteProperty');
    //-----------------------------index management ----------------------------------------------------
    Route::get('delete_index', 'IndexController@deleteIndex');
    Route::get('create_index', 'IndexController@createIndex');
    Route::get('/reindex', 'IndexController@reIndex');
    Route::get('/create_mapping', 'IndexController@createMapping');
    Route::get('/get_mapping', 'IndexController@get_index_mapping');
    Route::get('/parse_xml', 'FeedController@parse');
    Route::get('/save_parsed', ['as' => 'getUserFeeds', 'uses' => 'FeedController@save_parsed', 'middleware' => 
        ['auth']]);
});


Route::group(['prefix' => 'api/v1'], function () {
    Route::get('home', 'ApiController@home');
    Route::get('search', 'ApiController@search');
    Route::get('user-info/{id}', 'ApiController@getUserInfo');
});