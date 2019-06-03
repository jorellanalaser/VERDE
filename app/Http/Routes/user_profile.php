<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 21/08/16
 * Time: 12:05 AM
 */

// Show user dashboard
Route::get('dashboard', [
    'as' => 'user.dashboard',
    'uses' => 'DashboardController@index'
]);

// Edit form
Route::get('/edit', [
    'as' => 'user.profile.edit',
    'uses' => 'ProfileController@edit'
]);

// Update user profile
Route::put('/update', [
    'as' => 'user.profile.update',
    'uses' => 'ProfileController@update'
]);

// User flights
Route::get('/flights', [
    'as' => 'users.flights',
    'uses' => 'FlightsController@index'
]);

// Resend verification token
Route::get('/verify/send', [
    'uses'  => 'DashboardController@resendToken'
]);