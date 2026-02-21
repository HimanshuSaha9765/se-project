<?php

namespace App\Http\Controllers;

use App\Models\add_product;
use App\Models\Log_Infos;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    var $info_data;
    public function fetch_data_for_info(Request $request)
    {
        // $id = $request->id;
        // $this->info_data = Log_Infos::where('table_id', $id)->first();
        // $this->info_data = Log_Infos::where('table_id', $id)->latest()->first();
        
        // return $this->info_data;

        $id = $request->id;
    
        // Fetch the first (created) log entry
        $createdLog = Log_Infos::where('table_id', $id)->oldest()->first();
        
        // Fetch the latest (updated) log entry
        $updatedLog = Log_Infos::where('table_id', $id)->latest()->first();
        
        return response()->json([
            'created_log' => $createdLog,
            'updated_log' => $updatedLog
        ]);
    }

    public function product_code(){
        $lastItem = add_product::latest('id')->first();
        // dd($lastItem);

        if ($lastItem) {
            // Extract the product_id from the last item
            $lastProductCode = $lastItem->product_id;
            $numericPart = intval($lastProductCode);

            $nextNumericPart = str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT);

            $product_code = $nextNumericPart;
        } else {
            $product_code = '001';
        }
        return $product_code;
    }

}
