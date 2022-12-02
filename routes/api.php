<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketKonserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\CheckIsCustomer;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('/tiket', [TiketKonserController::class, 'index']);    
    Route::get('/tiket/{id}', [TiketKonserController::class, 'show']);    
    Route::get('/transaksi', [TransaksiController::class, 'index']);    
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);    
    Route::post('/user/logout', [UserController::class, 'logout']);

    Route::middleware([CheckIsAdmin::class])->group(function(){
        Route::post('/tiket', [TiketKonserController::class, 'store']);
        Route::put('/tiket/{id}', [TiketKonserController::class, 'update']);
        Route::delete('/tiket/{id}', [TiketKonserController::class, 'destroy']);
    });
    
    Route::middleware([CheckIsCustomer::class])->group(function(){
        Route::post('/transaksi', [TransaksiController::class, 'store']);
    });
});