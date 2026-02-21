<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class references extends Model
{
    use HasFactory;
    public $table = "references";
    protected $fillable = [
        'info_id',
        'city_name',
        'name',
        'email_assign',
        'status',
    ];

    public function references()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
}
