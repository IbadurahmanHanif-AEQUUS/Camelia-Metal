<?php

use App\Models\Monitoring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\Operator\ScheduleController;
use App\Http\Controllers\Operator\ProductionController;
use App\Http\Controllers\Supervisor\SpvProductionController;
use App\Http\Controllers\WorkorderReportController;

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

//
// Realtime Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/', [RealtimeController::class,'index'])->name('home');
    Route::get('/ajaxRequest',[RealtimeController::class,'ajaxRequest'])->name('realtime.ajaxRequest');
    Route::get('/speedChart', [RealtimeController::class,'speedChart'])->name('realtime.speedChart');
    Route::get('/workorderOnProcess', [RealtimeController::class,'workorderOnProcess'])->name('realtime.workorderOnProcess');
    Route::post('/searchSpeed',[RealtimeController::class,'searchSpeed'])->name('realtime.searchSpeed');
});

//
// Daily Report Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/dailyReport',[DailyReportController::class,'index'])->name('dailyReport.index');
    Route::get('/dailyReport/ajaxRequestAll',[DailyReportController::class,'ajaxRequestAll'])->name('dailyReport.ajaxRequestAll');
    Route::get('/dailyReport/getCustomFilterData',[DailyReportController::class,'getCustomFilterData'])->name('dailyReport.getCustomFilterData');
    Route::post('/dailyReport/calculateSearchResult',[DailyReportController::class,'calculateSearchResult'])->name('dailyReport.calculateSearchResult');
});

//
// Workorder Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/workorder',[WorkorderController::class,'index'])->name('workorder.index');
    Route::get('/workorder/ajaxRequestWorkorder',[WorkorderController::class,'ajaxRequestAll'])->name('workorder.ajaxRequestAll');
    Route::get('/workorder/{workorder}/show',[WorkorderController::class,'show'])->name('workorder.show');
    Route::post('/workorder/getDowntime',[WorkorderController::class,'getDowntime'])->name('workorder.getDowntime');
    Route::post('/workorder/getOee',[WorkorderController::class,'getOee'])->name('workorder.getOee');
    Route::get('/workorder/speedChart',[WorkorderController::class,'speedChart'])->name('workorder.speedChart');
    Route::get('/workorder/{workorder}/export', [WorkorderController::class, 'export'])->name('workorder.export');

    // Route::get('/workorder/dataonprocess',[DataController::class,'workordersOnProcess'])->name('workorder.dataonprocess');
    Route::get('/workorder/dataclosed',[DataController::class,'workordersClosed'])->name('workorder.dataclosed');
});

//
// Workorder Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/workorder/{workorder}/export', [WorkorderReportController::class, 'export'])->name('workorder.export');
});

//
// Report Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/report/{production}/printToPdf',[ReportController::class,'printToPdf'])->name('report.printToPdf');
});

//
// Schedule Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/operator/schedule',[ScheduleController::class,'index'])->name('schedule.index');
    Route::post('/operator/schedule/{id}/process',[ScheduleController::class,'process']);
	Route::post('/operator/schedule/{id}/check',[ScheduleController::class,'check']);
    Route::get('/operator/showWaiting',[ScheduleController::class,'showWaiting'])->name('workorder.showWaiting');
    Route::get('/operator/showOnProcess',[ScheduleController::class,'showOnProcess'])->name('workorder.showOnProcess');
	Route::get('/operator/showOnCheck',[ScheduleController::class,'showOnCheck'])->name('workorder.showOnCheck');
});

