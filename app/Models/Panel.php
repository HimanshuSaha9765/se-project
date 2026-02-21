<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;
    public $table = "panels";
    protected $fillable = [
        'info_id',
        'panel_name',
        'category',
        'status',
    ];
    public function Panel(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }
}
