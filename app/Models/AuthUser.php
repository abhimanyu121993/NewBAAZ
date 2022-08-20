<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\AuthUser as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AuthUser extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = [];
}
