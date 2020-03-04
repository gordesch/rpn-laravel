<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/slug_exists/{slug}', function($slug) {
    return App\Show::where('slug', $slug)->count();
});
Route::get('/admin/shows/for-autocomplete', function() {
    return App\Show::all('id', 'slug', 'title', 'year');
});
