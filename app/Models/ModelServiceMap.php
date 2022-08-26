<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelServiceMap extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function model()
    {
        return $this->belongsTo(BrandModel::class, 'model_id');
    }

    public function fuel_type()
    {
        return $this->belongsTo(FuelType::class, 'fuel_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
