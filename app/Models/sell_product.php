<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sell_product extends Model
{
    use HasFactory;

    public $table = "sell_products";
    protected $fillable = [
        'info_id',
        'consumer_number',
        'customer_number',
        'product_id',
        'product_name',
        'product_quantity',
        'date',
    ];

    public function sell_product_info()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function sell_product_client()
    {
        return $this->belongsTo(Client::class, 'consumer_number', 'consumer_number');
    }
    public function sell_productS()
    {
        return $this->belongsTo(stock::class, 'product_id', 'product_id');
    }
}
