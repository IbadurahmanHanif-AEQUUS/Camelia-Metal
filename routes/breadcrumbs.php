<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Daily Report
Breadcrumbs::for('dailyReport.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Daily Report', route('dailyReport.index'));
});

// Workorder
Breadcrumbs::for('workorder.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('workorder.index'));
});

// OEE Details
Breadcrumbs::for('workorder.details', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('workorder.index'));
    $trail->push('Workorder Detail', route('workorder.details'));
});

// User Index
Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
});

// User Create
Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
    $trail->push('Create User', route('admin.user.create'));
});

// User Edit
Breadcrumbs::for('admin.user.edit', function ($trail, $user) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
    $trail->push('Edit User', route('admin.user.edit', $user));
});

// Product Index
Breadcrumbs::for('admin.product.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Product', route('admin.product.index'));
});

// Workorder Index
Breadcrumbs::for('admin.workorder.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
});

// Workorder Create
Breadcrumbs::for('admin.workorder.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Create Workorder', route('admin.workorder.create'));
});

// Workorder Edit
Breadcrumbs::for('admin.workorder.edit', function ($trail, $workorder) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Edit Workorder', route('admin.workorder.edit', $workorder));
});

// Workorder Closed
Breadcrumbs::for('admin.workorder.closed', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Closed Workorder', route('admin.workorder.closed'));
});

// Production Index
Breadcrumbs::for('admin.production.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Production', route('admin.production.index'));
});


// Smelting Create
Breadcrumbs::for('admin.smelting.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Create Smelting', route('admin.smelting.create'));
});

// OEE Index
Breadcrumbs::for('admin.oee.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('OEE', route('admin.oee.index'));
});

// Supplier Index
Breadcrumbs::for('admin.supplier.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
});

// Supplier Create
Breadcrumbs::for('admin.supplier.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
    $trail->push('Create Supplier', route('admin.supplier.create'));
});

// Supplier Edit
Breadcrumbs::for('admin.supplier.edit', function ($trail, $supplier) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
    $trail->push('Edit Supplier', route('admin.supplier.edit', $supplier));
});

// Customer Index
Breadcrumbs::for('admin.customer.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
});

// Customer Create
Breadcrumbs::for('admin.customer.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
    $trail->push('Create Customer', route('admin.customer.create'));
});

// Customer Edit
Breadcrumbs::for('admin.customer.edit', function ($trail, $customer) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
    $trail->push('Edit Customer', route('admin.customer.edit', $customer));
});

// Operator Schedule
Breadcrumbs::for('schedule.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Schedule', route('schedule.index'));
});

// Operator Production
Breadcrumbs::for('production.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Production', route('production.index'));
});

//Help Index
Breadcrumbs::for('help.index', function ($trail) {
    $trail->push('Home', route('help.index'));
});

