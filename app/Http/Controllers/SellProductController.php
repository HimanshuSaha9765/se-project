<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log_Infos;
use App\Models\Purchase_produc;
use App\Models\sell_product;
use App\Models\sell_product_demo_data;
use App\Models\stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellProductController extends Controller
{
    public function add_material(Request $request)
    {
        $consumer_number = decrypt(request('authUser'));
        // dd($consumer_number);
        $stock_data = stock::query()->get();
        $sell_product_demo_data = sell_product_demo_data::query()->where('consumer_number', decrypt(request('authUser')))->get();
        // dd($sell_product_demo_data);

        return view("admin.Material.add_material")->with(["consumer_number", $consumer_number, "stock_data" => $stock_data, 'sell_product_demo_data' => $sell_product_demo_data]);
    }
    public function employee_add_material(Request $request)
    {
        $consumer_number = decrypt(request('authUser'));
        $stock_data = stock::query()->get();
        $sell_product_demo_data = sell_product_demo_data::query()->where('consumer_number', decrypt(request('authUser')))->get();
        // dd($sell_product_demo_data);

        return view("employee.Material.add_material")->with(["consumer_number", $consumer_number, "stock_data" => $stock_data, 'sell_product_demo_data' => $sell_product_demo_data]);
    }
    public function dealer_add_material(Request $request)
    {
        $consumer_number = decrypt(request('authUser'));
        $stock_data = stock::query()->get();
        $sell_product_demo_data = sell_product_demo_data::query()->where('consumer_number', decrypt(request('authUser')))->get();
        // dd($sell_product_demo_data);

        return view("dealer.Material.add_material")->with(["consumer_number", $consumer_number, "stock_data" => $stock_data, 'sell_product_demo_data' => $sell_product_demo_data]);
    }
    public function installer_add_material(Request $request)
    {
        $consumer_number = decrypt(request('authUser'));
        $stock_data = stock::query()->get();
        $sell_product_demo_data = sell_product_demo_data::query()->where('consumer_number', decrypt(request('authUser')))->get();
        // dd($sell_product_demo_data);

        return view("installer.Material.add_material")->with(["consumer_number", $consumer_number, "stock_data" => $stock_data, 'sell_product_demo_data' => $sell_product_demo_data]);
    }

    public function insert_material(Request $request)
    {
        $rules = [
            'product_id' => 'unique:sell_product_demo_datas,product_id',
        ];

        $request->validate($rules, [
            'product_id.unique' => 'Product Already Added',
        ]);

        $Purchase_produc_data = Purchase_produc::where('product_id', $request->product_id)->first();
        // dd($Purchase_produc_data->product_name);

        $sell_product_demo_data = new sell_product_demo_data();
        $sell_product_demo_data->consumer_number = $request->consumer_number;
        $sell_product_demo_data->product_id = $request->product_id;
        $sell_product_demo_data->product_name = $Purchase_produc_data->product_name;
        $sell_product_demo_data->product_quantity = $request->product_quantity;
        // dd($sell_product_demo_data);
        if ($sell_product_demo_data->save()) {
            return redirect()->back();
        }
    }

    public function sell_product_demo_datas_delete($id)
    {
        $sell_product_demo_data_delete = sell_product_demo_data::find($id);

        $sell_product_demo_data_delete->delete();
        return redirect()->back();
    }

    public function insert_material_coform_data(Request $request)
    {

        try {
            $consumer_number = decrypt($request->input('authUser'));
            $sell_product_demo_data = sell_product_demo_data::query()->where('consumer_number', $consumer_number)->get();

            // * Info Log
            $randomKeySha1 = sha1(uniqid());
            $info_id = 'sell_products-' . $randomKeySha1;

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

            foreach ($sell_product_demo_data as $key => $value) {

                $sell_product = new sell_product();

                $sell_product->info_id = $info_id;
                $sell_product->consumer_number = $consumer_number;
                $sell_product->product_id = $value->product_id;
                $sell_product->product_name = $value->product_name;
                $sell_product->product_quantity = $value->product_quantity;
                $sell_product->date = Carbon::now('Asia/Kolkata')->format('d-m-Y');
                $sell_product->save();

                // // dd($sell_product_demo_data, $value->product_id, $key);
                $sell_product_data = sell_product::query()->where('product_id', $value->product_id)->first();

                $stock_query_data = stock::query()->where('product_id', $sell_product_data->product_id)->first();

                $stock_data = $sell_product_data->sell_productS;
                if ($stock_data) {
                    // Update stock data
                    $stock_data->total_sell_quantity = $stock_query_data->total_sell_quantity + $value->product_quantity;
                    $stock_data->total_remain_quantity = $stock_query_data->total_remain_quantity - $value->product_quantity;
                    $stock_data->save();
                } else {
                    // Handle case where stock_data is not found
                    continue;
                }

                sell_product_demo_data::query()->where('product_id', $value->product_id)->delete();
                // dd('header');
            }

            // dd($sell_product_demo_data);
            return response()->json($sell_product_demo_data, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 400);
        }

    }
}
