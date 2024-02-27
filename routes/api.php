<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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
Route::post('/login',[ApiController::class,'login']);
Route::get('/cats',[ApiController::class,'cats']);
Route::get('/subcats',[ApiController::class,'subcats']);
Route::get('/products',[ApiController::class,'products']);
Route::get('/tags',[ApiController::class,'tags']);
Route::get('/subcats/{id}',[ApiController::class,'sbc']);
Route::get('/pbc/{id}',[ApiController::class,'pbc']);
Route::get('/pbt/{id}',[ApiController::class,'pbt']);
Route::get('/cbt/{id}',[ApiController::class,'cbt']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/check',[ApiController::class,'check']);
    Route::post('/ordersubmit',[ApiController::class,'submitOrders']);
    Route::get('/viewOrders',[ApiController::class,'viewOrders']);
    Route::get('/userOrderDetail/{id}',[ApiController::class,'userOrderDetail']);
    Route::get('/userOrderVouncher/{id}',[ApiCOntroller::class,'userOrderVouncher']);
    Route::get('/userOrders/{id}',[ApiController::class,'userOrders']);
});
