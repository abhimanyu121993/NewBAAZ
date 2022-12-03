<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSlider extends Model
{
   protected $table = 'footersliders';
   protected $fillable = ['title','image'];
    use HasFactory;
}