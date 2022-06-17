<?php

use App\Models\Monitoring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', 'RealtimeController@index')->middleware(['verified'])->name('home');
Route::get('/ajaxRequest', 'RealtimeController@ajaxRequest')->middleware(['verified'])->name('realtime.ajaxRequest');
Route::get('/ajaxRequestAll', 'RealtimeController@ajaxRequestAll')->middleware(['verified'])->name('realtime.ajaxRequestAll');
Route::get('/workorderOnProcess', 'RealtimeController@workorderOnProcess')->middleware(['verified'])->name('realtime.workorderOnProcess');
Route::post('/searchSpeed','RealtimeController@searchSpeed')->middleware(['verified'])->name('realtime.searchSpeed');

Route::get('/dailyReport', 'DailyReportController@index')->middleware(['verified'])->name('dailyReport.index');
Route::get('/dailyReport/ajaxRequestAll', 'DailyReportController@ajaxRequestAll')->middleware(['verified'])->name('dailyReport.ajaxRequestAll');
Route::get('/dailyReport/getCustomFilterData', 'DailyReportController@getCustomFilterData')->middleware(['verified'])->name('dailyReport.getCustomFilterData');
Route::post('/dailyReport/calculateSearchResult', 'DailyReportController@calculateSearchResult')->middleware(['verified'])->name('dailyReport.calculateSearchResult');

Route::get('/workorder', 'WorkorderController@index')->middleware(['verified'])->name('workorder.index');
Route::get('/workorder/ajaxRequestWorkorder', 'WorkorderController@ajaxRequestAll')->middleware(['verified'])->name('workorder.ajaxRequestAll');
Route::get('/workorder/details', 'WorkorderController@show')->middleware(['verified'])->name('workorder.details');
Route::post('/workorder/getDowntime', 'WorkorderController@getDowntime')->middleware(['verified'])->name('workorder.getDowntime');
Route::post('/workorder/getOee', 'WorkorderController@getOee')->middleware(['verified'])->name('workorder.getOee');
Route::get('/workorder/dataonprocess', 'Admin\DataController@workordersOnProcess')->middleware(['verified'])->name('workorder.dataonprocess');
Route::get('/workorder/dataclosed', 'Admin\DataController@workordersClosed')->middleware(['verified'])->name('workorder.dataclosed');

Route::get('/report/{wo_id}/printToPdf', 'ReportController@displayToPdf')->middleware(['verified']);
Route::get('/report/{wo_id}/printPage', 'ReportController@printPage')->middleware(['verified']);

Route::get('/operator/schedule','Operator\ScheduleController@index')->middleware(['verified'])->name('schedule.index');
Route::post('/operator/schedule/{id}/process','Operator\ScheduleController@process')->middleware(['verified']);
Route::get('/operator/showWaiting','Operator\ScheduleController@showWaiting')->middleware(['verified'])->name('workorder.showWaiting');
Route::get('/operator/showOnProcess','Operator\ScheduleController@showOnProcess')->middleware(['verified'])->name('workorder.showOnProcess');
Route::get('/operator/production','Operator\ProductionController@index')->middleware(['verified'])->name('production.index');
Route::post('/operator/production/store','Operator\ProductionController@store')->middleware(['verified'])->name('production.store');
Route::post('/operator/production/getSmeltingNum','Operator\ProductionController@getSmeltingNum')->middleware(['verified'])->name('production.getSmeltingNum');
Route::post('/operator/production/storeOee','Operator\ProductionController@storeOee')->middleware(['verified'])->name('production.storeOee');

route::get('/help','HelpController@index')->name('help.index');





