<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchLocation extends Model
{
    use HasFactory;


    public $table = "branch_locations";
    protected $fillable = [
        'info_id',
        'branch_location_name',
        'address',
        'email',
        'mobile_number',
        'location_link',
        'working_time',
        'is_head_branch',
        'status',
    ];

    public function BranchLocation(){
        return $this->belongsTo(Log_Infos::class,'info_id','table_id');
    }


}
