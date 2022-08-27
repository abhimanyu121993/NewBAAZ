<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function slot_detail()
    {
        return $this->belongsTo(Slot::class, 'slot' );
    }

    public function order_status_detail()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }

    public function jobcard()
    {
        return $this->belongsTo(Order::class, 'order_id' );
    }
}
