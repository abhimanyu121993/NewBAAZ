<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function model()
    {
        return $this->belongsTo(BrandModel::class, 'model_id');
    }

    public function servicetype()
    {
        return $this->belongsTo(Service::class, 'service_type','id');
    }

    public function modelmap()
    {
        return $this->belongsTo(ModelServiceMap::class, 'service_type','service_id');
    }

    public function modelmapservice()
    {
        return $this->belongsTo(ModelServiceMap::class, 'model_id','model_id');
    }

}
