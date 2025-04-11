<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Clock extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        self::saving(function($clocks) {
            $clocks->user_id = \Auth::id();
        });
    }

    protected $fillable = ['user_id', 'clock_in', 'clock_out', 'break_time', 'clock_time'];
}
