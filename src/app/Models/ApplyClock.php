<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyClock extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_id', 'clock_in', 'clock_out', 'remark', 'correction_check'];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
