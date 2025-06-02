<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyBreak extends Model
{
    use HasFactory;

    protected $fillable = ['apply_clock_id', 'break_time_id', 'break_in', 'break_out', 'correction_check'];

     protected $casts = [
        'break_in' => 'datetime',
        'break_out' => 'datetime'
    ];
}
