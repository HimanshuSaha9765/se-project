<?php

namespace App\Http\Controllers;

use App\Models\Log_Infos;
use App\Models\Panel;
use App\Models\Panel_stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    //* Panel
    public function manage_Panel(Request $request)
    {
        $Panels = Panel::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Master.manage_panel', compact('Panels'));
    }
    public function insert_Panel(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Panels-' . $randomKeySha1;

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

        $Panel = new Panel();
        $Panel->info_id = $info_id;
        $Panel->panel_name = $request->panel_name;
        $Panel->category = $request->category;

        if ($Panel->save()) {
            session()->flash('success', 'Panel added Successfully.');
            return redirect()->route('admin.manage_panel');
        } else {
            session()->flash('error', 'Error in adding Panel.');
            return redirect()->route('admin.manage_panel');
        }
    }
    public function edit_Panel($id)
    {
        $Panel = Panel::where('id', $id)->first();
        return response()->json($Panel);
    }
    public function update_Panel(Request $request)
    {
        $Panel_data = Panel::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$Panel_data->info_id])->first();
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

        $Panel = Panel::where('id', $request->id)
            ->update([
                'panel_name' => $request->panel_name_edit,
                'category' => $request->category_edit,
            ]);

        if ($Panel) {
            session()->flash('success', 'Panel updated successfully.');
            return redirect()->route('admin.manage_panel');
        } else {
            session()->flash('error', 'Error in updating Panel.');
            return redirect()->route('admin.manage_panel');
        }
    }
    public function delete_Panel($id)
    {
        $Panel = Panel::find($id);
        if (!$Panel) {
            session()->flash('error', 'Panel not found.');
            return response()->json(['Error' => 'Error Panel Not Found']);
        }

        $Panel->status = 'deleted';
        $Panel->save();

        session()->flash('success', 'Panel deleted successfully.');
        return response()->json(['message' => 'Panel deleted successfully']);
    }
    public function update_Panel_status($id, $status)
    {
        $Panel = Panel::where('id', $id)->update(['status' => $status]);

        if (!$Panel) {
            session()->flash('error', 'Error in updating Panel status.');
            return response()->json(['Error' => 'Error in updating Panel status']);
        } else {
            session()->flash('success', 'Panel status updated successfully.');
            return response()->json(['message' => 'Panel status updated successfully']);
        }
    }

    //* Panel Stock
    public function manage_Panel_stock(Request $request)
    {
        $Panel_stocks = Panel_stock::query()->where('status', '!=', 'deleted')->get();
        $Panels = Panel::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Stock.manage_panel_stock', compact('Panel_stocks', 'Panels'));
    }
    public function insert_Panel_stock(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Panel_stocks-' . $randomKeySha1;

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

        $Panel_stock = new Panel_stock();
        $Panel_stock->info_id = $info_id;
        $Panel_stock->panel_id = $request->panel_info_id;
        $Panel_stock->total_qty = $request->total_qty;
        $Panel_stock->date = $request->date;

        $p = Panel::where('info_id', $request->panel_info_id)->first();
        $total_p_qty = $p->quantity + $request->total_qty;
        Panel::where('info_id', $request->panel_info_id)->update(['quantity' => $total_p_qty]);

        if ($Panel_stock->save()) {
            session()->flash('success', 'Panel Stock added Successfully.');
            return redirect()->route('admin.manage_panel_stock');
        } else {
            session()->flash('error', 'Error in adding Panel Stock.');
            return redirect()->route('admin.manage_panel_stock');
        }
    }
    public function edit_Panel_stock($id)
    {
        $Panel_stock = Panel_stock::where('id', $id)->first();
        return response()->json($Panel_stock);
    }

    public function update_Panel_stock(Request $request)
    {
        $Panel_stock_data = Panel_stock::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$Panel_stock_data->info_id])->first();
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

        $Panel_stock = Panel_stock::where('id', $request->id)
            ->update([
                'total_qty' => $request->total_qty_edit,
                'date' => $request->date_edit,
            ]);

        // TODO: FIX ME
        Panel::where('info_id', $Panel_stock_data->panel_id)->update(['quantity' => $request->total_qty_edit]);

        if ($Panel_stock) {
            session()->flash('success', 'Panel Stock updated successfully.');
            return redirect()->route('admin.manage_panel_stock');
        } else {
            session()->flash('error', 'Error in updating Panel Stock.');
            return redirect()->route('admin.manage_panel_stock');
        }
    }

    public function delete_Panel_stock($id)
    {
        $Panel_stock = Panel_stock::find($id);
        if (!$Panel_stock) {
            session()->flash('error', 'Panel Stock not found.');
            return response()->json(['Error' => 'Error Panel_stock Not Found']);
        }

        $Panel_stock->status = 'deleted';
        $Panel_stock->save();

        session()->flash('success', 'Panel Stock deleted successfully.');
        return response()->json(['message' => 'Panel Stock deleted successfully']);
    }

    public function update_Panel_stock_status($id, $status)
    {
        $Panel_stock = Panel_stock::where('id', $id)->update(['status' => $status]);

        if (!$Panel_stock) {
            session()->flash('error', 'Error in updating Panel Stock status.');
            return response()->json(['Error' => 'Error in updating Panel Stock status']);
        } else {
            session()->flash('success', 'Panel Stock status updated successfully.');
            return response()->json(['message' => 'Panel Stock status updated successfully']);
        }
    }

    public function getPanels()
    {
        $panels = Panel::query()->where('status', '!=', 'deleted')->get();
        return response()->json($panels);
    }
}
