<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = ['clock_id', 'break_in', 'break_out'];

    protected $casts = [
        'break_in' => 'datetime',
        'break_out' => 'datetime'
    ];
}
