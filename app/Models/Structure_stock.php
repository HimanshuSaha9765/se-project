<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure_stock extends Model
{
    use HasFactory;

    public $table = "structure_stocks";
    protected $fillable = [
        'info_id',
        'structure_id',
        'total_qty',
        'used_qty',
        'remaining_qty',
        'date',
        'type',
    ];

    public function Structure_stock()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id', 'info_id');
    }
}
