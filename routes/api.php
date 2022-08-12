<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CustomersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    // Route::get('/user', function(Request $request){
    //     return $request->user();
    // });
    Route::apiResource('/customers', CustomersController::class, ['except' => ['create', 'edit']]);
    Route::get('/customers/{customer_id}/cars', [CustomersController::class, 'getcustomer_cars']);
   
    Route::post('/cars', [CarsController::class, 'store']);
    Route::put('/cars/{car_id}', [CarsController::class, 'update']);
    Route::delete('/cars/{car_id}', [CarsController::class, 'destroy']);

});


Route::apiResource('/customers', CustomersController::class)->middleware('auth:sanctum');
Route::get('/customers/{customer_id}/cars', [CustomersController::class, 'getcustomer_cars'])->middleware('auth:sanctum');



Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/register', [AuthController::class, 'createUser']);