<?php
namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface DealerCityRepo{
    public function manage_dealer_city();
    public function insert_dealer_city(Request $request);
    public function edit_dealer_city($id);
    public function update_dealer_city(Request $request);
    public function delete_dealer_city($id);
    public function update_dealer_city_status($id, $status);
}
