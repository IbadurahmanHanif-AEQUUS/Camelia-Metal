<?php

namespace App\Http\Resources\WorkorderReport;

use App\Models\Downtime;
use App\Models\DowntimeRemark;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkorderReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'workorder'             => $this->wo_number,
            'machine_name'          => $this->machine->name,
            // 'downtime_number'       => $this->downtime_number,
            // 'downtime'              => $this->downtime,
            // 'is_downtime_stopped'   => $this->is_downtime_stopped,
            // 'is_remark_filled'      => $this->is_remark_filled,
            // 'dt_status'             => $this->status,
            // 'start_time'            => call_user_func(function()
            // {
            //     $endTime = Downtime::select('time')->where('workorder_id',$this->workorder->id)
            //                 ->where('status','stop')->where('downtime_number',$this->downtime_number)->first();
            //     if(!$endTime)
            //     {
            //         return Date('H:i',strtotime($this->time));
            //     }
            //     return Date('H:i',strtotime($endTime->time));
            // }),
            // 'end_time'              => call_user_func(function()
            // {
            //     $startTime = Downtime::select('time')->where('workorder_id',$this->workorder->id)
            //                 ->where('status','run')->where('downtime_number',$this->downtime_number)->first();
            //     if(!$startTime)
            //     {
            //         return null;
            //     }
            //     return Date('H:i',strtotime($startTime->time));
            // }), 
            // 'duration'              => call_user_func(function()
            // {
            //     $endTime = Downtime::select('downtime')->where('workorder_id',$this->workorder->id)
            //                 ->where('status','run')->where('downtime_number',$this->downtime_number)->first();
            //     if(!$endTime)
            //     {
            //         return Date('H:i',strtotime($this->time));
            //     }
            //     if(($endTime->downtime / 60) >= 1)
            //     {
            //         $resultMin = floor($endTime->downtime / 60);
            //         $resultSec = $endTime->downtime - ($resultMin*60);
            //         return $resultMin." Min ".$resultSec." Sec";
            //     }
                
			// 	return $endTime->downtime." Sec";

            // }),  
            // 'updated_at'            => $this->updated_at,
			// 'is_waste_downtime'     => call_user_func(function()
            // {
            //     $is_waste_downtime = DowntimeRemark::select('is_waste_downtime')->where('downtime_id',$this->id)->first();
            //     if(!$is_waste_downtime)
            //     {
            //         return null;
            //     }
            //     if(!$is_waste_downtime->is_waste_downtime)
            //     {
            //         return null;
            //     }
            //     return $is_waste_downtime->is_waste_downtime;
            // }), 
			// 'downtime_reason'       => call_user_func(function()
            // {
            //     $downtime_reason = DowntimeRemark::select('downtime_reason')->where('downtime_id',$this->id)->first();
            //     if(!$downtime_reason)
            //     {
            //         return null;
            //     }
            //     return $downtime_reason->downtime_reason;
            // }), 
			// 'remarks'               => call_user_func(function()
            // {
            //     $remarks = DowntimeRemark::select('remarks')->where('downtime_id',$this->id)->first();
            //     if(is_null($remarks))
            //     {
            //         return '';
            //     }
            //     if(is_null($remarks->remarks))
            //     {
            //         return '';
            //     }
            //     return $remarks->remarks;
            // }), 
        ];
    }
}
