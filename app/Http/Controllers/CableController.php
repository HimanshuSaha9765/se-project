<?php

namespace App\Http\Controllers;

use App\Models\Cable_stock;
use Illuminate\Http\Request;
use App\Models\Cable;
use App\Models\Log_Infos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CableController extends Controller
{
    //* Cable
    public function manage_Cable(Request $request)
    {
        $Cables = Cable::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Master.manage_cable', compact('Cables'));
    }
    public function insert_Cable(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Cables-' . $randomKeySha1;

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

        $Cable = new Cable();
        $Cable->info_id = $info_id;
        $Cable->cable_type = $request->cable_type;
        $Cable->cable_length = $request->cable_length;
        $Cable->cable_color = $request->cable_color;
        if ($Cable->save()) {
            session()->flash('success', 'Cable added Successfully.');
            return redirect()->route('admin.manage_cable');
        } else {
            session()->flash('error', 'Error in adding Cable.');
            return redirect()->route('admin.manage_cable');
        }
    }
    public function edit_Cable($id)
    {
        $Cable = Cable::where('id', $id)->first();
        return response()->json($Cable);
    }

    public function update_Cable(Request $request)
    {
        $Cable_data = Cable::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$Cable_data->info_id])->first();
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

        $Cable = Cable::where('id', $request->id)
            ->update([
                'cable_type' => $request->cable_type_edit,
                'cable_length' => $request->cable_length_edit,
                'cable_color' => $request->cable_color_edit,
            ]);
        if ($Cable) {
            session()->flash('success', 'Cable updated successfully.');
            return redirect()->route('admin.manage_cable');
        } else {
            session()->flash('error', 'Error in updating Cable.');
            return redirect()->route('admin.manage_cable');
        }
    }

    public function delete_Cable($id)
    {
        $Cable = Cable::find($id);
        if (!$Cable) {
            session()->flash('error', 'Cable not found.');
            return response()->json(['Error' => 'Error Cable Not Found']);
        }

        $Cable->status = 'deleted';
        $Cable->save();

        session()->flash('success', 'Cable deleted successfully.');
        return response()->json(['message' => 'Cable deleted successfully']);
    }

    public function update_Cable_status($id, $status)
    {
        $Cable = Cable::where('id', $id)->update(['status' => $status]);

        if (!$Cable) {
            session()->flash('error', 'Error in updating Cable status.');
            return response()->json(['Error' => 'Error in updating Cable status']);
        } else {
            session()->flash('success', 'Cable status updated successfully.');
            return response()->json(['message' => 'Cable status updated successfully']);
        }
    }
    //* Cable Stock
    public function manage_cable_stock(Request $request)
    {
        $Cable_stocks = Cable_stock::query()->where('status', '!=', 'deleted')->get();
        $Cables = cable::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Stock.manage_cable_stock', compact('Cable_stocks', 'Cables'));
    }
    public function insert_cable_stock(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'cable-stock' . $randomKeySha1;

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

        $cable_stock = new cable_stock();
        $cable_stock->info_id = $info_id;
        $cable_stock->cable_id = $request->cable_info_id;
        $cable_stock->total_qty = $request->total_qty;
        $cable_stock->date = $request->date;

        $c = Cable::where('info_id', $request->cable_info_id)->first();
        $total_c_qty = $c->quantity + $request->total_qty;
        Cable::where('info_id', $request->cable_info_id)->update(['quantity' => $total_c_qty]);

        if ($cable_stock->save()) {
            session()->flash('success', 'cable stock added Successfully.');
            return redirect()->route('admin.manage_cable_stock');
        } else {
            session()->flash('error', 'Error in adding cable stock.');
            return redirect()->route('admin.manage_cable_stock');
        }
    }
    public function edit_cable_stock($id)
    {
        $cable_stock = cable_stock::where('id', $id)->first();
        return response()->json($cable_stock);
    }
    public function update_cable_stock(Request $request)
    {
        $cable_stock_data = cable_stock::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$cable_stock_data->info_id])->first();
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

        $cable_stock = cable_stock::where('id', $request->id)
            ->update([
                'total_qty' => $request->total_qty_edit,
                'date' => $request->date_edit,
            ]);

        // TODO: FIX ME
        Cable::where('info_id', $cable_stock_data->cable_id)->update(['quantity' => $request->total_qty_edit]);

        if ($cable_stock) {
            session()->flash('success', 'cable stock updated successfully.');
            return redirect()->route('admin.manage_cable_stock');
        } else {
            session()->flash('error', 'Error in updating cable stock.');
            return redirect()->route('admin.manage_cable_stock');
        }
    }

    public function delete_cable_stock($id)
    {
        $cable_stock = cable_stock::find($id);
        if (!$cable_stock) {
            session()->flash('error', 'cable Stock not found.');
            return response()->json(['Error' => 'Error cable Stock Not Found']);
        }

        $cable_stock->status = 'deleted';
        $cable_stock->save();

        session()->flash('success', 'cable Stock deleted successfully.');
        return response()->json(['message' => 'cable Stock deleted successfully']);
    }

    public function update_cable_stock_status($id, $status)
    {
        $cable_stock = cable_stock::where('id', $id)->update(['status' => $status]);

        if (!$cable_stock) {
            session()->flash('error', 'Error in updating cable stock status.');
            return response()->json(['Error' => 'Error in updating cable stock status']);
        } else {
            session()->flash('success', 'cable stock status updated successfully.');
            return response()->json(['message' => 'cable stock status updated successfully']);
        }
    }

    public function getcables()
    {
        $cables = cable::query()->where('status', '!=', 'deleted')->get();
        return response()->json($cables);
    }
}
