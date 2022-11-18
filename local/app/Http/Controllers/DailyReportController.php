<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.daily_report.index',[
            'title' => 'Summary Report',
        ]);
    }

    // //Daily Report Data Controller
    // public function ajaxRequestAll(Request $request)
    // {
    //     $dailyReport = DailyReport::query();
    //     return datatables()->of($dailyReport)
    //             ->addIndexColumn()
    //             ->toJson();
    // }

    public function getCustomFilterData(Request $request)
    {
        $dailyReport    = DailyReport::query()->orderBy('created_at','DESC');

        return datatables()->of($dailyReport)
            ->filter(function($query) use ($request){
                if($request->report_date_1 != '')
                {
                    $query->where('created_at', '>=', "$request->report_date_1");
                }

                if($request->report_date_2 != '')
                {
                    $query->where('created_at', '<=', "$request->report_date_2");
                }

            })
            ->addColumn('wo_number',function(DailyReport $model){
                return $model->workorder->wo_number;
            })
            ->addColumn('weight_loss',function(DailyReport $model){
                return $model->total_weight_bb - $model->total_weight_fg;
            })
            ->addColumn('created_at',function(DailyReport $model){
                return date('Y-m-d H:i:s',strtotime($model->created_at));
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function calculateSearchResult(Request $request)
    {
        $searchResult    = DailyReport::query();

        if($request->report_date_1 != '')
        {
            $searchResult->where('created_at','>=',"$request->report_date_1");
        }
        if($request->report_date_2 != '')
        {
            $searchResult->where('created_at','<=',"$request->report_date_2");
        }
        $totalRuntime   = 0;
        $totalDowntime  = 0;
        $totalPcs       = 0;
        $totalPcsGood   = 0;
        $totalPcsBad    = 0;
        $totalWeightFg  = 0;
        $totalWeightBb  = 0;
        $totalWeightLoss = 0;
        
        foreach ($searchResult->get() as $search) {
            $totalRuntime += $search->total_runtime;
            $totalDowntime += $search->total_downtime;
            $totalPcs += $search->total_pcs;
            $totalPcsGood += $search->total_pcs_good;
            $totalPcsBad += $search->total_pcs_bad;
            $totalWeightFg += $search->total_weight_fg;
            $totalWeightBb += $search->total_weight_bb;
            
        }
        $totalWeightLoss = $totalWeightBb - $totalWeightFg;
        
        return response()->json([
            'total_runtime'     => $totalRuntime,
            'total_downtime'    => $totalDowntime,
            'total_pcs'         => $totalPcs,
            'total_pcs_good'    => $totalPcsGood,
            'total_pcs_bad'         => $totalPcsBad,
            'total_weight_fg'   => $totalWeightFg,
            'total_weight_bb'   => $totalWeightBb,
            'total_weight_loss' => $totalWeightLoss
        ],200);
    }

}
