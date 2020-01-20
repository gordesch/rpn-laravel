<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('shows', 'ShowsController@index')->name('shows.index');
    Route::post('shows', 'ShowsController@store')->name('shows.store');
    Route::get('shows/{show}', 'ShowsController@edit')->name('shows.edit');
    Route::put('shows/{show}', 'ShowsController@update')->name('shows.update');
    Route::delete('shows/{show}', 'ShowsController@destroy')->name('shows.destroy');

    Route::get('shows/import/search/create', 'ShowsImportSearchController@create')->name('shows.import.search.create');
    Route::get('shows/import/search', 'ShowsImportSearchController@show')->name('shows.import.search');

    Route::get('shows/import/create', 'ShowsImportController@create')->name('shows.import.create');

    Route::get('showings-import', 'ShowingsImportController@index')->name('showings.import.index');
    Route::get('showings-import/create', 'ShowingsImportController@create')->name('showings.import.create');
    Route::post('showings-import', 'ShowingsImportController@store')->name('showings.import.store');
});

