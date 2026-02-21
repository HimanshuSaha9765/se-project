<?php
namespace App\Http\Controllers;

use App\Services\DealerCityService;
use Illuminate\Http\Request;

class DealerCityController extends Controller
{
    var $compact_data;
    public DealerCityService $dealerCityService;
    public function __construct(DealerCityService $dealerCityService)
    {
        $this->dealerCityService = $dealerCityService;
    }
    public function manage_dealer_city()
    {
        $this->compact_data = $this->dealerCityService->manage_dealer_city();
        return view("admin.Dealer City.manage_dealer_city", $this->compact_data);
    }
    public function insert_dealer_city(Request $request)
    {
        $this->compact_data = $this->dealerCityService->insert_dealer_city($request);

        if ($this->compact_data == "true") {
            session()->flash('success', 'City Added Successfully.');
            // return redirect()->route('admin.manage_dealer_city');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in adding city .');
            // return redirect()->route('admin.manage_dealer_city');
            return redirect()->back();
        }
        // dd($this->compact_data);
    }
    public function edit_dealer_city($id)
    {
        return response()->json($this->dealerCityService->edit_dealer_city($id));
    }

    public function update_dealer_city(Request $request)
    {
        // dd($request->all());
        $this->compact_data = $this->dealerCityService->update_dealer_city($request);
        if ($this->compact_data == 'true') {
            session()->flash('success', 'City Updated Successfully.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in updateing city .');
            return redirect()->back();
        }
    }

    public function delete_dealer_city($id)
    {
        $this->compact_data = $this->dealerCityService->delete_dealer_city($id);
        if ($this->compact_data == 'true') {
            session()->flash('success', 'City deleted successfully.');
            return response()->json(['message' => 'City deleted successfully']);
        } else {
            session()->flash('error', 'City not found.');
            return response()->json(['Error' => 'City Not Found']);
        }
    }

    public function update_dealer_city_status($id, $status)
    {
        $this->compact_data = $this->dealerCityService->update_dealer_city_status($id,$status);
        // dd($this->compact_data);
        if ($this->compact_data == 'false') {
            session()->flash('error', 'Error in updating city status.');
            return response()->json(['Error' => 'Error in updating city status']);
        } else {
            session()->flash('success', 'city status updated successfully.');
            return response()->json(['message' => 'city status updated successfully']);
        }
    }
}
