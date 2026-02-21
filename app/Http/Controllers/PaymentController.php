<?php

namespace App\Http\Controllers;


use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    var $compact_data;
    public function add_payment()
    {
        $this->compact_data = $this->paymentService->add_payment();
        return view("Client.add_payment", $this->compact_data);
    }
    public function manage_payment()
    {
        $this->compact_data = $this->paymentService->manage_payment();
        return view("Client.manage_payment", $this->compact_data);
    }

    public function insert_client_payment(Request $request)
    {
        $this->compact_data = $this->paymentService->insert_client_payment($request);
        if ($this->compact_data == "true") {
            session()->flash('success', 'Client Payment Added Successfully.');
            return redirect()->route('admin.manage_payment', ['authUser' => encrypt($request->consumer_number)]);
        } else {
            session()->flash('error', 'Error in Adding Client Payment Added.');
            return redirect()->route('admin.add_payment');
        }
    }
    public function edit_client_payment()
    {
    }
    public function update_client_payment()
    {
    }

    public function manage_payment_dashboard()
    {
        $this->compact_data = $this->paymentService->manage_payment_dashboard();
        return view("admin.Payment.manage_payment_dashboard", $this->compact_data);
    }
}
