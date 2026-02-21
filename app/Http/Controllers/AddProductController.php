<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\add_product;
use App\Models\Log_Infos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AddProductController extends Controller
{
    public function manage_product(Request $request)
    {
        $product_code = (new CommonController)->product_code();
        $Product_data = add_product::query()->where('status', '!=', 'deleted')->get();
        $produc_data = add_product::all();


        return view('admin.Master.manage_product')->with(['product_code' => $product_code, 'Product_data' => $Product_data,'produc_data'=>$produc_data]);
    }

    public function insert_product(Request $request)
    {
        // * Info Log
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Products-' . $randomKeySha1;

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

        $add_product = new add_product();
        $add_product->info_id = $info_id;
        $add_product->product_id = $request->product_id;
        $add_product->product_name = $request->product_name;
        $add_product->unit = $request->unit;

        if ($add_product->save()) {
            session()->flash('success', 'product added Successfully.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in adding product.');
            return redirect()->back();
        }
    }
    public function edit_product($id)
    {
        $add_product = add_product::where('id', $id)->first();
        return response()->json($add_product);
    }
    public function update_product(Request $request)
    {
        $add_product_data = add_product::whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::whereRaw('table_id = ?', [$add_product_data->info_id])->first();
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

        $add_product = add_product::where('id', $request->id)
            ->update([
                'product_name' => $request->product_name,
                'unit' => $request->unit,
            ]);

        if ($add_product) {
            session()->flash('success', 'Product updated successfully.');
            // return redirect()->route('admin.manage_product');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error in updating product.');
            return redirect()->back();
            // return redirect()->route('admin.manage_product');
        }
    }
    public function delete_product($id)
    {
        $add_product = add_product::find($id);
        if (!$add_product) {
            session()->flash('error', 'Product not found.');
            return response()->json(['Error' => 'Error product Not Found']);
        }

        $add_product->status = 'deleted';
        $add_product->save();

        session()->flash('success', 'Product deleted successfully.');
        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function update_product_status($id, $status)
    {
        $add_product = add_product::where('id', $id)->update(['status' => $status]);

        if (!$add_product) {
            session()->flash('error', 'Error in updating product status.');
            return response()->json(['Error' => 'Error in updating product status']);
        } else {
            session()->flash('success', 'add_product status updated successfully.');
            return response()->json(['message' => 'product status updated successfully']);
        }
    }
}