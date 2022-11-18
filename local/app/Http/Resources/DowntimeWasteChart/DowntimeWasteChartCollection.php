<?php

namespace App\Http\Resources\DowntimeWasteChart;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DowntimeWasteChartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=> DowntimeWasteChartResource::collection($this->collection),
            'meta'=>[
                'total_downtime_data'=>$this->collection->count()
            ]
        ];
    }
}
