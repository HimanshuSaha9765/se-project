<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sell_product_demo_data extends Model
{
    use HasFactory;
    public $table = "sell_product_demo_datas";
    protected $fillable = [
        'consumer_number',
        'product_id',
        'product_name',
        'product_quantity',
    ];
}
