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

Route::get('/ebooks', 'EbookController@listEbooks');
Route::post('/ebooks', 'EbookController@addEbookAction');
Route::get('/ebooks/{id}', 'EbookController@getEbookAction');
Route::post('/ebooks/{id}/order', 'OrderController@orderEbookAction');
