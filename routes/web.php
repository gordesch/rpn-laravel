<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('shows/create', 'ShowsController@create')->name('shows.create');
    Route::post('shows', 'ShowsController@store')->name('shows.store');
    Route::get('shows/{show}/edit', 'ShowsController@edit')->name('shows.edit');
    Route::put('shows/{show}', 'ShowsController@update')->name('shows.update');
    Route::delete('shows/{show}', 'ShowsController@destroy')->name('shows.destroy');

    Route::get('shows/import/search/create', 'ShowsImportSearchController@create')->name('shows.import.search.create');
    Route::get('shows/import/create', 'ShowsImportController@create')->name('shows.import.create');

    Route::get('shows/{show}/videos/edit', 'ShowsVideosController@edit')->name('shows.videos.edit');
    Route::put('shows/{show}/videos', 'ShowsVideosController@update')->name('shows.videos.update');

    Route::get('showings-import/create', 'ShowingsImportController@create')->name('showings.import.create');
    Route::post('showings-import', 'ShowingsImportController@store')->name('showings.import.store');

    Route::get('weeks', 'WeeksController@index')->name('weeks.index');
    Route::get('weeks/{week}/edit', 'WeeksController@edit')->name('weeks.edit');
    Route::put('weeks/{week}', 'WeeksController@update')->name('weeks.update');
});

Route::get('a-l-affiche/cette-semaine', function() {
    return (new \App\Http\Controllers\ShowingsByWeekController())
        ->show(\Gordesch\CineCarbon::now()->programmingWeek());
})->name('showing.this-week');
Route::get('a-l-affiche/semaine-prochaine', function() {
    return (new \App\Http\Controllers\ShowingsByWeekController())
        ->show(\Gordesch\CineCarbon::now()->modify('+1 week')->programmingWeek());
})->name('showing.next-week');
Route::get('a-l-affiche/ce-soir/{date?}', 'ShowingsTonightController')->name('showing.tonight');
Route::get('a-l-affiche/maintenant/{from?}', 'ShowingsNowController')->name('showing.now');

