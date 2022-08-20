<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function countries()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class,'id');
    }
}
