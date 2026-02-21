<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_product extends Model
{
    use HasFactory;

    public $table = "add_products";
    protected $fillable = [
        'info_id',
        'product_id',
        'product_name',
        'unit',
        'status',
    ];

    public function add_product()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
}
