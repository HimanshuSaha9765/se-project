<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delete_token extends Model
{
    use HasFactory;
    public $table = "delete_tokens";

    protected $fillable = [
        'email',
        'token',
        'otp',
        'expiry_time',
    ];
}
