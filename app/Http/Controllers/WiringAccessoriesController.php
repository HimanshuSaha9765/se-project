<?php

namespace App\Http\Controllers;

use App\Models\Log_Infos;
use App\Models\User;
use App\Models\Wiring_Accessories;
use App\Models\Wiring_stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WiringAccessoriesController extends Controller
{
    //* Wiring Accessories

    public function manage_wiring_accessories(Request $request)
    {
        $wiring_accessories = Wiring_Accessories::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Master.manage_wiring_accessories', compact('wiring_accessories'));
    }
    public function insert_wiring_accessories(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'wiring_accessoriess-' . $randomKeySha1;

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

        $wiring_accessories = new wiring_accessories();
        $wiring_accessories->info_id = $info_id;
        $wiring_accessories->accessories_name = $request->accessories_name;
        $wiring_accessories->unit = $request->unit;

        if ($wiring_accessories->save()) {
            session()->flash('success', 'wiring accessories added Successfully.');
            return redirect()->route('admin.manage_wiring_accessories');
        } else {
            session()->flash('error', 'Error in adding wiring accessories.');
            return redirect()->route('admin.manage_wiring_accessories');
        }
    }
    public function edit_wiring_accessories($id)
    {
        $wiring_accessories = wiring_accessories::where('id', $id)->first();
        return response()->json($wiring_accessories);
    }
    public function update_wiring_accessories(Request $request)
    {
        $wiring_accessories_data = wiring_accessories::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$wiring_accessories_data->info_id])->first();
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

        $wiring_accessories = wiring_accessories::where('id', $request->id)
            ->update([
                'accessories_name' => $request->accessories_name_edit,
                'unit' => $request->unit_edit,
            ]);

        if ($wiring_accessories) {
            session()->flash('success', 'wiring accessories updated successfully.');
            return redirect()->route('admin.manage_wiring_accessories');
        } else {
            session()->flash('error', 'Error in updating wiring accessories.');
            return redirect()->route('admin.manage_wiring_accessories');
        }
    }

    public function delete_wiring_accessories($id)
    {
        $wiring_accessories = wiring_accessories::find($id);
        if (!$wiring_accessories) {
            session()->flash('error', 'wiring accessories not found.');
            return response()->json(['Error' => 'Error wiring accessories Not Found']);
        }

        $wiring_accessories->status = 'deleted';
        $wiring_accessories->save();

        session()->flash('success', 'wiring accessories deleted successfully.');
        return response()->json(['message' => 'wiring accessories deleted successfully']);
    }

    public function update_wiring_accessories_status($id, $status)
    {
        $wiring_accessories = wiring_accessories::where('id', $id)->update(['status' => $status]);

        if (!$wiring_accessories) {
            session()->flash('error', 'Error in updating wiring accessories status.');
            return response()->json(['Error' => 'Error in updating wiring accessories status']);
        } else {
            session()->flash('success', 'wiring accessories status updated successfully.');
            return response()->json(['message' => 'wiring accessories status updated successfully']);
        }
    }

    //* Wiring Accessories Stock
    public function manage_wiring_stock(Request $request)
    {
        $wiring_stocks = Wiring_stock::query()->where('status', '!=', 'deleted')->get();
        $wirings = Wiring_Accessories::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Stock.manage_wiring_accessories_stock', compact('wiring_stocks', 'wirings'));
    }
    public function insert_wiring_stock(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'wiring-stock' . $randomKeySha1;

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

        $wiring_stock = new wiring_stock();
        $wiring_stock->info_id = $info_id;
        $wiring_stock->wiring_id = $request->wiring_info_id;
        $wiring_stock->total_qty = $request->total_qty;
        $wiring_stock->date = $request->date;

        $w = Wiring_Accessories::where('info_id', $request->wiring_info_id)->first();
        $total_w_qty = $w->quantity + $request->total_qty;
        Wiring_Accessories::where('info_id', $request->wiring_info_id)->update(['quantity' => $total_w_qty]);

        if ($wiring_stock->save()) {
            session()->flash('success', 'wiring stock added Successfully.');
            return redirect()->route('admin.manage_wiring_stock');
        } else {
            session()->flash('error', 'Error in adding wiring stock.');
            return redirect()->route('admin.manage_wiring_stock');
        }
    }
    public function edit_wiring_stock($id)
    {
        $wiring_stock = wiring_stock::where('id', $id)->first();
        return response()->json($wiring_stock);
    }
    public function update_wiring_stock(Request $request)
    {
        $wiring_stock_data = wiring_stock::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$wiring_stock_data->info_id])->first();
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

        $wiring_stock = wiring_stock::where('id', $request->id)
            ->update([
                'total_qty' => $request->total_qty_edit,
                'date' => $request->date_edit,
            ]);

        // TODO: FIX ME
        Wiring_Accessories::where('info_id', $wiring_stock_data->wiring_id)->update(['quantity' => $request->total_qty_edit]);

        if ($wiring_stock) {
            session()->flash('success', 'wiring stock updated successfully.');
            return redirect()->route('admin.manage_wiring_stock');
        } else {
            session()->flash('error', 'Error in updating wiring stock.');
            return redirect()->route('admin.manage_wiring_stock');
        }
    }

    public function delete_wiring_stock($id)
    {
        $wiring_stock = wiring_stock::find($id);
        if (!$wiring_stock) {
            session()->flash('error', 'wiring Stock not found.');
            return response()->json(['Error' => 'Error wiring Stock Not Found']);
        }

        $wiring_stock->status = 'deleted';
        $wiring_stock->save();

        session()->flash('success', 'wiring Stock deleted successfully.');
        return response()->json(['message' => 'wiring Stock deleted successfully']);
    }

    public function update_wiring_stock_status($id, $status)
    {
        $wiring_stock = wiring_stock::where('id', $id)->update(['status' => $status]);

        if (!$wiring_stock) {
            session()->flash('error', 'Error in updating wiring stock status.');
            return response()->json(['Error' => 'Error in updating wiring stock status']);
        } else {
            session()->flash('success', 'wiring stock status updated successfully.');
            return response()->json(['message' => 'wiring stock status updated successfully']);
        }
    }

    public function getwirings()
    {
        $wirings = Wiring_Accessories::query()->where('status', '!=', 'deleted')->get();
        return response()->json($wirings);
    }
}
