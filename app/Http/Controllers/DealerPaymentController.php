<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_Document;
use App\Models\Log_Infos;
use App\Models\Payment;
use App\Models\User;
use App\Services\DealerPaymentService;
use Carbon\Carbon;
use Exception;


class DealerPaymentController extends Controller
{
    public DealerPaymentService $dealerPaymentService;
    public function __construct(DealerPaymentService $dealerPaymentService)
    {
        $this->dealerPaymentService = $dealerPaymentService;
    }
    var $compact_data;
    public function add_payment()
    {
        $this->compact_data = $this->dealerPaymentService->add_payment();
        return view("dealer.Client.add_payment", $this->compact_data);
    }
    public function manage_payment()
    {
        $this->compact_data = $this->dealerPaymentService->manage_payment();
        return view("dealer.Client.manage_payment", $this->compact_data);
        // return view("dealerClient.manage_payment");
    }

    public function insert_client_payment(Request $request)
    {
        $this->compact_data = $this->dealerPaymentService->insert_client_payment($request);

        // dd($client_payment);
        if ($this->compact_data == "false") {
            session()->flash('error', 'Error in Adding Client Payment Added.');
            return redirect()->route('dealer.add_payment');
        } else {
            session()->flash('success', 'Client Payment Added Successfully.');
            return redirect()->route('dealer.manage_payment', ['authUser' => $this->compact_data]);
        }
    }
    public function edit_client_payment()
    {
    }
    public function update_client_payment()
    {
    }
}
