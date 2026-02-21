<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\add_product;
use App\Models\Cable_stock;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Client_material;
use App\Models\Inverter_stock;
use App\Models\Panel_stock;
use App\Models\Structure_stock;
use App\Models\User;
use App\Models\Wiring_stock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Services\AdminService;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public AdminService $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    var $compact_data;
    public function dashboard()
    {
       $this->compact_data = $this->adminService->dashboard();
        // dd($this->compact_data['Dashboard_client_data']);
        return view("admin.admin_dashboard", $this->compact_data);
    }
    public function manage_user()
    {
       $this->compact_data = $this->adminService->manage_user();
        return view('admin.manage_user', $this->compact_data);
    }

    // public function manage_stock()
    // {
    //     $lastItem = add_product::latest('id')->first();

    //     if ($lastItem) {
    //         // Extract the product_id from the last item
    //         $lastProductCode = $lastItem->product_id;
    //         $numericPart = intval($lastProductCode);

    //         $nextNumericPart = str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT);

    //         $product_code = $nextNumericPart;
    //     } else {
    //         $product_code = '001';
    //     }
    //     return view('admin.Stock.manage_stock', ['product_code' => $product_code]);
    // }

    public function view_stock()
    {
        $structureStock = Structure_stock::where("status", "!=", "deleted")->get();
        $panelStock = Panel_stock::where("status", "!=", "deleted")->get();
        $inverterStock = Inverter_stock::where("status", "!=", "deleted")->get();
        $cableStock = Cable_stock::where("status", "!=", "deleted")->get();
        $wiringStock = Wiring_stock::where("status", "!=", "deleted")->get();
        return view("admin.Stock.view_stock", compact('structureStock', 'panelStock', 'inverterStock', 'cableStock', 'wiringStock'));
    }

    // public function material_report()
    // {
    //     try {
    //         return view('admin.material_report');
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    public function material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
       $this->compact_data = $this->adminService->material_report($request);
        return view("admin.material_report", $this->compact_data);
    }



    // public function editPageContent()
    // {
    //     try {
    //         $pagecontent = "";
    //         $page_title = Route::currentRouteName();
    //         $page_title = str_replace('admin.', '', $page_title);
    //         $file_name = $page_title;
    //         $file_name = str_replace('-&-', '-', $file_name) . '.txt';
    //         $page_title = str_replace('-', ' ', $page_title);
    //         $page_title = ucwords($page_title);

    //         if (Storage::exists($file_name)) {
    //             $pagecontent = Storage::get($file_name);
    //         } else {
    //             Storage::put($file_name, "");
    //         }

    //         return view('admin.TermsCondition.edit-page', compact('pagecontent', 'page_title', 'file_name'));
    //     } catch (Throwable $e) {
    //         report($e);
    //         return redirect()->back()->with('error', trans('app.something_went_wrong'));
    //     }
    // }

    // public function savePageContent(Request $request)
    // {
    //     try {
    //         Storage::put($request->file_name, $request->page_content);
    //         dd($request->page_content);
    //         if (Storage::exists($request->file_name)) {
    //             Storage::put($request->file_name, $request->page_content);
    //         } else {
    //             Storage::put($request->file_name, $request->page_content);
    //         }
    //         session()->flash('success', 'Terms & Conditions are saved');
    //         return redirect()->route('admin.terms-&-conditions')
    //             ->with( ['page' => $request->page_title]);
    //     } catch (Throwable $e) {
    //         report($e);
    //         return redirect()->back()->with('error', trans('app.something_went_wrong'));
    //     }
    // }
}
