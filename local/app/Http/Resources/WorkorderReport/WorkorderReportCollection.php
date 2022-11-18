<?php

namespace App\Http\Resources\WorkorderReport;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\WorkorderReport\WorkorderReportResource;

class WorkorderReportCollection extends ResourceCollection
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
            WorkorderReportResource::collection($this->collection)
        ];
    }
}
