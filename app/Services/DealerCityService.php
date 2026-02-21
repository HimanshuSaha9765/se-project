<?php

namespace App\Services;

use App\Models\dealer_city;
use App\Models\Log_Infos;
use App\Models\User;
use App\Repository\DealerCityRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DealerCityService implements DealerCityRepo
{
    var $compact_data;

    public function manage_dealer_city()
    {
        $Dealer_citys = dealer_city::query()->orderBy('id', 'desc')->whereRaw('status != ?', ['deleted'])->get();
        $this->compact_data['Dealer_citys'] = $Dealer_citys;
        return $this->compact_data;
    }
    public function insert_dealer_city(Request $request)
    {
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Dealer_city-' . $randomKeySha1;

        $email = session()->get('admin');
        $data = User::query()->where('email', $email)->first();
        // dd($data);
        // $data = User::where('id', $id)->first();

        $info = new Log_Infos();
        $info->table_id = $info_id;
        $info->created_ip = $request->ip();
        $info->created_name = $data->name;
        $info->created_email = $email;
        $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
        // dd($info);
        $info->save();



        $dealer_city = new dealer_city();

        $dealer_city->info_id = $info_id;
        $dealer_city->city_name = $request->city_name;

        if ($dealer_city->save()) {
            return "true";
        } else {
            return "false";
        }
        // dd($request->all());
    }
    public function edit_dealer_city($id)
    {
        $dealer_city = dealer_city::query()->whereRaw('id = ?', [$id])->first();
        return $dealer_city;
    }

    public function update_dealer_city($request)
    {
        // * Start Log Update
        $dealer_city_data = dealer_city::query()->whereRaw('id = ?', [$request->id])->first();

        // * Log Update
        $log_data = Log_Infos::query()->whereRaw('table_id = ?', [$dealer_city_data->info_id])->first();
        $email = session()->get('admin');
        // $id = User::where('email', $email)->first()->id;
        $data = User::where('email', $email)->first();

        if (!$log_data->updated_ip) {
            $log_data->update([
                'updated_ip' => $request->ip(),
                'updated_name' => $data->name,
                'updated_email' => $email,
                'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
            ]);
        } else {
            $info = new Log_Infos();
            $info->table_id = $log_data->table_id;
            $info->updated_ip = $request->ip();
            $info->updated_name = $data->name;
            $info->updated_email = $email;
            $info->updated_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
            $info->save();
        }
        // * End Log Update

        $dealer_city = dealer_city::query()->where('id', $request->id)
        ->update([
            'city_name' => $request->city_name,
        ]);

        if($dealer_city){
            return "true";
        }
        else{
            return "false";
        }
    }

    public function delete_dealer_city($id)
    {
        $dealer_city = dealer_city::query()->whereRaw('id = ?', [$id])->first();
        $dealer_city->update([
            'status' => 'deleted',
        ]);
        if ($dealer_city) {
            return 'true';
        }
        else{
            return 'false';
        }
    }

    public function update_dealer_city_status($id, $status)
    {
        // dd($id,$status);
        $dealer_city = dealer_city::query()->where('id', $id)->update(['status' => $status]);
        if ($dealer_city) {
            return 'true';
        }
        else{
            return 'false';
        }
    }
}
