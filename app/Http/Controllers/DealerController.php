<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Services\DealerService;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public DealerService $dealerService;
    public function __construct(DealerService $dealerService){
        $this->dealerService = $dealerService;
    }
    var $compact_data;
    public function dashboard()
    {
        $this->compact_data = $this->dealerService->dashboard();
        return view("dealer.dashboard", $this->compact_data);
    }
}
