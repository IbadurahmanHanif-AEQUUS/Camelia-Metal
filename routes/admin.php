<?php

use Illuminate\Support\Facades\Route;

Route::get('/user/data', 'DataController@users')->middleware(['verified'])->name('user.data');
Route::get('/workorder/datadraft', 'DataController@workordersDraft')->middleware(['verified'])->name('workorder.datadraft');
Route::get('/workorder/datawaiting', 'DataController@workordersWaiting')->middleware(['verified'])->name('workorder.datawaiting');
Route::get('/workorder/dataonprocess', 'DataController@workordersOnProcess')->middleware(['verified'])->name('workorder.dataonprocess');
Route::get('/workorder/dataclosed', 'DataController@workordersClosed')->middleware(['verified'])->name('workorder.dataclosed');
Route::get('/production/data', 'DataController@productions')->middleware(['verified'])->name('production.data');
Route::get('/oee/data', 'DataController@oees')->middleware(['verified'])->name('oee.data');
Route::get('/smelting/data_wo', 'DataController@wo_smeltings')->middleware(['verified'])->name('smelting.data_wo');
Route::get('/smelting/data', 'DataController@smeltings')->middleware(['verified'])->name('smelting.data');
Route::get('/supplier/data', 'DataController@suppliers')->middleware(['verified'])->name('supplier.data');
Route::get('/line/data', 'DataController@lines')->middleware(['verified'])->name('line.data');
Route::get('/machine/data', 'DataController@machines')->middleware(['verified'])->name('machine.data');
Route::get('/customer/data', 'DataController@customers')->middleware(['verified'])->name('customer.data');
Route::get('/workorder/closed','WorkorderController@closedWorkorder')->middleware(['verified'])->name('workorder.closed');

Route::resource('user','UserController');

Route::resource('smelting','SmeltingController');
Route::post('smelting/getDataWo', 'SmeltingController@getDataWo')->middleware(['verified'])->name('smelting.getDataWo');
Route::post('smelting/addSmelting','SmeltingController@addSmelting')->middleware(['verified'])->name('smelting.addSmelting');

Route::resource('workorder','WorkorderController');
Route::post('workorder/updateOrder', 'WorkorderController@updateOrder')->middleware(['verified'])->name('workorder.updateorder');
Route::post('workorder/setWoStatus','WorkorderController@setWoStatus')->middleware(['verified'])->name('workorder.setWoStatus');
Route::post('workorder/calculatePcsPerBundle','WorkorderController@calculatePcsPerBundle')->middleware(['verified'])->name('workorder.calculatePcsPerBundle');

Route::resource('production','ProductionController');

Route::resource('line','LineController');

Route::resource('machine','MachineController');

Route::resource('oee','OeeController');

Route::resource('supplier','SupplierController');
Route::post('suppllier/getSupplierData','SupplierController@getSupplierData')->middleware(['verified'])->name('supplier.getSupplierData');

Route::resource('customer','CustomerController');
Route::post('customer/getCustomerData','CustomerController@getCustomerData')->middleware(['verified'])->name('customer.getCustomerData');



