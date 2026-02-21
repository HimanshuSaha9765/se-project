<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Client;
use App\Models\Inverter;
use App\Models\Panel;
use App\Models\Structure;
use App\Models\User;
use App\Models\Wiring_Accessories;
use App\Services\InstallerService;
use Exception;
use Illuminate\Http\Request;

class InstallerController extends Controller
{
    // public function dashboard()
    // {
    //     return view("installer.dashboard");
    // }
    public InstallerService $installerService;

    public function __construct(InstallerService $installerService){
        $this->installerService = $installerService;
    }
   
    var $compact_data;
    public function installer_dashboard()
    {
        $this->compact_data = $this->installerService->installer_dashboard();
        return view("installer.dashboard", $this->compact_data);
    }
    public function manage_sell_product()
    {
        $this->compact_data = $this->installerService->manage_sell_product();
        return view("installer.manage_sell_product", $this->compact_data);
    }
    public function client_stock_details($consumer_number)
    {
        $this->compact_data = $this->installerService->client_stock_details($consumer_number);
        return view('installer.client_stock_details', $this->compact_data);
    }
    public function add_material()
    {
        $this->compact_data = $this->installerService->add_material();
        return view('installer.add_material', $this->compact_data);
    }

    public function material_report()
    {
        try {
            return view('installer.material_report');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function add_completion_images()
    {
        try {
            return view('installer.add_completion_images');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
