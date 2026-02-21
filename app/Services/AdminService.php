<?php

namespace App\Services;

use App\Models\Cable_stock;
use App\Models\Client;
use App\Models\Client_material;
use App\Models\Inverter_stock;
use App\Models\Panel_stock;
use App\Models\Structure_stock;
use App\Models\User;
use App\Models\Wiring_stock;
use App\Repository\AdminRepo;
use App\Repository\GuestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AdminService implements AdminRepo
{
    var $compact_data;

    public function dashboard(){
        $Dashboard_user_data = User::query()->whereRaw('status != ?', ['deleted']);
        $Dashboard_client_data = Client::query()->whereRaw('status != ?', ['deleted'])->count();

        $this->compact_data['Dashboard_user_data'] = $Dashboard_user_data;
        $this->compact_data['Dashboard_client_data'] = $Dashboard_client_data;

        return $this->compact_data;
    }

    public function manage_user(){
        $users = User::query()->where('status != ?', ['deleted'])->get();
        return $this->compact_data['users'] = $users;
    }
    
    // public function view_stock(){

    //     $structureStock = Structure_stock::where('status != ? ', ['deleted'])->get();
    //     $panelStock = Panel_stock::where('status != ? ', ['deleted'])->get();
    //     $inverterStock = Inverter_stock::where('status != ? ', ['deleted'])->get();
    //     $cableStock = Cable_stock::where('status != ? ', ['deleted'])->get();
    //     $wiringStock = Wiring_stock::where('status != ? ', ['deleted'])->get();

    //     $this->compact_data['structureStock'] = $structureStock;
    //     $this->compact_data['panelStock'] = $panelStock;
    //     $this->compact_data['inverterStock'] = $inverterStock;
    //     $this->compact_data['cableStock'] = $cableStock;
    //     $this->compact_data['wiringStock'] = $wiringStock;


    //     return $this->compact_data;
    // }

    public function material_report($request){
        $consumer_number = decrypt(request('authUser'));
        $client_materials = Client_material::whereRaw('consumer_number = ?', [$consumer_number]);
        return $this->compact_data['client_materials'] = $client_materials;
    }
}
