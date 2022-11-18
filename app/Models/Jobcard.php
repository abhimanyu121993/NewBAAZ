<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobcard extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function battery()
    {
        return $this->belongsTo(BatteryType::class, 'battery_id');
    }
}
