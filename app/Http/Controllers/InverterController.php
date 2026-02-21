<?php

namespace App\Http\Controllers;

use App\Models\Inverter;
use App\Models\Inverter_stock;
use App\Models\Log_Infos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InverterController extends Controller
{
    //* Inverter
    public function manage_Inverter(Request $request)
    {
        $Inverters = Inverter::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Master.manage_inverter', compact('Inverters'));
    }
    public function insert_Inverter(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Inverters-' . $randomKeySha1;

        $email = session()->get('admin');
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

        $Inverter = new Inverter();
        $Inverter->info_id = $info_id;
        $Inverter->inverter_name = $request->inverter_name;
        $Inverter->kw = $request->unit;

        if ($Inverter->save()) {
            session()->flash('success', 'Inverter added Successfully.');
            return redirect()->route('admin.manage_inverter');
        } else {
            session()->flash('error', 'Error in adding Inverter.');
            return redirect()->route('admin.manage_inverter');
        }
    }
    public function edit_Inverter($id)
    {
        $Inverter = Inverter::where('id', $id)->first();
        return response()->json($Inverter);
    }

    public function update_Inverter(Request $request)
    {
        $Inverter_data = Inverter::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$Inverter_data->info_id])->first();
        $email = session()->get('admin');
        $id = User::where('email', $email)->first()->id;
        $data = User::where('id', $id)->first();

        $log_data->update([
            'updated_ip' => $request->ip(),
            'updated_name' => $data->name,
            'updated_email' => $email,
            'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
        ]);
        // * End Log Update

        $Inverter = Inverter::where('id', $request->id)
            ->update([
                'inverter_name' => $request->inverter_name_edit,
                'kw' => $request->unit_edit,
            ]);
        if ($Inverter) {
            session()->flash('success', 'Inverter updated successfully.');
            return redirect()->route('admin.manage_inverter');
        } else {
            session()->flash('error', 'Error in updating Inverter.');
            return redirect()->route('admin.manage_inverter');
        }
    }

    public function delete_Inverter($id)
    {

        $Inverter = Inverter::find($id);
        if (!$Inverter) {
            session()->flash('error', 'Inverter not found.');
            return response()->json(['Error' => 'Error Inverter Not Found']);
        }

        $Inverter->status = 'deleted';
        $Inverter->save();

        session()->flash('success', 'Inverter deleted successfully.');
        return response()->json(['message' => 'Inverter deleted successfully']);
    }

    public function update_Inverter_status($id, $status)
    {
        $Inverter = Inverter::where('id', $id)->update(['status' => $status]);

        if (!$Inverter) {
            session()->flash('error', 'Error in updating Inverter status.');
            return response()->json(['Error' => 'Error in updating Inverter status']);
        } else {
            session()->flash('success', 'Inverter status updated successfully.');
            return response()->json(['message' => 'Inverter status updated successfully']);
        }
    }

    //* Inverter Stock
    public function manage_inverter_stock(Request $request)
    {
        $Inverter_stocks = Inverter_stock::query()->where('status', '!=', 'deleted')->get();
        $Inverters = inverter::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Stock.manage_inverter_stock', compact('Inverter_stocks', 'Inverters'));
    }
    public function insert_inverter_stock(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'inverter-stock' . $randomKeySha1;

        $email = session()->get('admin');
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

        $inverter_stock = new inverter_stock();
        $inverter_stock->info_id = $info_id;
        $inverter_stock->inverter_id = $request->inverter_info_id;
        $inverter_stock->total_qty = $request->total_qty;
        $inverter_stock->date = $request->date;

        $i = Inverter::where('info_id', $request->inverter_info_id)->first();
        $total_i_qty = $i->quantity + $request->total_qty;
        Inverter::where('info_id', $request->inverter_info_id)->update(['quantity' => $total_i_qty]);

        if ($inverter_stock->save()) {
            session()->flash('success', 'inverter stock added Successfully.');
            return redirect()->route('admin.manage_inverter_stock');
        } else {
            session()->flash('error', 'Error in adding inverter stock.');
            return redirect()->route('admin.manage_inverter_stock');
        }
    }
    public function edit_inverter_stock($id)
    {
        $inverter_stock = inverter_stock::where('id', $id)->first();
        return response()->json($inverter_stock);
    }
    public function update_inverter_stock(Request $request)
    {
        $inverter_stock_data = inverter_stock::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$inverter_stock_data->info_id])->first();
        $email = session()->get('admin');
        $id = User::where('email', $email)->first()->id;
        $data = User::where('id', $id)->first();

        $log_data->update([
            'updated_ip' => $request->ip(),
            'updated_name' => $data->name,
            'updated_email' => $email,
            'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
        ]);
        // * End Log Update

        $inverter_stock = inverter_stock::where('id', $request->id)
            ->update([
                'total_qty' => $request->total_qty_edit,
                'date' => $request->date_edit,
            ]);

        // TODO: FIX ME
        Inverter::where('info_id', $inverter_stock_data->inverter_id)->update(['quantity' => $request->total_qty_edit]);

        if ($inverter_stock) {
            session()->flash('success', 'inverter stock updated successfully.');
            return redirect()->route('admin.manage_inverter_stock');
        } else {
            session()->flash('error', 'Error in updating inverter stock.');
            return redirect()->route('admin.manage_inverter_stock');
        }
    }

    public function delete_inverter_stock($id)
    {
        $inverter_stock = inverter_stock::find($id);
        if (!$inverter_stock) {
            session()->flash('error', 'inverter Stock not found.');
            return response()->json(['Error' => 'Error inverter Stock Not Found']);
        }

        $inverter_stock->status = 'deleted';
        $inverter_stock->save();

        session()->flash('success', 'inverter Stock deleted successfully.');
        return response()->json(['message' => 'inverter Stock deleted successfully']);
    }

    public function update_inverter_stock_status($id, $status)
    {
        $inverter_stock = inverter_stock::where('id', $id)->update(['status' => $status]);

        if (!$inverter_stock) {
            session()->flash('error', 'Error in updating inverter stock status.');
            return response()->json(['Error' => 'Error in updating inverter stock status']);
        } else {
            session()->flash('success', 'inverter stock status updated successfully.');
            return response()->json(['message' => 'inverter stock status updated successfully']);
        }
    }

    public function getinverters()
    {
        $inverters = inverter::query()->where('status', '!=', 'deleted')->get();
        return response()->json($inverters);
    }
}
