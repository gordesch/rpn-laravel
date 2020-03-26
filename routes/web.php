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
    Route::get('shows/{show:id}/edit', 'ShowsController@edit')->name('shows.edit');
    Route::put('shows/{show:id}', 'ShowsController@update')->name('shows.update');
    Route::delete('shows/{show:id}', 'ShowsController@destroy')->name('shows.destroy');

    Route::get('shows/import/search/create', 'ShowsImportSearchController@create')->name('shows.import.search.create');
    Route::get('shows/import/create', 'ShowsImportController@create')->name('shows.import.create');

    Route::get('shows/{show:id}/videos/edit', 'ShowsVideosController@edit')->name('shows.videos.edit');
    Route::put('shows/{show:id}/videos', 'ShowsVideosController@update')->name('shows.videos.update');

    Route::get('showings-import/create', 'ShowingsImportController@create')->name('showings.import.create');
    Route::post('showings-import', 'ShowingsImportController@store')->name('showings.import.store');

    Route::get('weeks', 'WeeksController@index')->name('weeks.index');
    Route::get('weeks/{week:id}/edit', 'WeeksController@edit')->name('weeks.edit');
    Route::put('weeks/{week:id}', 'WeeksController@update')->name('weeks.update');

    Route::get('weeks/{week:id}/shows-state', 'WeeksDetailsController@showsState')->name('weeks.shows-state');
    Route::get('weeks/{week:id}/resources', 'WeeksDetailsController@resources')->name('weeks.resources');
    Route::get('weeks/{week:id}/showings', 'WeeksDetailsController@showings')->name('weeks.showings');

    Route::namespace('Website')->prefix('website')->name('website.')->group(function () {
        Route::get('pages/create', 'PagesController@create')->name('pages.create');
        Route::post('pages', 'PagesController@store')->name('pages.store');
    });
});

/*Route::get('a-l-affiche/cette-semaine', function() {
    return (new \App\Http\Controllers\ShowingsByWeekController())
        ->show(\Gordesch\CineCarbon::now()->programmingWeek());
})->name('showing.this-week');
Route::get('a-l-affiche/semaine-prochaine', function() {
    return (new \App\Http\Controllers\ShowingsByWeekController())
        ->show(\Gordesch\CineCarbon::now()->modify('+1 week')->programmingWeek());
})->name('showing.next-week');
Route::get('a-l-affiche/ce-soir/{date?}', 'ShowingsTonightController')->name('showing.tonight');
Route::get('a-l-affiche/maintenant/{from?}', 'ShowingsNowController')->name('showing.now');*/

