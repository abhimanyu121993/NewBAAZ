<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cid');
    }

    public function model_map()
    {
        return $this->hasMany(ModelServiceMap::class, 'service_id');
    }

    static public function getServiceDetail($model_id)
    {
        return DB::table('categories as c')
        ->select('msm.service_id as service_id', 'msm.price as service_price', 's.name as service_name', 's.image as service_image')
        ->join('services as s', 's.cid', 'c.id')
        ->join('model_service_maps as msm', 'msm.service_id', 's.id')
        ->join('brand_models as bm', 'bm.id', 'msm.model_id')
        ->where('msm.model_id', $model_id)
        ->get();
    }

    static public function getServiceDetailById($service_id, $model_id)
    {
        return DB::table('categories as c')
        ->select('msm.service_id as service_id', 'msm.discounted_price as service_price', 's.name as service_name', 's.image as service_image')
        ->join('services as s', 's.cid', 'c.id')
        ->join('model_service_maps as msm', 'msm.service_id', 's.id')
        ->join('brand_models as bm', 'bm.id', 'msm.model_id')
        ->where('msm.service_id', $service_id)
        ->where('msm.model_id', $model_id)
        ->get();
    }

    static public function getServicePriceById($service_id, $model_id)
    {
        return DB::table('categories as c')
        ->join('services as s', 's.cid', 'c.id')
        ->join('model_service_maps as msm', 'msm.service_id', 's.id')
        ->join('brand_models as bm', 'bm.id', 'msm.model_id')
        ->where('msm.service_id', $service_id)
        ->where('msm.model_id', $model_id)
        ->pluck('msm.discounted_price');
    }


}
