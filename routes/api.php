<?php



Route::group([

    
    'prefix' => 'auth',
    

], function () {
    Route::get('admin',  'AuthController@admin');
    Route::post('login',  'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'UserController@store');
    Route::get('getuser{id}', 'UserController@edit');
    Route::put('userUpdate{id}', 'UserController@userUpdate');
    Route::put('disable{id}', 'UserController@disable');
    Route::put('enable{id}', 'UserController@enable');
    Route::put('read{id}', 'PostsController@read');
    Route::put('paid{id}', 'UserController@update');
    Route::put('activate{id}', 'UserController@activate');
    Route::put('profilepicture{id}', 'UserController@profilepicture');
    Route::put('postImage{id}', 'PostsController@postImage');
    Route::get('activated', 'AuthController@index');
    Route::get('mostRead', 'PostsController@mostRead');
    Route::get('mostRead3', 'PostsController@mostRead3');
    Route::get('userPost{id}', 'PostsController@userPost');
    Route::delete('user{id}', 'AuthController@destroy');
    Route::resource('posts', 'PostsController');
    Route::get('index4', 'PostsController@index4');
    Route::get('indexes', 'AuthController@indexes');
    Route::get('index', 'PostsController@index');
    Route::get('mostView{id}', 'PostsController@mostView');
   // Route::get('user', 'AuthController@user');
    Route::post('create', 'PostsController@store');
    Route::get('users','AuthController@index');
    Route::get('index','UserController@index');
    Route::get('index3','UserController@index3');
   
    Route::get('show/{id}','PostsController@show');
    Route::put('edit/{id}','PostsController@update');
    Route::put('post_count{id}','UserController@post_count');
    Route::post('pay', 'PaymentController@redirectToGateway');
    Route::post('reset-password', 'AuthController@sendPasswordResetLink');
    Route::post('reset/password', 'AuthController@callResetPassword');
   // Route::get('me', 'AuthController@me');
    Route::post('password/email', 'AuthController@forgot');

  
    

});
Route::group(['middleware' => 'jwt.verify', 'prefix' => 'auth'], function() {
    Route::get('me', 'AuthController@me');
});


/*
Route::middleware('auth:api')->get("/user", function (Request, $request) {
    return $request->user();

});
Route::get('index', 'PostsController@index');

    Route::get('/', "PagesController@index");
Route::get('/about', "PagesController@about");
Route::get('/services', "PagesController@services");
Route::get('/welcome', "PagesController@welcome");

Route::get('/home', 'HomeController@index')->name('home');
*/





