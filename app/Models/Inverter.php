<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inverter extends Model
{
    use HasFactory;
    public $table = "inverters";
    protected $fillable = [
        'info_id',
        'inverter_name',
        'kw',
        'status',
    ];

    public function Inverter(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }
}
