<?php

namespace App\Http\Controllers;

use App\Http\Resources\Downtime\DowntimeCollection;
use App\Models\Downtime;
use Illuminate\Http\Request;

class DowntimeController extends Controller
{
    //
    public function updateDataDowntime()
    {
        $downtimeData = Downtime::where('is_remark_filled',false)->where('status','stop')
                            ->orWhere('is_downtime_stopped',false)
                            ->orderby('id','desc')->get();
        return new DowntimeCollection($downtimeData);
    }

}
