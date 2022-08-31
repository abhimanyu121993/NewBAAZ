<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkshopOrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function service_charge()
    {
        return $this->belongsTo(Service::class, 'value');
    }

    public function labour_charge()
    {
        return $this->belongsTo(ServiceCharge::class, 'value');
    }

    public function spare_charge()
    {
        return $this->belongsTo(OtherProduct::class, 'value');
    }
}
