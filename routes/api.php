<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('login', 'AuthController@login');
  Route::post('register', 'AuthController@register');

  Route::group([
    'middleware' => 'auth:api'
  ], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
  });
});

Route::get('semester-perangkat',[\App\Http\Controllers\Api\ApiController::class, 'getDataSemesterPerangkat'])->name('api-get-semester-perangkat');
Route::get('semester-aktif',[\App\Http\Controllers\Api\ApiController::class, 'getSemesterAktif'])->name('api-get-semester-aktif');
Route::get('get-data-dosen',[\App\Http\Controllers\Api\ApiController::class, 'getDataDosen'])->name('api-get-data-dosen');
Route::get('get-data-dosen-lb',[\App\Http\Controllers\Api\ApiController::class, 'getDataDosenLb'])->name('api-get-data-dosen-lb');
Route::get('get-data-bad',[\App\Http\Controllers\Api\ApiController::class, 'getDataBadDosenLb'])->name('api-get-data-bad');
