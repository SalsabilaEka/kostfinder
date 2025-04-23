<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MapController::class, 'index'])->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.request');

    Route::post('/forgot-password/check', [PasswordResetController::class, 'checkEmail'])
        ->name('password.check');

    // Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])
    //     ->name('password.update');
});

Route::get('/map', [MapController::class, 'map'])->name('map');
Route::get('/addMap', [MapController::class, 'addMap'])->name('addMap');
Route::get('/keunggulan', [MapController::class, 'keunggulan'])->name('keunggulan');
Route::get('/fitur', [MapController::class, 'fitur'])->name('fitur');
Route::get('/infografis', [MapController::class, 'infografis'])->name('infografis');

Route::post('/store-point', [PointController::class, 'store'])->name('store-point');
Route::delete('/delete-point/{id}', [PointController::class, 'destroy'])->name('delete-point');
Route::get('/edit-point/{id}', [PointController::class, 'edit'])->name('edit-point');

Route::patch('/update-point/{id}', [PointController::class, 'update'])->name('update-point');
Route::get('/points/table', [PointController::class, 'table'])->name('points.table');
Route::post('/point/store-geojson', [PointController::class, 'storeGeoJSON'])->name('point.storeGeoJSON');
Route::post('/points', [PointController::class, 'store'])->middleware('auth');

Route::get('/api/point/{id}', [PointController::class, 'show'])->name('api.point.show');


Route::get('/about', function () {
    return view('about');
});

Route::get('/', [MapController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/table-point', [PointController::class, 'table'])->name('table-point');

Route::get('/detail/{id}', [KosController::class, 'show'])->name('kos-detail');
Route::get('/api/price-chart-data', [PointController::class, 'getPriceChartData']);
Route::get('/api/distance-chart-data', [PointController::class, 'getDistanceChartData']);
Route::get('/api/facility-chart-data', [PointController::class, 'getFacilityChartData']);

// Reset password langsung
Route::get('/direct-reset', [PasswordResetLinkController::class, 'create'])
     ->name('password.direct.request');

Route::post('/direct-reset', [PasswordResetLinkController::class, 'resetDirect'])
     ->name('password.direct.update');

require __DIR__.'/auth.php';
