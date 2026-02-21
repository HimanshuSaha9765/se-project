<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_Document;
use App\Models\Log_Infos;
use App\Models\Payment;
use App\Models\User;
use App\Services\EmployeePaymentService;
use Carbon\Carbon;
use Exception;

class EmployeePaymentController extends Controller
{
    public EmployeePaymentService $employeePaymentService;
    public function __construct(EmployeePaymentService $employeePaymentService){
        $this->employeePaymentService = $employeePaymentService;
    }
    var $compact_data;
    public function add_payment()
    {
        $this->compact_data = $this->employeePaymentService->add_payment();
        return view("employee.Client.add_payment", $this->compact_data);
    }
    public function manage_payment()
    {
        $this->compact_data = $this->employeePaymentService->manage_payment();
        return view("employee.Client.manage_payment", $this->compact_data);
    }
    
    public function insert_client_payment(Request $request)
    {
        $this->compact_data = $this->employeePaymentService->insert_client_payment($request);
        if ($this->compact_data == "true") {
            session()->flash('success', 'Client Payment Added Successfully.');
            return redirect()->route('employee.manage_payment', ['authUser' => encrypt($request->consumer_number)]);
        } else {
            session()->flash('error', 'Error in Adding Client Payment Added.');
            return redirect()->route('employee.add_payment');
        }
    }
    public function edit_client_payment()
    {
    }
    public function update_client_payment()
    {
    }
}
