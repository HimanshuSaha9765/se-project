<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiring_stock extends Model
{
    use HasFactory;
    public $table = "wiring_stocks";
    protected $fillable = [
        'info_id',
        'wiring_id',
        'total_qty',
        'used_qty',
        'remaining_qty',
        'date',
        'type',
    ];

    public function wiring_stock()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function wiring()
    {
        return $this->belongsTo(Wiring_Accessories::class, 'wiring_id', 'info_id');
    }
}
