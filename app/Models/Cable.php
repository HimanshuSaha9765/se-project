<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    use HasFactory;
    public $table = "cables";
    protected $fillable = [
        'info_id',
        'cable_name',
        'unit',
        'status',
    ];

    public function Cable(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }
}
