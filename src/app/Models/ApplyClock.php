<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyClock extends Model
{
    use HasFactory;

    protected $fillable = ['clock_id', 'clock_in', 'clock_out', 'correction_check'];
}
