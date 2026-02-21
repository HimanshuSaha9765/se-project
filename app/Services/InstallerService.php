<?php

namespace App\Services;

use App\Models\Cable;
use App\Models\Client;
use App\Models\delete_token;
use App\Models\Inverter;
use App\Models\Panel;
use App\Models\Structure;
use App\Models\User;
use App\Models\Wiring_Accessories;
use App\Repository\GuestRepo;
use App\Repository\InstallerRepo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class InstallerService implements InstallerRepo
{
    var $compact_data;
   
    public function installer_dashboard()
    {
        $Dashboard_user_data = User::query()->whereRaw('status != ?', ['deleted']);
        $Dashboard_client_data = Client::query()->where('status', '!=', 'deleted')->where('process_of_client','Yes')->count();
        $this->compact_data['Dashboard_user_data'] = $Dashboard_user_data;
        $this->compact_data['Dashboard_client_data'] = $Dashboard_client_data;
        return $this->compact_data;
    }
    public function manage_sell_product()
    {
        $clients = Client::query()->orderBy('id', 'desc')->where('status', '!=', 'deleted')->where("process_of_client", 'Yes')->get();
        $this->compact_data['clients'] = $clients;
        return $this->compact_data;
    }
    
    public function client_stock_details($consumer_number)
    {
        try {
            $consumer_number = encrypt($consumer_number);
            $this->compact_data['consumer_number'] = $consumer_number;
            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function add_material()
    {
        $consumer_number = decrypt(request('authUser'));
        $structures = Structure::query()->whereRaw('status != ?', ['deleted'])->get();
        $panels = Panel::query()->whereRaw('status != ?', ['deleted'])->get();
        $inverters = Inverter::query()->whereRaw('status != ?', ['deleted'])->get();
        $cables = Cable::query()->whereRaw('status != ?', ['deleted'])->get();
        $wirings = Wiring_Accessories::query()->whereRaw('status != ?', ['deleted'])->get();
        
        $this->compact_data['consumer_number'] = $consumer_number;
        $this->compact_data['structures'] = $structures;
        $this->compact_data['panels'] = $panels;
        $this->compact_data['inverters'] = $inverters;
        $this->compact_data['cables'] = $cables;
        $this->compact_data['wirings'] = $wirings;
        return $this->compact_data;
    }

    

}
