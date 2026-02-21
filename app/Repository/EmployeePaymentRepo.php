<?php
    namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface EmployeePaymentRepo{
    public function add_payment();
    public function manage_payment();
    public function insert_client_payment(Request $request);
}

