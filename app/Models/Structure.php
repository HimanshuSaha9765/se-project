<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    public $table = "structures";
    protected $fillable = [
        'info_id',
        'accessories_name',
        'unit',
        'status',
    ];
    public function structure()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
}
