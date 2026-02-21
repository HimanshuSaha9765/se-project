<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dealer_city extends Model
{
    public $table = "dealer_citys";
    protected $fillable = [
        'info_id',
        'city_name',
        'status',
    ];
    use HasFactory;
}
