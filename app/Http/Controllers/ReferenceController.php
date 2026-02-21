<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\dealer_city;
use App\Models\Log_Infos;
use App\Models\references;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function manage_Reference(Request $request)
    {
        $referencess = references::query()->where('status', '!=', 'deleted')->get();
        $dealer_city_data = dealer_city::query()->whereRaw('status != ?', ['deleted'])->get();

        return view('admin.Master.manage_references')->with(['referencess' => $referencess,'dealer_city_data' => $dealer_city_data]);

    }
    public function insert_Reference(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'referencess-' . $randomKeySha1;

        $email = session()->get('admin');
        // dd($email);
        $id = User::where('email', $email)->first()->id;
        $data = User::where('id', $id)->first();

        $info = new Log_Infos();
        $info->table_id = $info_id;
        $info->created_ip = $request->ip();
        $info->created_name = $data->name;
        $info->created_email = $email;
        $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');

        $info->save();
        // * End Info Log

        $references = new references();
        $references->info_id = $info_id;
        $references->city_name = $request->city_name;
        $references->name = $request->name;
        $references->email_assign = $request->email_assign;

        if ($references->save()) {
            session()->flash('success', 'Reference added Successfully.');
            return redirect()->route('admin.manage_reference');
        } else {
            session()->flash('error', 'Error in adding reference.');
            return redirect()->route('admin.manage_reference');
        }
    }
    public function edit_Reference($id)
    {
        $references = references::where('id', $id)->first();
        return response()->json($references);
    }

    public function update_Reference(Request $request)
    {
        $references_data = references::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$references_data->info_id])->first();

        $email = session()->get('admin');
        $data = User::where('email', $email)->first();

        if (!$log_data->updated_ip) {
            $log_data->update([
                'updated_ip' => $request->ip(),
                'updated_name' => $data->name,
                'updated_email' => $email,
                'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
            ]);
        } else {
            $info = new Log_Infos();
            $info->table_id = $log_data->table_id;
            $info->updated_ip = $request->ip();
            $info->updated_name = $data->name;
            $info->updated_email = $email;
            $info->updated_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
            $info->save();
        }

        // * End Log Update

        $references = references::where('id', $request->id)
            ->update([
            'city_name' => $request->city_name_update,
            'name' => $request->name,
            'email_assign' => $request->email_assign
        ]);

        if ($references) {
            session()->flash('success', 'Reference updated successfully.');
            return redirect()->route('admin.manage_reference');
        } else {
            session()->flash('error', 'Error in updating reference.');
            return redirect()->route('admin.manage_reference');
        }
    }

    public function delete_Reference($id)
    {
        $references = references::find($id);
        if (!$references) {
            session()->flash('error', 'Reference not found.');
            return response()->json(['Error' => 'Error Reference Not Found']);
        }

        $references->status = 'deleted';
        $references->save();

        session()->flash('success', 'Reference deleted successfully.');
        return response()->json(['message' => 'Reference deleted successfully']);
    }

    public function update_reference_status($id, $status)
    {
        $references = references::where('id', $id)->update(['status' => $status]);

        if (!$references) {
            session()->flash('error', 'Error in updating reference status.');
            return response()->json(['Error' => 'Error in updating reference status']);
        } else {
            session()->flash('success', 'references status updated successfully.');
            return response()->json(['message' => 'reference status updated successfully']);
        }
    }

    public function getCity()
    {
        $dealer_city_name = dealer_city::query()->where('status', '=', 'active')->get();
        return response()->json($dealer_city_name);
    }

}
