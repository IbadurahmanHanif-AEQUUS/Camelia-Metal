<?php

namespace App\Http\Resources\Downtime;

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
            'downtime'              => $this->downtime,
            'is_downtime_stopped'   => $this->is_downtime_stopped,
            'is_remark_filled'      => $this->is_remark_filled,
            'status'                => $this->status,
            'time'                  => $this->time,
            'updated_at'            => $this->updated_at,
        ];
    }
}