//
// Production Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/operator/production',[ProductionController::class,'index'])->name('production.index');
	Route::get('/operator/production/{workorder}/show',[ProductionController::class,'show'])->name('operator.production.show');
    Route::get('/operator/production/showOnProcess',[ProductionController::class,'showOnProcess'])->name('operator.production.showOnProcess');

    Route::post('/operator/production/store',[ProductionController::class,'store'])->name('production.store');
    Route::get('/operator/production/{production}/edit',[ProductionController::class,'edit'])->name('production.edit');
    Route::put('/operator/production/{production}/update',[ProductionController::class,'update'])->name('production.update');
    Route::delete('/operator/production/{production}/delete',[ProductionController::class,'destroy'])->name('production.delete');
    
    Route::post('/operator/production/getSmeltingNum',[ProductionController::class,'getSmeltingNum'])->name('production.getSmeltingNum');
    Route::post('/operator/production/storeOee',[ProductionController::class,'storeOee'])->name('production.storeOee');
    Route::post('/operator/production/getProductionInfo',[ProductionController::class,'getProductionInfo'])->name('production.getProductionInfo');
    Route::get('/operator/production/speedChart',[ProductionController::class,'speedChart'])->name('production.speedChart');

	Route::post('/operator/production/{workorder}/finish',[ProductionController::class,'finish'])->name('operator.production.finish');
	Route::post('/operator/production/{workorder}/finishWithDelete',[ProductionController::class,'finishWithDelete'])->name('operator.production.finishWithDelete');
});

//
// SPV Production Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/supervisor/production',[SpvProductionController::class,'index'])->name('spvproduction.index');
    Route::get('/supervisor/production/showOnCheck',[SpvProductionController::class,'showOnCheck'])->name('spvproduction.showOnCheck');
	Route::get('/supervisor/production/{workorder}/show',[SpvProductionController::class,'show'])->name('spvproduction.show');
    Route::get('/supervisor/production/speedChart',[SpvProductionController::class,'speedChart'])->name('spvproduction.speedChart');

    Route::post('/supervisor/production/store',[SpvProductionController::class,'store'])->name('spvproduction.store');
    Route::get('/supervisor/production/{production}/edit',[SpvProductionController::class,'edit'])->name('spvproduction.edit');
    Route::put('/supervisor/production/{production}/update',[SpvProductionController::class,'update'])->name('spvproduction.update');
    Route::delete('/supervisor/production/{production}/delete',[SpvProductionController::class,'destroy'])->name('spvproduction.delete');

	Route::post('/supervisor/production/{workorder}/finish',[SpvProductionController::class,'finish'])->name('spvproduction.finish');

 	// // Route::get('/operator/production/{id}/spvshow',[ProductionController::class,'spvshow'])->name('spvshow.show');
    // Route::post('/supervisor/production/{id}/finish',[ProductionController::class,'finish'])->name('spvproduction.finish');
	// Route::get('/supervisor/production/{workorder}/show_details',[SpvProductionController::class,'spvshow'])->name('supervisor.production.show_details');
});


//
// Help Controller Route
//
Route::middleware(['verified'])->controller(HelpController::class)->group(function(){
    route::get('/help','index')->name('help.index');
});

//
// Reset Password Controller
//
Route::middleware(['verified'])->controller(ChangePasswordController::class)->group(function(){
    Route::get('/change-password','index')->name('change.password.index');
    route::post('/change-password','store')->name('change.password');
});

//
// Warehouse Controller
//
Route::middleware(['verified'])->controller(WarehouseController::class)->group(function(){
    Route::get('/warehouse','index')->name('warehouse.index');
});

//
// Downtime Controller
//
Route::middleware(['verified'])->controller(DowntimeController::class)->group(function(){
    Route::post('/update-downtime','updateDataDowntime')->name('downtime.updateDowntime');
    Route::post('/getDowntimeWasteChart','getDowntimeWasteChart')->name('downtime.getDowntimeWasteChart');
    Route::post('/getDowntimeManagementChart','getDowntimeManagementChart')->name('downtime.getDowntimeManagementChart');
});

//
// Downtime Remarks Controller
//
Route::middleware(['verified'])->controller(DowntimeRemarkController::class)->group(function(){
    Route::post('/submit-downtime-remark','submitDowntimeRemark')->name('downtimeRemark.submit');
});





