<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    CustomerWebController,
    DetailTrackingWebController,
    DriverWebController,
    KategoriWebController,
    RouteListWebController,
    RouteDetailWebController,
    SettingWebController,
    SubKategoriWebController,
    SubscriptionReportWebController,
    TrackingWebController,
    TruckWebController,
    VisitWebController,
    LoginWebController,
    UserWebController,
    DashboardWebController
    
};
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

Route::get('/partial', function () {
    return view('partials.layouts');
});

Route::get('/', function () {
    return redirect()->route('login.view');
});

Route::get('login', [LoginWebController::class, 'viewLogin'])->name('login.view');
Route::post('login-post', [LoginWebController::class, 'loginValidation'])->name('login.post');
Route::get('logout-post', [LoginWebController::class, 'logout'])->name('logout.post');


Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard.index');
    // });

    Route::resource('/dashboard', DashboardWebController::class);

    Route::resource('customer', CustomerWebController::class);
    Route::get('customer/createSubs/{id}', [CustomerWebController::class, 'createSubscription'])->name('create.cus_sub');
    Route::post('customer/postSubs/', [CustomerWebController::class, 'storeSubscription'])->name('store.cus_sub');
    Route::delete('customer/deleteSubs/{id}/{idDetail}', [CustomerWebController::class, 'destroySubs'])->name('destroy.cus_sub');
    Route::post('customer/import', [CustomerWebController::class, 'importCustomers'])->name('import.customer');

    Route::resource('detail-tracking', DetailTrackingWebController::class);
    Route::resource('driver', DriverWebController::class);
    Route::resource('kategori', KategoriWebController::class);
    Route::resource('sub-kategori', SubKategoriWebController::class);
    Route::resource('routelist', RouteListWebController::class);
    Route::delete('routelist/deleteDetail/{id}/{idDetail}', [RouteListWebController::class, 'destroyRouteDetail'])->name('destroy.route_detail');
    Route::get('routelist/createDetail/{id}', [RouteListWebController::class, 'createDetail'])->name('create.route_detail');
    Route::post('routelist/postDetail/', [RouteListWebController::class, 'storeDetailRoute'])->name('store.route_detail');

    Route::resource('route-detail', RouteDetailWebController::class);
    Route::resource('setting', SettingWebController::class);
    Route::resource('tracking', TrackingWebController::class);
    Route::resource('visit', VisitWebController::class);
    Route::resource('truck', TruckWebController::class);
    
    Route::resource('subscription_report', SubscriptionReportWebController::class);
    Route::get('subscription_report/file/export', [SubscriptionReportWebController::class, 'view_export'])->name('subscription_report.export');
    Route::post('subscription_report/export/filter', [SubscriptionReportWebController::class,'filter'])->name('subscription_report.filter');
    Route::get('subscription_report/export/{tipe}/{value}', [SubscriptionReportWebController::class, 'filter'])->name('subscription_report.filter');

    Route::resource('user', UserWebController::class);
});

