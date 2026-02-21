<?php

namespace App\Services;

use App\Models\BranchLocation;
use App\Models\Log_Infos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


//php artisan make:class Services\Service_name
class BranchLocationService
{
    var $compact_data;

    public function manage_branch_location()
    {
        // $Branch_datas = BranchLocation::query()->orderBy('id', 'desc')->whereRaw('status != ?', ['deleted'])->get();
        // // Count how many head branches exist (is_head_branch = 1)
        // $head_branch_count = BranchLocation::where('is_head_branch', 1)->whereRaw('status != ?', ['deleted'])->count();

        // return response()->json([
        //     'status' => true,
        //     'head_branch_count' => $head_branch_count,
        // ]);

        // $this->compact_data['Branch_datas'] = $Branch_datas;
        // return $this->compact_data;



        $Branch_datas = BranchLocation::query()
            ->whereRaw('status != ?', ['deleted'])
            ->orderBy('id', 'desc')
            ->get();
        // $Branch_datas_inactive = BranchLocation::query()
        //     ->whereNotIn('status', ['deleted', 'inactive'])
        //     ->orderByRaw('is_head_branch')
        //     ->orderBy('id', 'desc')
        //     ->get();

        $Branch_datas_inactive = BranchLocation::query()
            ->whereNotIn('status', ['deleted', 'inactive'])
            ->orderByRaw("
        CASE 
            WHEN is_head_branch = 1 THEN id 
        END DESC,
        CASE 
            WHEN is_head_branch = 2 THEN id 
        END ASC
    ")
            ->get();

        $head_branch_count = BranchLocation::where('is_head_branch', 1)
            ->whereRaw('status != ?', ['deleted'])
            ->count();

        $this->compact_data['Branch_datas'] = $Branch_datas;
        $this->compact_data['head_branch_count'] = $head_branch_count;
        $this->compact_data['Branch_datas_inactive'] = $Branch_datas_inactive;

        // Check if request is AJAX 
        if (request()->ajax()) {
            return response()->json([
                'status' => true,
                'head_branch_count' => $head_branch_count,
            ]);
        }

        return $this->compact_data;
    }

    public function insert_branch_location(Request $request)
    {
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Branch_location-' . $randomKeySha1;

        $email = session()->get('admin');
        $data = User::query()->where('email', $email)->first();
        // dd($data);
        // $data = User::where('id', $id)->first();

        $info = new Log_Infos();
        $info->table_id = $info_id;
        $info->created_ip = $request->ip();
        $info->created_name = $data->name;
        $info->created_email = $email;
        $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
        // dd($info);
        $info->save();



        $branch_location = new BranchLocation();
        $branch_location->info_id = $info_id;
        $branch_location->branch_location_name = $request->branch_location_name;
        $branch_location->address = $request->address;
        $branch_location->email = $request->email;
        $branch_location->mobile_number = $request->mobile_number;
        $branch_location->location_link = $request->location_link;
        $branch_location->working_time = $request->working_time ?? 'Mon-Sat: 09:00 AM - 07:00 PM';
        $branch_location->is_head_branch = $request->is_head_branch ?? 2;

        if ($branch_location->save()) {
            return "true";
        } else {
            return "false";
        }
        // dd($request->all());
    }

    public function edit_branch_location($id)
    {
        $branch_location_edit = BranchLocation::query()
            ->where('id', $id)
            ->first();

        // Count how many head branches exist (is_head_branch = 1)
        $head_branch_count = BranchLocation::where('is_head_branch', 1)->whereRaw('status != ?', ['deleted'])->count();

        // Return both record and count as JSON
        return response()->json([
            'status' => true,
            'data' => $branch_location_edit,
            'head_branch_count' => $head_branch_count,
        ]);
    }


    public function update_branch_location($request)
    {
        try {
            // * Start Log Update
            $branch_location_data = BranchLocation::query()
                ->where('id', $request->id)
                ->first();

            $log_data = Log_Infos::query()
                ->where('table_id', $branch_location_data->info_id)
                ->latest()
                ->first();

            $email = session()->get('admin');
            $user = User::where('email', $email)->first();

            $logArray = [
                'updated_ip' => $request->ip(),
                'updated_name' => $user->name ?? 'N/A',
                'updated_email' => $email,
                'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                'table_id' => $branch_location_data->info_id,
            ];

            if (!$log_data || !$log_data->updated_ip) {
                if ($log_data) {
                    $log_data->update($logArray);
                } else {
                    $info = new Log_Infos($logArray);
                    $info->save();
                }
            } else {
                $info = new Log_Infos($logArray);
                $info->save();
            }
            // * End Log Update

            // Update branch location
            $branch_location = BranchLocation::query()
                ->where('id', $request->id)
                ->update([
                    'branch_location_name' => $request->branch_location_name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'location_link' => $request->location_link,
                    'working_time' => $request->working_time ?? 'Mon-Sat: 09:00 AM - 07:00 PM',
                    'is_head_branch' => $request->is_head_branch ?? 2,
                ]);

            if ($branch_location) {
                return "true";
            } else {
                return "false";
            }

            // return $branch_location ? response()->json(['success' => true]) : response()->json(['success' => false]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete_branch_location($id)
    {
        $branch_location = BranchLocation::query()->whereRaw('id = ?', [$id])->first();
        $branch_location->update([
            'status' => 'deleted',
        ]);
        if ($branch_location) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function update_branch_location_status($id, $status)
    {
        // dd($id,$status);
        $branch_location = BranchLocation::query()->where('id', $id)->update(['status' => $status]);
        if ($branch_location) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
