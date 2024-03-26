<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DriverController,
    KategoriController,
    RouteListController,
    SettingController,
    TrackingController,
    TruckController,
    VisitController,
    CustomerController,
    DetailTrackingController
};
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::GET('/driver-profile',[DriverController::class,'getProfile']);
    Route::PUT('/driver-update',[DriverController::class,'updateProfile']);
    Route::POST('/driver-update-password',[DriverController::class,'updatePassword']);
    Route::POST('/driver-upload-photo',[DriverController::class,'uploadPhoto']);

    Route::GET('/truck-list/{page}/{limit}',[TruckController::class,'getTruckList']);
    Route::GET('/truck-by-id/{id}',[TruckController::class,'getTruckById']);

    Route::GET('/kategori-list',[KategoriController::class,'getKategori']);

    Route::GET('/customer-list/{page}/{limit}',[CustomerController::class,'getCustomerList']);
    Route::GET('/customer-by-id/{id}',[CustomerController::class,'getCustomerById']);

    Route::GET('/route-list',[RouteListController::class,'getRouteList']);
    Route::GET('/route-detail/{routeId}',[RouteListController::class,'getDetailRouteList']);

    Route::GET('/tracking-list/{page}/{limit}',[TrackingController::class,'getHistory']);
    Route::POST('/tracking/create',[TrackingController::class,'createTracking']);
    Route::POST('/tracking-add-detail',[TrackingController::class,'addDetailTracking']);
    Route::PUT('/tracking-update',[TrackingController::class,'updateTracking']);
    Route::PUT('/tracking-update-detail',[TrackingController::class,'updateDetailTracking']);
    Route::DELETE('/tracking-delete/{id}',[TrackingController::class,'deleteTracking']);
    Route::GET('/tracking-by-driver-current-date',[TrackingController::class,'getCurrentTrackingByDriver']);

    Route::POST('/stop-tracking',[TrackingController::class,'stopTracking']);
    Route::POST('/start-tracking',[TrackingController::class,'startTracking']);
    
    Route::POST('/visit-create',[VisitController::class,'createVisit']);
    Route::PUT('/visit-update',[VisitController::class,'updateVisit']);
    Route::DELETE('/visit-delete/{id}',[VisitController::class,'deleteVisit']);
    Route::POST('/visit-upload-photo',[VisitController::class,'uploadPhotoVisit']);
    Route::GET('/visit/{id}',[VisitController::class,'getVisitById']);
    Route::GET('/visit-by-customer/{customerId}/{trackingId}',[VisitController::class,'getVisitByCustomerId']);

    Route::GET('/logout-driver',[DriverController::class,'logout']);
});
Route::POST('/login-driver',[DriverController::class,'login']);
Route::GET('/login',function(){
    return response()->json(['status'=>'failed','message'=>'not login'],401);
})->name('login');