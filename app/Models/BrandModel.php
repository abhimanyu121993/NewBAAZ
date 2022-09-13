<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'bid','id');
    }

    public function model_map()
    {
        return $this->hasMany(ModelServiceMap::class,'model_id');
    }
}
