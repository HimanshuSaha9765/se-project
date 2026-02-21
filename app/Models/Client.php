<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $table = "clients";
    protected $fillable = [
        'info_id',
        'user_email_id',
        'consumer_number',
        'name',
        'mobile_number',
        'email',
        'bill_amount',
        'kw',
        'structure_length',
        'structure_width',
        'structure_height',
        'quotation_amount',
        'reference_by',
        'structure_image',
        'address',
        'status',
    ];

    public function Client()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
}
