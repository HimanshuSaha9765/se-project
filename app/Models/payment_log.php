<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_log extends Model
{
    use HasFactory;
    public $table = "payment_logs";
    protected $fillable = [
        'info_id',
        'consumer_number',
        'payment_date',
        'various_amount',
        'reason',
        'payment_mode',
        'cheque_number',
        'bank_name',
        'type_of_payment',
        'transaction_number',
        'amount',
        'total_amount',
        'status',
    ];

    public function Payment()
    {
        return $this->belongsTo(Log_Infos::class, 'info_id', 'table_id');
    }
    public function Client_Document()
    {
        return $this->belongsTo(Client_Document::class, 'consumer_number', 'consumer_number');
    }
}
