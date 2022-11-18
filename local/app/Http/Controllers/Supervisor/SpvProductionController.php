<?php

namespace App\Http\Controllers\supervisor;

use DateTime;
use App\Models\Oee;
use App\Models\User;
use App\Models\Color;
use App\Models\Downtime;
use App\Models\Realtime;
use App\Models\Smelting;
use App\Models\Workorder;
use App\Models\Production;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use App\Models\DowntimeRemark;
use App\Http\Requests\OeeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductionRequest;
use App\Http\Resources\Downtime\DowntimeCollection;

class SpvProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supervisor.production.index',[
            'title' => 'Supervisor Index'
        ]);
    }

    public function showOnCheck()
    {
        $workorders = Workorder::where('status_wo','on check')->orderBy('updated_at','desc');
        return datatables()->of($workorders)
            ->addColumn('bb_qty_combine',function(Workorder $model){
                $combines = $model->bb_qty_pcs . " / " . $model->bb_qty_coil;
                return $combines;
            })
            ->addColumn('fg_size_combine',function(Workorder $model){
                $combines = $model->fg_size_1 . " x " . $model->fg_size_2;
                return $combines;
            })
            ->addColumn('tolerance_combine',function(Workorder $model){
                $combines = '(-'.$model->tolerance_minus.',+'.$model->tolerance_plus.')';
                return $combines;
            })
            ->addColumn('color',function(Workorder $model){
                $color = Color::where('id',$model->color)->first();
                return $color->name;
            })
            ->addColumn('machine',function(Workorder $model){
                return $model->machine->name;
            })
            ->addColumn('created_by',function(Workorder $model){
                $user = User::where('id',$model->created_by)->first();
                return $user->name;
            })
            ->addColumn('created_at',function(Workorder $model){
                return Date('Y-m-d H:i:s',strtotime($model->created_at));
            })
            ->addColumn('edited_by',function(Workorder $model){
                $user = User::where('id',$model->edited_by)->first();
                return $user->name;
            })
            ->addColumn('updated_at',function(Workorder $model){
                $user = User::where('id',$model->edited_by)->first();
                if(!$user)
                {
                    return '';
                }
                return Date('Y-m-d H:i:s',strtotime($user->updated_at));
            })
            ->addColumn('processed_by',function(Workorder $model){
                $user = User::where('id',$model->processed_by)->first();
                return $user->name;
            })
            ->addColumn('process_start',function(Workorder $model){
                return Date('Y-m-d H:i:s',strtotime($model->process_start));
            })
            ->addColumn('action','supervisor.production.action')
            ->setRowId(function(Workorder $model){
                return $model->id;
            })
            ->addColumn('smelting','user.smelting.smelting')
            ->rawColumns(['smelting','action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function getSmeltingNum(Request $request)
    {
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        $smelting   = Smelting::where('workorder_id',$workorder->id)->where('bundle_num',$request->bundle_num)->first();
        return response()->json([
            $smelting->smelting_num
        ]);
    }

    public function getProductionInfo(Request $request)
    {
        $production = Production::where('workorder_id',$request->workorder_id)
                        ->where('bundle_num',$request->smelting_number)->first();
        if (!$production) {
            return response()->json('Data not found',404);
        }
        return response()->json($production,200);
    }

    public function finish(Workorder $workorder)
    {
        $downtime = Downtime::where('workorder_id',$workorder->id)->get();

        $production = Production::where('workorder_id',$workorder->id)->get();
        if($workorder->bb_qty_bundle != count($production))
        {
            return redirect(route('spvproduction.show',$workorder));
        }

        if (count($downtime) > 0) {
            $downtimeRemarkUncomplete = Downtime::where('workorder_id',$workorder->id)->where('is_remark_filled',false)->first();
            if(!is_null($downtimeRemarkUncomplete))
            {
                return redirect(route('spvproduction.show',$workorder));
            }
    
            $downtimeRun = Downtime::where('workorder_id',$workorder->id)->where('is_downtime_stopped',false)->first();
            if(!is_null($downtimeRun))
            {
                return redirect(route('spvproduction.show',$workorder));
            }
        }

        $workorder->update([
            'status_wo'=>'closed',
            'process_end'=>date('Y-m-d H:i:s'),
        ]);

        //
        // total runtime calculation
        //
            $plannedTime = 100;
            if(is_null($workorder->process_end))
            {
                $plannedTime = date_diff(new DateTime($workorder->process_start),new DateTime(now()));
                // $plannedTime = $workorder->process_start->date_diff(strtotime(date('Y-m-d H:i:s')));
            }else{
                $plannedTime = date_diff(new DateTime($workorder->process_start),new DateTime($workorder->process_end));
            }
            $plannedTimeMinutes = $plannedTime->days * 24 * 60;
            $plannedTimeMinutes += $plannedTime->h * 60;
            $plannedTimeMinutes += $plannedTime->i;

        //
        // Downtimes
        //
            $totalDowntime = 0;
            $wasteDowntime = 0;
            $managementDowntime = 0;
            $downtimes = Downtime::where('status','stop')
                            ->where('workorder_id',$workorder->id)
                            ->get();
            $downtimeSummary = Downtime::where('status','run')
                                    ->where('workorder_id',$workorder->id)
                                    ->get();
            foreach($downtimeSummary as $dt)
            {
                $downtimeStopId = Downtime::where('status','stop')
                                    ->where('downtime_number',$dt->downtime_number)
                                    ->first();
                $downtimeRemark = DowntimeRemark::where('downtime_id',$downtimeStopId->id)->first();

                if(!$downtimeRemark)
                {
                    continue;
                }

                if($downtimeRemark->is_waste_downtime)
                {
                    $wasteDowntime += $dt->downtime;
                }
                if(!$downtimeRemark->is_waste_downtime)
                {
                    $managementDowntime += $dt->downtime;
                }
                $totalDowntime += $dt->downtime;
            }
            $total_downtime = 0;
            $waste_downtime = 0;
            $management_downtime = 0;
        //
        // Total Downtime Calculation
        //
            if(($totalDowntime / 60) >=1)
            {
                $total_downtime_min = floor($totalDowntime/60);
                $total_downtime_sec = $totalDowntime - ($total_downtime_min * 60);
                $total_downtime = $total_downtime_min." min ".$total_downtime_sec." sec";
            }
            else{
                $total_downtime = $totalDowntime." sec";
            }
        //
        // Waste Downtime Calculation
        //
            $waste_downtime_min = 0;
            if(($wasteDowntime / 60) >=1)
            {
                $waste_downtime_min = floor($wasteDowntime/60);
                $waste_downtime_sec = $wasteDowntime - ($waste_downtime_min * 60);
                $waste_downtime = $waste_downtime_min." min ".$waste_downtime_sec." sec";
            }
            else{
                $waste_downtime = $wasteDowntime." sec";
            }
        //
        // Management Downtime Calculation
        //
            if(($managementDowntime / 60) >=1)
            {
                $management_downtime_min = floor($managementDowntime/60);
                $management_downtime_sec = $managementDowntime - ($management_downtime_min * 60);
                $management_downtime = $management_downtime_min." min ".$management_downtime_sec." sec";
            }
            else{
                $management_downtime = $managementDowntime." sec";
            }
        //
        // Total Good Product Calculation
        //
            $total_good_product = 0;
            $good_products = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
            foreach($good_products as $good_pro)
            {
                $total_good_product += $good_pro->pcs_per_bundle;
            }

        //
        // Total Bad Product Calculation
        //
            $total_bad_product = 0;
            $bad_products = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',0)->get();  
            foreach($bad_products as $bad_pro)
            {
                $total_bad_product += $bad_pro->pcs_per_bundle;
            }
        //
        // Total Weight Product Calculation
        //
            $total_weight = 0;
            $weights = Production::select('berat_fg')->where('workorder_id',$workorder->id)->get();  
            foreach($weights as $weight)
            {
                $total_weight += $weight->berat_fg;
            }


        //
        // Daily Report
        //

            DailyReport::create([
                'workorder_id'      => $workorder->id,
                'total_runtime'     => $plannedTimeMinutes,
                'total_downtime'    => $waste_downtime_min,
                'total_pcs'         => $total_bad_product + $total_good_product,
                'total_pcs_good'    => $total_good_product,
                'total_pcs_bad'     => $total_bad_product,
                'total_weight_fg'   => $total_weight,
                'total_weight_bb'   => $workorder->bb_qty_pcs
            ]);

        return redirect(route('spvproduction.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductionRequest $request)
    {
        //
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        if(!$workorder)
        {
            return response()->json([
                'message' => 'Workorder Not Found'
            ],400);
        }
        $production = Production::where('workorder_id',$request->workorder_id)->where('bundle_num',$request->bundle_num)->get();
        if(count($production) != 0)
        {
            return response()->json([
                'message' => 'Data Already Input'
            ],400);
        }
        $production = Production::create([
            'workorder_id'      => $request->workorder_id,
            'bundle_num'        => $request->bundle_num,
            'dies_num'          => $request->dies_num,
            'diameter_ujung'    => $request->diameter_ujung,
            'diameter_tengah'   => $request->diameter_tengah,
            'diameter_ekor'     => $request->diameter_ekor,
            'kelurusan_aktual'  => $request->kelurusan_aktual,
            'panjang_aktual'    => $request->panjang_aktual,
            'berat_fg'          => $request->berat_fg,
            'pcs_per_bundle'    => $request->pcs_per_bundle,
            'bundle_judgement'  => $request->bundle_judgement,
            'visual'            => $request->visual
        ]);

        $smeltingData = Smelting::select('id')->where('workorder_id',$workorder->id)->get();
        $smeltingNum = count($smeltingData);
        $productionData = Production::select('id')->where('workorder_id',$workorder->id)->get();
        $productionNum = count($productionData);
        $oeeData        = Oee::select('id')->where('workorder_id',$workorder->id)->first();
        if($smeltingNum == $productionNum && $oeeData != null){
            Workorder::where('id',$workorder->id)->update(['status_wo'=>'closed']);
        }

        return response()->json([
            'message' => 'Submitted Successfully'
        ],201);
    }

    public function speedChart(Request $request)
    {
        //
        $data = json_decode(Realtime::select('speed','created_at')->where('workorder_id',$request->workorder)->orderBy('created_at','desc')->limit(20)->get());
        $response = [
            'speed'         => array_column($data,'speed'),
            'created_at'    => array_column($data,'created_at')
        ];
        for ($i=0; $i < count($response['created_at']); $i++) { 
            $response['created_at'][$i] = date('H:i:s',strtotime($response['created_at'][$i]));
        }
        return response()->json($response);
    }

    // public function storeOee(OeeRequest $request)
    // {
    //     //
    //     $workorder = Workorder::where('id',$request->workorder_id)->first();
    //     if(!$workorder)
    //     {
    //         return response()->json([
    //             'message' => 'Workorder Not Found'
    //         ],400);
    //     }
    //     $oee = Oee::where('workorder_id',$request->workorder_id)->first();
    //     if($oee != null)
    //     {
    //         return response()->json([
    //             'message' => 'Data Already Input'
    //         ],400);
    //     }
    //     $oee = Oee::create([
    //         'workorder_id'              => $request->workorder_id,
    //         'dt_briefing'               => $request->dt_briefing,
    //         'dt_cek_shot_blast'         => $request->dt_cek_shot_blast,
    //         'dt_cek_mesin'              => $request->dt_cek_mesin,
    //         'dt_sambung_bahan'          => $request->dt_sambung_bahan,
    //         'dt_bongkar_pasang_dies'    => $request->dt_bongkar_pasang_dies,
    //         'dt_setting_awal'           => $request->dt_setting_awal,
    //         'dt_selesai_satu_bundle'    => $request->dt_selesai_satu_bundle,
    //         'dt_cleaning_area_mesin'    => $request->dt_cleaning_area_mesin,
    //         'dt_tunggu_bahan_baku'      => $request->dt_tunggu_bahan_baku,
    //         'dt_ganti_bahan_baku'       => $request->dt_ganti_bahan_baku,
    //         'dt_tunggu_dies'            => $request->dt_tunggu_dies,
    //         'dt_gosok_dies'             => $request->dt_gosok_dies,
    //         'dt_ganti_part_shot_blast'  => $request->dt_ganti_part_shot_blast,
    //         'dt_putus_dies'             => $request->dt_putus_dies,
    //         'dt_setting_ulang_kelurusan'    => $request->dt_setting_ulang_kelurusan,
    //         'dt_ganti_polishing_dies'   => $request->dt_ganti_polishing_dies,
    //         'dt_ganti_nozle_polishing_mesin'    => $request->dt_ganti_nozle_polishing_mesin,
    //         'dt_ganti_roller_straightener'  => $request->dt_ganti_roller_straightener,
    //         'dt_dies_rusak'             => $request->dt_dies_rusak,
    //         'dt_mesin_trouble_operator' => $request->dt_mesin_trouble_operator,
    //         'dt_validasi_qc'            => $request->dt_validasi_qc,
    //         'dt_mesin_trouble_maintenance'  => $request->dt_mesin_trouble_maintenance,
    //         'dt_istirahat'              => $request->dt_istirahat,
    //         'total_runtime'             => $request->total_runtime,
    //         'total_downtime'            => $request->total_downtime
    //     ]);

    //     $smeltingData = Smelting::select('id')->where('workorder_id',$workorder->id)->get();
    //     $smeltingNum = count($smeltingData);
    //     $productionData = Production::select('id')->where('workorder_id',$workorder->id)->get();
    //     $productionNum = count($productionData);
    //     $oeeData        = Oee::select('id')->where('workorder_id',$workorder->id)->first();
    //     if($smeltingNum == $productionNum && $oeeData != null){
    //         Workorder::where('id',$workorder->id)->update(['status_wo'=>'closed']);
    //     }

    //     return response()->json([
    //         'message' => 'Submitted Successfully'
    //     ],201);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Workorder $workorder)
    {
        //
        // Check Workorder is on process
        //
        if($workorder->status_wo != 'on check')
        {
            return redirect(route('production.index'));
        }

        //
        // Poductions
        //
        $productions    = Production::where('workorder_id',$workorder->id)->get();
        $productionCount = 0;
        foreach($productions as $prod)
        {
            $productionCount += $prod->pcs_per_bundle;
        }

        //
        // Smeltings
        //
        $smeltings      = Smelting::where('workorder_id',$workorder->id)->orderBy('coil_num','ASC')->get();
        $smeltingInputList = [];
        foreach ($smeltings as $smelting) 
        {
            $productionCheck = Production::where('workorder_id',$workorder->id)->where('coil_num',$smelting->bundle_num)->first();
            if($productionCheck == null)
            {
                $smeltingInputList[] = $smelting->coil_num;
            }
        }

        //
        // Downtimes
        //
        $totalDowntime = 0;
        $wasteDowntime = 0;
        $managementDowntime = 0;
        $downtimes = Downtime::where('status','stop')
                        ->where('workorder_id',$workorder->id)
                        ->get();
        $downtimeSummary = Downtime::where('status','run')
                                ->where('workorder_id',$workorder->id)
                                ->get();
        foreach($downtimeSummary as $dt)
        {
            $downtimeStopId = Downtime::where('status','stop')
                                ->where('downtime_number',$dt->downtime_number)
                                ->first();
            $downtimeRemark = DowntimeRemark::where('downtime_id',$downtimeStopId->id)->first();

            if(!$downtimeRemark)
            {
                continue;
            }

            if($downtimeRemark->is_waste_downtime)
            {
                $wasteDowntime += $dt->downtime;
            }
            if(!$downtimeRemark->is_waste_downtime)
            {
                $managementDowntime += $dt->downtime;
            }
            $totalDowntime += $dt->downtime;
        }
        $total_downtime = 0;
        $waste_downtime = 0;
        $management_downtime = 0;

        // Total Downtime Calculation
        if(($totalDowntime / 60) >=1)
        {
            $total_downtime_min = floor($totalDowntime/60);
            $total_downtime_sec = $totalDowntime - ($total_downtime_min * 60);
            $total_downtime = $total_downtime_min." min ".$total_downtime_sec." sec";
        }
        else{
            $total_downtime = $totalDowntime." sec";
        }

        // Waste Downtime Calculation
        if(($wasteDowntime / 60) >=1)
        {
            $waste_downtime_min = floor($wasteDowntime/60);
            $waste_downtime_sec = $wasteDowntime - ($waste_downtime_min * 60);
            $waste_downtime = $waste_downtime_min." min ".$waste_downtime_sec." sec";
        }
        else{
            $waste_downtime = $wasteDowntime." sec";
        }

        // Management Downtime Calculation
        if(($managementDowntime / 60) >=1)
        {
            $management_downtime_min = floor($managementDowntime/60);
            $management_downtime_sec = $managementDowntime - ($management_downtime_min * 60);
            $management_downtime = $management_downtime_min." min ".$management_downtime_sec." sec";
        }
        else{
            $management_downtime = $managementDowntime." sec";
        }

        // Total Good Product Calculation
        $total_good_product = 0;
        $good_products = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
        foreach($good_products as $good_pro)
        {
            $total_good_product += $good_pro->pcs_per_bundle;
        }

        // Total Bad Product Calculation
        $total_bad_product = 0;
        $bad_products = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',0)->get();  
        foreach($bad_products as $bad_pro)
        {
            $total_bad_product += $bad_pro->pcs_per_bundle;
        }

        //
        // Performance Calculation
        //
        $per = 0;
        $productionPlanned = ($workorder->fg_qty_pcs * $workorder->bb_qty_bundle);
        if ($productionCount == 0) {
            $per = 100;
        }else{
            $per = ($productionCount / $productionPlanned)*100;
        }

        //
        // Availability Calculation
        //
        $plannedTime = 100;
        if(is_null($workorder->process_end))
        {
            $plannedTime = date_diff(new DateTime($workorder->process_start),new DateTime(now()));
            // $plannedTime = $workorder->process_start->date_diff(strtotime(date('Y-m-d H:i:s')));
        }else{
            $plannedTime = date_diff(new DateTime($workorder->process_start),new DateTime($workorder->process_end));
        }
        $plannedTimeMinutes = $plannedTime->days * 24 * 60;
        $plannedTimeMinutes += $plannedTime->h * 60;
        $plannedTimeMinutes += $plannedTime->i;

        $otr = 0;
        if (floor($wasteDowntime/60) == 0) {
            $otr = 100;
        }
        else{
            $otr = (($plannedTimeMinutes - (floor($wasteDowntime/60))) / $plannedTimeMinutes)*100;
        }

        //
        // Quality Calculation
        //

        $qr = 0;
        if ($productionCount == 0) {
            $qr = 100;
        }else{
            $qr = ($total_good_product / $productionCount)*100;
        }

        //
        // OEE
        //

        $oee = 0;
        $oee = (($per/100) * ($otr/100) * ($qr/100))*100;
        if($oee > 100){
            $oee = 100;
        }

		return view('supervisor.production.show_detail',[
            'title'                 => 'Production Report',
            'workorder'             => $workorder,
            'color'                 => Color::where('id',$workorder->color)->first()->name,
            'user_involved'         => [
                'created_by'        => User::where('id',$workorder->created_by)->first()->name,
                'edited_by'         => User::where('id',$workorder->edited_by)->first()->name,
                'processed_by'      => User::where('id',$workorder->processed_by)->first()->name,
            ],
            'smeltings'             => $smeltings,
            'productions'           => $productions,
            'reports'               => [
                'production_plan'   => $productionPlanned,
                'production_count'  => $productionCount." Pcs",
			    'total_good_product'=> $total_good_product." Pcs",
                'total_bad_product' => $total_bad_product." Pcs",
                'planned_time'      => $plannedTimeMinutes,
                'total_downtime'    => $total_downtime,
                'waste_downtime'    => $waste_downtime,
                'management_downtime'   => $management_downtime,
            ],
            'indicator'             => [
                'performance'   => round($per,1),
                'availability'  => round($otr,1),
                'quality'       => round($qr,1),
                'oee'           => round($oee,1),
            ],
            'smeltingInputList'     => $smeltingInputList,
            // 'oee'                   => $oee,
             'downtimes'            => $downtimes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        return view('supervisor.production.edit',[
            'production'=>$production,
            'smeltings' =>Smelting::where('workorder_id',$production->workorder_id)->get(),
            'title'=>'Supervisor: Edit Bundle Report'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductionRequest $request,Production $production)
    {
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        if(!$workorder)
        {
            return response()->json([
                'message' => 'Workorder Not Found'
            ],400);
        }

        $production->update([
            'coil_num'          => $request->coil_num,
            'dies_num'          => $request->dies_num,
            'diameter_ujung'    => $request->diameter_ujung,
            'diameter_tengah'   => $request->diameter_tengah,
            'diameter_ekor'     => $request->diameter_ekor,
            'kelurusan_aktual'  => $request->kelurusan_aktual,
            'panjang_aktual'    => $request->panjang_aktual,
            'berat_fg'          => $request->berat_fg,
            'pcs_per_bundle'    => $request->pcs_per_bundle,
            'bundle_judgement'  => $request->bundle_judgement,
            'visual'            => $request->visual,
            'edited_by'         => Auth::user()->id,
        ]);

        return redirect()->route('spvproduction.show',$production->workorder_id)->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        //
        $production->delete();
        return redirect()->route('spvproduction.show',$production->workorder_id)->with('success','Data Deleted Successfully');
    }
}
