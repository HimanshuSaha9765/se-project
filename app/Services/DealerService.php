<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;
use App\Repository\DealerRepo;
use App\Repository\GuestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class DealerService implements DealerRepo
{
    var $compact_data;
    public function dashboard()
    {
        $Dashboard_user_data = User::query()->where('status', '!=', 'deleted')->where('role','dealer');
        $email = session()->get('dealer');
        $Dashboard_client_data = Client::query()->where('status', '!=', 'deleted')->where('user_email_id',$email)->count();
        $this->compact_data['Dashboard_user_data'] = $Dashboard_user_data;
        $this->compact_data['Dashboard_client_data'] = $Dashboard_client_data;
        return $this->compact_data;
    }
}
