<?php
    namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface DealerPaymentRepo{
    public function add_payment();
    public function manage_payment();
    public function insert_client_payment($request);
}


