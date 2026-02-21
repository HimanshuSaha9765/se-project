<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiring_Accessories extends Model
{
    use HasFactory;
    public $table = "wiring_accessories";
    protected $fillable = [
        'info_id',
        'wiring_name',
        'unit',
        'status',
    ];
    public function Wiring_Accessories(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }
}
