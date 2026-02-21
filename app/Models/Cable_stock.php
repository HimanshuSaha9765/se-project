<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cable_stock extends Model
{
    use HasFactory;
    public $table = "cable_stocks";
    protected $fillable = [
        'info_id',
        'cable_id',
        'total_qty',
        'used_qty',
        'remaining_qty',
        'date',
        'type',
    ];

    public function cable_stock()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function cable()
    {
        return $this->belongsTo(Cable::class, 'cable_id', 'info_id');
    }
}
