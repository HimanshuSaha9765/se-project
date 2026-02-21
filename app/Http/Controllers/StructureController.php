<?php

namespace App\Http\Controllers;

use App\Models\Log_Infos;
use App\Models\Structure;
use App\Models\Structure_stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructureController extends Controller
{
    //* Structure
    public function manage_structure(Request $request)
    {
        $structures = Structure::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Master.manage_structure', compact('structures'));
    }
    public function insert_structure(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'structures-' . $randomKeySha1;

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

        $structure = new Structure();
        $structure->info_id = $info_id;
        $structure->accessories_name = $request->accessories_name;
        $structure->unit = $request->unit;

        if ($structure->save()) {
            session()->flash('success', 'structure added Successfully.');
            return redirect()->route('admin.manage_structure');
        } else {
            session()->flash('error', 'Error in adding structure.');
            return redirect()->route('admin.manage_structure');
        }
    }
    public function edit_structure($id)
    {
        $structure = Structure::where('id', $id)->first();
        return response()->json($structure);
    }
    public function update_structure(Request $request)
    {
        $structure_data = structure::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$structure_data->info_id])->first();
        $email = session()->get('admin');
        $id = User::where('email', $email)->first()->id;
        $data = User::where('id', $id)->first();

        if (!$log_data->updated_ip) {
            $log_data->update([
                'updated_ip' => $request->ip(),
                'updated_name' => $data->name,
                'updated_email' => $email,
                'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
            ]);
        }
        else{
            $info = new Log_Infos();
            $info->table_id = $log_data->table_id;
            $info->updated_ip = $request->ip();
            $info->updated_name = $data->name;
            $info->updated_email = $email;
            $info->updated_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
            $info->save();
        }
        // $log_data->update([
        //     'updated_ip' => $request->ip(),
        //     'updated_name' => $data->name,
        //     'updated_email' => $email,
        //     'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
        // ]);
        // * End Log Update

        $structure = structure::where('id', $request->id)
            ->update([
                'accessories_name' => $request->accessories_name_edit,
                'unit' => $request->unit_edit,
            ]);

        if ($structure) {
            session()->flash('success', 'structure updated successfully.');
            return redirect()->route('admin.manage_structure');
        } else {
            session()->flash('error', 'Error in updating structure.');
            return redirect()->route('admin.manage_structure');
        }
    }

    public function delete_structure($id)
    {
        $structure = Structure::find($id);
        if (!$structure) {
            session()->flash('error', 'Structure not found.');
            return response()->json(['Error' => 'Error Structure Not Found']);
        }

        $structure->status = 'deleted';
        $structure->save();

        session()->flash('success', 'Structure deleted successfully.');
        return response()->json(['message' => 'structure deleted successfully']);
    }

    public function update_structure_status($id, $status)
    {
        $structure = Structure::where('id', $id)->update(['status' => $status]);

        if (!$structure) {
            session()->flash('error', 'Error in updating structure status.');
            return response()->json(['Error' => 'Error in updating structure status']);
        } else {
            session()->flash('success', 'structure status updated successfully.');
            return response()->json(['message' => 'structure status updated successfully']);
        }
    }

    //* Structure Stock
    public function manage_structure_stock(Request $request)
    {
        $structure_stocks = Structure_stock::query()->where('status', '!=', 'deleted')->get();
        $structures = Structure::query()->where('status', '!=', 'deleted')->get();
        return view('admin.Stock.manage_structure_stock', compact('structure_stocks', 'structures'));
    }
    public function insert_structure_stock(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'structure-stock' . $randomKeySha1;

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

        $structure_stock = new Structure_stock();
        $structure_stock->info_id = $info_id;
        $structure_stock->structure_id = $request->structure_info_id;
        $structure_stock->total_qty = $request->total_qty;
        $structure_stock->date = $request->date;

        $s = Structure::where('info_id', $request->structure_info_id)->first();
        $total_s_qty = $s->quantity + $request->total_qty;
        Structure::where('info_id', $request->structure_info_id)->update(['quantity' => $total_s_qty]);

        if ($structure_stock->save()) {
            session()->flash('success', 'structure stock added Successfully.');
            return redirect()->route('admin.manage_structure_stock');
        } else {
            session()->flash('error', 'Error in adding structure stock.');
            return redirect()->route('admin.manage_structure_stock');
        }
    }
    public function edit_structure_stock($id)
    {
        $structure_stock = Structure_stock::where('id', $id)->first();
        return response()->json($structure_stock);
    }
    public function update_structure_stock(Request $request)
    {
        $structure_stock_data = Structure_stock::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$structure_stock_data->info_id])->first();
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

        $structure_stock = Structure_stock::where('id', $request->id)
            ->update([
                'total_qty' => $request->total_qty_edit,
                'date' => $request->date_edit,
            ]);

        // TODO: FIX ME
        Structure::where('info_id', $structure_stock_data->structure_id)->update(['quantity' => $request->total_qty_edit]);
        // $s = Structure::where('info_id', $request->structure_info_id)->first();
        // $total_s_qty = $s->quantity + $request->total_qty_edit;
        // Structure::where('info_id', $request->structure_info_id)->update(['quantity' => $total_s_qty]);

        if ($structure_stock) {
            session()->flash('success', 'structure stock updated successfully.');
            return redirect()->route('admin.manage_structure_stock');
        } else {
            session()->flash('error', 'Error in updating structure stock.');
            return redirect()->route('admin.manage_structure_stock');
        }
    }

    public function delete_structure_stock($id)
    {
        $structure_stock = Structure_stock::find($id);
        if (!$structure_stock) {
            session()->flash('error', 'Structure Stock not found.');
            return response()->json(['Error' => 'Error Structure Stock Not Found']);
        }

        $structure_stock->status = 'deleted';
        $structure_stock->save();

        session()->flash('success', 'Structure Stock deleted successfully.');
        return response()->json(['message' => 'Structure Stock deleted successfully']);
    }

    public function update_structure_stock_status($id, $status)
    {
        $structure_stock = Structure_stock::where('id', $id)->update(['status' => $status]);

        if (!$structure_stock) {
            session()->flash('error', 'Error in updating structure stock status.');
            return response()->json(['Error' => 'Error in updating structure stock status']);
        } else {
            session()->flash('success', 'structure stock status updated successfully.');
            return response()->json(['message' => 'structure stock status updated successfully']);
        }
    }

    public function getStructures()
    {
        $structures = Structure::query()->where('status', '!=', 'deleted')->get();
        return response()->json($structures);
    }
}
