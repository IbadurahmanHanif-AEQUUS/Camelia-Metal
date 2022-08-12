<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'break_1_start',
        'breat_1_end',
        'break_2_start',
        'breat_2_end',
        'break_3_start',
        'breat_3_end',
        'break_4_start',
        'breat_4_end',
        'break_5_start',
        'breat_5_end'
    ];
    
}
