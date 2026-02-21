<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService){
        $this->employeeService = $employeeService;
    }
    var $compact_data;
    public function dashboard(){
        $this->compact_data = $this->employeeService->dashboard();
        return view("employee.employee_dashboard", $this->compact_data);
    }

}
