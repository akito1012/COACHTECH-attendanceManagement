<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyBreak extends Model
{
    use HasFactory;

    protected $fillable = ['breakTime_id', 'break_in', 'break_out', 'correction_check'];
}
