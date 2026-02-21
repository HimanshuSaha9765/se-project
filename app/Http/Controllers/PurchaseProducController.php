<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\add_product;
use App\Models\Client;
use App\Models\Log_Infos;
use App\Models\Purchase_produc;
use App\Models\stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseProducController extends Controller
{
    public function manage_purchase_producs()
    {
        $product_code = (new CommonController)->product_code();
        $Purchase_produc_data = Purchase_produc::all();
        $produc_data = add_product::all();
        // dd($Purchase_produc_data);
        return view("admin.Stock.manage_stock_report")->with(['Purchase_produc_data' => $Purchase_produc_data, 'product_code' => $product_code, 'produc_data' => $produc_data]);
    }
    public function employee_manage_purchase_producs()
    {
        $product_code = (new CommonController)->product_code();
        $Purchase_produc_data = Purchase_produc::all();
        $produc_data = add_product::all();
        // dd($Purchase_produc_data);
        return view("employee.Stock.manage_stock_report")->with(['Purchase_produc_data' => $Purchase_produc_data, 'product_code' => $product_code, 'produc_data' => $produc_data]);
    }
    public function installer_manage_purchase_producs()
    {
        $product_code = (new CommonController)->product_code();
        $Purchase_produc_data = Purchase_produc::all();
        $produc_data = add_product::all();
        // dd($Purchase_produc_data);
        return view("installer.Stock.manage_stock_report")->with(['Purchase_produc_data' => $Purchase_produc_data, 'product_code' => $product_code, 'produc_data' => $produc_data]);
    }

    public function insert_purchase_producs(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'purchase-' . $randomKeySha1;

        $admin_email = session()->get('admin');
        $employee_email = session()->get('employee');
        $dealer_email = session()->get('dealer');
        $installer_email = session()->get('installer');

        $emails = [
            'admin' => $admin_email,
            'employee' => $employee_email,
            'dealer' => $dealer_email,
            'installer' => $installer_email,
        ];

        foreach ($emails as $role => $email) {
            if ($email) {
                $data = User::where('email', $email)->first();
                if ($data) {
                    $info = new Log_Infos();
                    $info->table_id = $info_id;
                    $info->created_ip = $request->ip();
                    $info->created_name = $data->name;
                    $info->created_email = $email;
                    $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
                    $info->save();
                }
            }
        }

        // * End Info Log

        $product_data = add_product::where('product_id', $request->product_id)->first();
        // dd($product_data);

        $Purchase_produc = new Purchase_produc();
        $Purchase_produc->info_id = $info_id;
        $Purchase_produc->product_id = $request->product_id;
        $Purchase_produc->product_name = $product_data->product_name;
        $Purchase_produc->product_quantity = $request->product_quantity;
        $Purchase_produc->date = $request->date;
        $Purchase_produc->save();


        $Stocks_query = stock::where('product_id', $request->product_id)->first();
        // dd($Stocks_query->product_id);
        if (!($Stocks_query && $Stocks_query->product_id) == $request->product_id) {
            $Stocks = new stock();
            $Stocks->product_id = $request->product_id;
            $Stocks->product_name = $product_data->product_name;
            $Stocks->product_total_quantity = $request->product_quantity;
            $Stocks->total_sell_quantity = 0;
            $Stocks->total_remain_quantity = $request->product_quantity;
            $Stocks->save();
        } else {
            $Stocks_query_get = Purchase_produc::where('product_id', $request->product_id)->get();
            $Stocks_query_first = stock::where('product_id', $request->product_id)->first();

            // * Sum of purchase product
            $product_sum = $Stocks_query_get->sum('product_quantity');
            $total_product_qty = $product_sum;

            // * Sum of sell product in stock table
            $total_sell_product_qty = $total_product_qty - $Stocks_query_first->total_sell_quantity;

            stock::where('product_id', $request->product_id)
                ->update([
                    'product_total_quantity' => $total_product_qty,
                    'total_remain_quantity' => $total_sell_product_qty,
                ]);
        }

        if ($Purchase_produc->save()) {
            session()->flash('success', 'Stock added Successfully.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in adding stock.');
            return redirect()->back();
        }

    }
    public function edit_purchase_producs($id)
    {
        $Purchase_produc_data = Purchase_produc::where('id', $id)->first();
        return response()->json($Purchase_produc_data);
    }
    public function update_purchase_producs(Request $request)
    {
        $Purchase_produc_data = Purchase_produc::where('id', $request->id)->first();

        // * Start Log Update

        $admin_email = session()->get('admin');
        $employee_email = session()->get('employee');
        $dealer_email = session()->get('dealer');
        $installer_email = session()->get('installer');

        $emails = [
            'admin' => $admin_email,
            'employee' => $employee_email,
            'dealer' => $dealer_email,
            'installer' => $installer_email,
        ];

        foreach ($emails as $role => $email) {
            if ($email) {
                $log_data = Log_Infos::query()->whereRaw('table_id = ?', [$Purchase_produc_data->info_id])->first();

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
            }
        }

        // * End Log Update

        // ?? =================================================================================================
        // * Start Purchase Update ::
        $Purchase_data = Purchase_produc::where('id', $request->id)
            ->update([
                'product_quantity' => $request->product_quantity,
                'date' => $request->date,
            ]);
        if ($Purchase_data) {
            session()->flash('success', 'Stock updated Successfully.');
        } else {
            session()->flash('error', 'Error in stock update.');
        }

        // * End Purchase Update ::
        // ?? =================================================================================================

        $stock_produc_data = stock::where('product_id', $request->product_id)->first();

        // * Decrement Stock Management
        $decrement_qty = $Purchase_produc_data->product_quantity - $request->input('product_quantity');

        // * Increment Stock Management
        $increment_qty = $request->input('product_quantity') - $Purchase_produc_data->product_quantity;

        if ($Purchase_produc_data->product_quantity > $request->input('product_quantity')) {
            stock::where('product_id', $request->product_id)
                ->update([
                    'product_total_quantity' => $stock_produc_data->product_total_quantity - $decrement_qty,
                    'total_remain_quantity' => $stock_produc_data->total_remain_quantity - $decrement_qty,
                ]);
        } else {
            stock::where('product_id', $request->product_id)
                ->update([
                    'product_total_quantity' => $stock_produc_data->product_total_quantity + $increment_qty,
                    'total_remain_quantity' => $stock_produc_data->total_remain_quantity + $increment_qty,
                ]);
        }

        return redirect()->back();
    }

}
