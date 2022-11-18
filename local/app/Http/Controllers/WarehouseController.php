<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //
    public function index()
    {
        return view('warehouse.index',[
            'title' => 'Warehouse Index'
        ]);
    }
}
