<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;
use App\Repository\EmployeeRepo;
use App\Repository\GuestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmployeeService implements EmployeeRepo
{ 
    var $compact_data;
    public function dashboard(){
        $Dashboard_user_data = User::query()->whereRaw('status != ?', ['deleted']);
        $Dashboard_client_data = Client::query()->whereRaw('status != ?', ['deleted'])->count();
        $this->compact_data['Dashboard_user_data'] = $Dashboard_user_data;
        $this->compact_data['Dashboard_client_data'] = $Dashboard_client_data;
        return $this->compact_data;
    }
}
