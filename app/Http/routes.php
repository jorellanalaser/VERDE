<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as'    => 'home',
    'uses'  => 'HomeController@index'
]);


// Kiu
require __DIR__ . '/Routes/kiu.php';

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth'], function (){
    // User Profile
    require __DIR__ . '/Routes/user_profile.php';
});

Route::group(['prefix' => 'ajax'], function (){
    // Get origins
    Route::get('/destinations/{origin}', [
        'as'    => 'ajax.destination',
        'uses'  => 'HomeController@getDestinations'
    ]);
});
Route::auth();

Route::get('/search/cne/{nac}/{ci}', function ($nac, $ci) {
    return \Modules\Helpers\SearchCNE::SearchCNE(
        $nac,
        $ci
    );
});

Route::get('/clear/shopping-cart', function (){
    \Modules\Helpers\ShoppingCart::clear();

    return \Illuminate\Support\Facades\Redirect::route('home');
});

Route::group(['prefix' => 'content'], function () {

    // Info
    Route::get('info', function () {
        return view('content.info');
    });

    // Frecuetn Flyer
    Route::get('frecuentf', function () {
        return view('content.frecuentf');
    });

    // Tips
    Route::get('tips', function () {
        return view('content.tips');
    });

    // News
    Route::get('news', function () {
        return view('content.news');
    });

    // Promotions
    Route::get('promotions', function () {
        return view('content.promotions');
    });

    // Cargo
    Route::get('cargo', function () {
        return view('content.cargo');
    });

    // App
    Route::get('app', function () {
        return view('content.app');
    });

    // Volar
    Route::get('volar', function () {
        return view('content.volar');
    });

    // Internationals
    Route::get('internationals', function () {
        return view('content.international');
    });

    // Itinerary Flights
    Route::get('itineraryf', function () {
        return view('content.itineraryf');
    });
});

Route::get('/offices/{city?}', [
    'as' => 'offices',
    'uses' => 'OfficesController@index'
]);

Route::get('/locale/{lang}', function ($lang) {
    session()->put('locale', $lang);
});

// Verify email
Route::get('/register/verify/{token}', [
    'uses'  => 'Auth\VerifyController@index'
]);

// Control ventas desde USA JCCV
//Route::get('/', function()
//{
//    return view('USA2');
//});