<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_material extends Model
{
    use HasFactory;
    public $table = "client_materials";
    protected $fillable = [
        'consumer_number',
        'structure',
        'total_structure_qty',
        'panel',
        'total_panel_qty',
        'inverter',
        'total_inverter_qty',
        'cable',
        'total_cable_qty',
        'wiring',
        'total_wiring_qty',
        'date'
    ];
    public function Client_material()
    {
        return $this->belongsTo(Client::class, 'consumer_number', 'consumer_number');
    }
}
