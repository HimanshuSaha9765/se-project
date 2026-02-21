<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client_tracking extends Model
{
    use HasFactory;

    public $table = "client_trackings";
    protected $fillable = [
        'consumer_number',
        'application_number_1',
        'appication_1',
        'amount_1',
        'document_verified_2',
        'resion_2',
        'metter_fee_3',
        'fesibility_approved_4',
        'resion_4',
        'structure_image_5',
        'make_of_module_6',
        'sr_no_module_6',
        'module_mount_image_6',
        'inverter_image7',
        'serial_number_image7',
        'serial_number7',
        'perform_8',
        'form_16_8',
        'jr_form_9',
        'subsidy_clamp_9',
        'amount_9',
        'description_9',
        'recived_9',
        'pdf_9',
    ];

    public function client_tracking()
    {
        return $this->belongsTo(Client::class, 'consumer_number', 'consumer_number');
    }
}
