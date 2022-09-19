<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return $this->belongsTo(Service::class, 'service_id', 'id')->with('model_map');
    }

    static public function getServiceDetail($user_id )
    {
        return DB::table('carts as c')
        ->join('services as s', 's.id', 'c.service_id')
        ->where('c.user_id', $user_id)
        ->get();
    }

}
