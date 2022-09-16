<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function model()
    {
        return $this->belongsTo(BrandModel::class, 'model_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    static public function getServiceDetail($user_id )
    {
        return DB::table('carts as c')
        ->select('c.id as cart_id', 'msm.service_id as service_id', 'msm.discounted_price as discounted_price' , 'msm.price as price', 's.name as service_name', 's.image as service_image', 'c.user_id as user_id')
        ->join('services as s', 's.cid', 'c.service_id')
        ->join('model_service_maps as msm', 'msm.service_id', 's.id')
        ->join('brand_models as bm', 'bm.id', 'msm.model_id')
        ->where('c.user_id', $user_id)
        ->get();
    }

}
