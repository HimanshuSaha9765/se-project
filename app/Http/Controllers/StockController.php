<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\add_product;
use App\Models\sell_product;
use App\Models\stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function manage_stock()
    {
        $product_code = (new CommonController)->product_code();
        $Stock_data = stock::all();
        $produc_data = add_product::all();
        return view('admin.Stock.manage_stock', ['product_code' => $product_code, 'Stock_data' => $Stock_data, 'produc_data' => $produc_data]);
    }
    public function employee_manage_stock()
    {
        $product_code = (new CommonController)->product_code();
        $Stock_data = stock::all();
        $produc_data = add_product::all();
        return view('employee.Stock.manage_stock', ['product_code' => $product_code, 'Stock_data' => $Stock_data, 'produc_data' => $produc_data]);
    }
    public function installer_manage_stock()
    {
        $product_code = (new CommonController)->product_code();
        $Stock_data = stock::all();
        $produc_data = add_product::all();
        return view('installer.Stock.manage_stock', ['product_code' => $product_code, 'Stock_data' => $Stock_data, 'produc_data' => $produc_data]);
    }

    public function material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
        $consumer_number = decrypt(request('authUser'));
        // dd($consumer_number);
        $client_materials = sell_product::where('consumer_number', $consumer_number);
        // dd($client_materials->first());
        return view("admin.material_report")->with("client_materials", $client_materials);
    }
    public function employee_material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
        $consumer_number = decrypt(request('authUser'));
        // dd($consumer_number);
        $client_materials = sell_product::where('consumer_number', $consumer_number);
        // dd($client_materials->first());
        return view("employee.Material.material_report")->with("client_materials", $client_materials);
    }
    public function installer_material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
        $consumer_number = decrypt(request('authUser'));
        // dd($consumer_number);
        $client_materials = sell_product::where('consumer_number', $consumer_number);
        // dd($client_materials->first());
        return view("installer.Material.material_report")->with("client_materials", $client_materials);
    }
    public function dealer_material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
        $consumer_number = decrypt(request('authUser'));
        // dd($consumer_number);
        $client_materials = sell_product::where('consumer_number', $consumer_number);
        // dd($client_materials->first());
        return view("dealer.Material.material_report")->with("client_materials", $client_materials);
    }
}
