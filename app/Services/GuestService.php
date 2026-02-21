<?php

namespace App\Services;

use App\Models\delete_token;
use App\Models\User;
use App\Repository\GuestRepo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class GuestService implements GuestRepo
{
    var $compact_data;
    public function get_a_quote(Request $request)
    {

        $data = ['name' => $request->name, 'email' => $request->email, 'mobile_number' => $request->mobile_number, 'service' => $request->service,'running_bill' => $request->running_bill ,'kilowatt' => $request->kilowatt,'address' => $request->address];
        Mail::send('quation_mail', ['data' => $data], function ($message) use ($data) {
            // $message->to('brightenergy2021@gmail.com',$data['name']);
            $message->to('info@belianceweb.com', $data['name']);
            $message->subject('Quation Mail');
        });

        return $this->compact_data = $data;
    }

}
