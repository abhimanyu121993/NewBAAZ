<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkshopOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function workshop_order_details()
    {
        return $this->hasMany(WorkshopOrderDetail::class, 'workshop_order_id');
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}
