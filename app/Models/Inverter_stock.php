<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inverter_stock extends Model
{
    use HasFactory;
    public $table = "inverter_stocks";
    protected $fillable = [
        'info_id',
        'inverter_id',
        'total_qty',
        'used_qty',
        'remaining_qty',
        'date',
        'type',
    ];

    public function inverter_stock()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function inverter()
    {
        return $this->belongsTo(Inverter::class, 'inverter_id', 'info_id');
    }
}
