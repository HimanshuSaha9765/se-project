<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_Infos extends Model
{
    use HasFactory;
    public $table = "log_infos";
    protected $fillable = [
        'table_id',
        'created_ip',
        'created_name',
        'created_email',
        'created_date',
        'updated_ip',
        'updated_name',
        'updated_email',
        'updated_date',
    ];
}
