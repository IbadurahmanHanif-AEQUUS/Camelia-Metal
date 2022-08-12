<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'date',
        'shift_1',
        'shift_2',
        'shift_3',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
