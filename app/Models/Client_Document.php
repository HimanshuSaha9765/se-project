<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_Document extends Model
{
    use HasFactory;

    public $table = "client_documents";
    protected $fillable = [
        'info_id',
        'consumer_number',
        'adharcard_number',
        'adharcard_image',
        'light_bill',
        'text_bill',
        'passport_size_image',
        'pancard',
        'bank_proof',
        'final_confirm_amount',
        'variation_amount',
        'deposit',
        'due_amount',
    ];
    public function Client_Document(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }

    public function Clients()
    {
        return $this->belongsTo(Client::class, 'consumer_number', 'consumer_number');
    }
}
