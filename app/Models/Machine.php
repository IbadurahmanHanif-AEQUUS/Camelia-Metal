<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'lines_id',
        'name'
    ];

    public function workorders()
    {
        return $this->hasMany(Workorder::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
