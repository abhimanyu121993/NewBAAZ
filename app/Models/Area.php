<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function zones()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'id');
    }
}
