<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smelting extends Model
{
    use HasFactory;
    protected $fillable = [
        'workorder_id',
        'coil_num',
        'weight',
        'smelting_num',
        'area',
    ];

    public function workorder(){
        return $this->belongsTo(Workorder::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }
}
