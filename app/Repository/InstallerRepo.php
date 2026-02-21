<?php
    namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface InstallerRepo{
    public function installer_dashboard();
    public function manage_sell_product();
    public function client_stock_details($consumer_number);
    public function add_material();
}
