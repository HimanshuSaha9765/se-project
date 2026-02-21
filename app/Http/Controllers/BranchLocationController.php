<?php

namespace App\Http\Controllers;

use App\Services\BranchLocationService;
use Illuminate\Http\Request;

class BranchLocationController extends Controller
{
    public BranchLocationService $BranchLocationService;
    public function __construct(BranchLocationService $BranchLocationService)
    {
        $this->BranchLocationService = $BranchLocationService;
    }
    var $compact_data;

    public function manage_branch_location()
    {
        $result = $this->BranchLocationService->manage_branch_location();

        // If it's an AJAX request, return JSON directly
        if (request()->ajax()) {
            return $result; // $result is already a JsonResponse
        }

        // Otherwise, it's normal page load
        return view("admin.Branch Location.manage_branch_location", $result);

        // echo "<pre>";
        // print_r($this->compact_data);
        // exit;
    }

    public function insert_branch_location(Request $request)
    {
        $this->compact_data = $this->BranchLocationService->insert_branch_location($request);

        if ($this->compact_data == "true") {
            session()->flash('success', 'Branch Added Successfully.');
            // return redirect()->route('admin.manage_dealer_city');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in adding branch .');
            // return redirect()->route('admin.manage_dealer_city');
            return redirect()->back();
        }
        // dd($this->compact_data);
    }

    public function edit_branch_location($id)
    {
        return response()->json($this->BranchLocationService->edit_branch_location($id));
    }


    public function update_branch_location(Request $request)
    {
        $this->compact_data = $this->BranchLocationService->update_branch_location($request);
        if ($this->compact_data == 'true') {
            session()->flash('success', 'Branch Location Updated Successfully.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in updateing Branch Location .');
            return redirect()->back();
        }
    }

    public function delete_branch_location($id)
    {
        $this->compact_data = $this->BranchLocationService->delete_branch_location($id);
        if ($this->compact_data == 'true') {
            session()->flash('success', 'Branch deleted successfully.');
            return response()->json(['message' => 'Branch deleted successfully']);
        } else {
            session()->flash('error', 'Branch not found.');
            return response()->json(['Error' => 'Branch Not Found']);
        }
    }

    public function update_branch_location_status($id, $status)
    {
        $this->compact_data = $this->BranchLocationService->update_branch_location_status($id, $status);
        // dd($this->compact_data);
        if ($this->compact_data == 'false') {
            session()->flash('error', 'Error in updating branch status.');
            return response()->json(['Error' => 'Error in updating branch status']);
        } else {
            session()->flash('success', 'branch status updated successfully.');
            return response()->json(['message' => 'branch status updated successfully']);
        }
    }
}
