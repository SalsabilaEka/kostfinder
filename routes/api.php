<?php

use App\Http\Controllers\PointController;
use App\Http\Controllers\PointControllerHalte;
use App\Http\Controllers\PointControllerUniv;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/reset-password', [PasswordResetController::class, 'updatePassword']);

Route::middleware(['auth'])->group(function () {
    Route::post('/point', [PointController::class, 'storeGeoJSON']);
    Route::patch('/update-point/{id}', [PointController::class, 'update']);
});

Route::get('/points', [PointController::class, 'index'])->name('api.points');
Route::get('/halte', [PointControllerHalte::class, 'index'])->name('api.halte');
Route::get('/univ', [PointControllerUniv::class, 'index'])->name('api.univ');
Route::get('/points/table', [PointController::class, 'table'])->name('points.table');
Route::get('/api/point/{id}', [PointController::class, 'show'])->name('api.point.show');
Route::post('/points', [PointController::class, 'store'])->middleware('auth');
Route::get('/api/price-chart-data', [PointController::class, 'getPriceChartData']);
Route::get('/api/distance-chart-data', [PointController::class, 'getDistanceChartData']);
Route::get('/api/facility-chart-data', [PointController::class, 'getFacilityChartData']);

