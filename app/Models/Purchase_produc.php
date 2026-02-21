<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_produc extends Model
{
    use HasFactory;

    public $table = "purchase_producs";
    protected $fillable = [
        'info_id',
        'product_id',
        'product_name',
        'product_quantity',
        'date',
    ];

    public function Purchase_produc_info()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function Purchase_produc()
    {
        return $this->belongsTo(add_product::class, 'product_id', 'product_id');
    }
}
