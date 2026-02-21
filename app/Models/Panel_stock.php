<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel_stock extends Model
{
    use HasFactory;
    public $table = "panel_stocks";
    protected $fillable = [
        'info_id',
        'panel_id',
        'total_qty',
        'used_qty',
        'remaining_qty',
        'date',
        'type',
    ];

    public function panel_stock()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function panel()
    {
        return $this->belongsTo(panel::class, 'panel_id', 'info_id');
    }
}
