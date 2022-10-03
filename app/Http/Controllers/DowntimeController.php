<?php

namespace App\Http\Controllers;

use App\Http\Resources\Downtime\DowntimeCollection;
use App\Models\Downtime;
use Illuminate\Http\Request;

class DowntimeController extends Controller
{
    //
    public function updateDataDowntime(Request $request)
    {
        $downtimeData = Downtime::where('workorder_id',$request->workorder_id)
                            ->where('status','run')
                            ->orWhere('is_downtime_stopped',false)
                            ->orderBy('is_remark_filled','asc')
                            ->orderby('id','desc')->get();
        return new DowntimeCollection($downtimeData);
    }

}
