<?php

namespace App\Http\Resources\Downtime;

use App\Models\Downtime;
use Illuminate\Http\Resources\Json\JsonResource;

class DowntimeResource extends JsonResource
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
            'workorder'             => $this->workorder,
            'machine_name'          => $this->workorder->machine->name,
            'downtime_number'       => $this->downtime_number,
            'downtime'              => $this->downtime,
            'is_downtime_stopped'   => $this->is_downtime_stopped,
            'is_remark_filled'      => $this->is_remark_filled,
            'dt_status'             => $this->status,
            'start_time'            => call_user_func(function()
            {
                $startTime = Downtime::select('time')->where('workorder_id',$this->workorder->id)
                            ->where('status','run')->where('downtime_number',$this->downtime_number)->first();
                if(!$startTime)
                {
                    return null;
                }
                return Date('H:i',strtotime($startTime->time));
            }),
            'end_time'              => Date('H:i',strtotime($this->time)),           
            'updated_at'            => $this->updated_at,
        ];
    }
}
