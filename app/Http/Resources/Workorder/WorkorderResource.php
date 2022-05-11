<?php

namespace App\Http\Resources\Workorder;

use App\Models\Smelting;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkorderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $status_prod = "Waiting";
        // if($this->status_prod == 1){
        //     $status_prod = "On Process";
        // }
        // $status_wo = "Open";
        // if($this->status_wo == 1){
        //     $status_wo = "Closed";
        // }
        $smeltingData   = Smelting::where('workorder_id',$this->id)->get();
        $smelting       = [];
        foreach($smeltingData as $smelt){
            $smelting[] = [
                'weight'        => $smelt->weight,
                'smelting_num'  => $smelt->smelting_num,
                'area'          => $smelt->area
            ]; 
        }
        return [
            'wo_number'         =>$this->wo_number,
            'bb_supplier'       =>$this->bb_supplier,
            'bb_grade'          =>$this->bb_grade,
            'bb_diameter'       =>$this->bb_diameter,
            'bb_qty_pcs'        =>$this->bb_qty_pcs,
            'bb_qty_coil'       =>$this->bb_qty_coil,
            'fg_customer'       =>$this->fg_customer,
            'fg_size_1'         =>$this->fg_size_1,
            'fg_size_2'         =>$this->fg_size_2,
            'tolerance_plus'    =>$this->tolerance_plus,
            'tolerance_minus'   =>$this->tolerance_minus,
            'fg_reduction_rate' =>$this->fg_reduction_rate,
            'fg_shape'          =>$this->fg_shape,
            'fg_qty'            =>$this->fg_qty,
            'wo_order_num'      =>$this->wo_order_num,
            'operator'          =>$this->operator,
            // 'status_prod'       =>$status_prod,
            'status_wo'         =>$this->status_wo,
            'machine'           =>$this->machine->name,
            'production_date'   =>$this->production_date,
            'user'              =>$this->user->name,
            'smelting_data'     =>$smelting
        ];
    }
}
