<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function userHasVehicles()
    {
        return $this->hasMany(UserVehicleMap::class, 'userid', 'id');
    }

    public function userad():HasMany
    {
        return $this->hasMany(UserAddress::class,'uid', 'id');
    }
}
