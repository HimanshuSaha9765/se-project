<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    public $table = "stocks";
    protected $fillable = [
        'product_id',
        'product_name',
        'product_total_quantity',
        'total_sell_quantity',
        'total_remain_quantity',
    ];

    public function stock()
    {
        return $this->belongsTo(Purchase_produc::class, 'product_id', 'product_id');
    }
}
