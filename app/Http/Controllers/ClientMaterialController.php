<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Cable_stock;
use App\Models\Client_material;
use App\Models\Inverter;
use App\Models\Inverter_stock;
use App\Models\Panel;
use App\Models\Panel_stock;
use App\Models\Structure;
use App\Models\Structure_stock;
use App\Models\Wiring_Accessories;
use App\Models\Wiring_stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientMaterialController extends Controller
{
    public function insert_material(Request $request)
    {
        // dd($request->all());
        try {
            if (!$request->structure[0] == null) {
                //* Structure stock handling
                $final_structure_qty = 0;
                $structure_c = $request->structure;
                $total_structure_q = $request->total_structure_qty;
                foreach ($structure_c as $idx => $structure_x) {
                    $StructureStockDB = Structure::where('info_id', $structure_x)->first();
                    $final_structure_qty += $total_structure_q[$idx];
                    $final_structure_remaining_qty = $StructureStockDB->quantity - $final_structure_qty;
                    if ($total_structure_q[$idx] > 0) {
                        $used_structure_qty = $StructureStockDB->quantity - $final_structure_remaining_qty;
                    } else {
                        // TODO: Make this Check on the frontend (qty > 0)
                        session()->flash('error', 'Quantity cannot be zero');
                        return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                    }
                }
                if ($final_structure_remaining_qty < 0) {
                    // dd($final_structure_remaining_qty);
                    session()->flash('error', 'Quantity exceeded available stock. (Structure)');
                    return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                }
                Structure_stock::where('structure_id', $structure_x)->update(['used_qty' => $used_structure_qty, 'remaining_qty' => $final_structure_remaining_qty]);
                Structure::where('info_id', $structure_x)->update(['quantity' => $final_structure_remaining_qty]);
            }

            if (!$request->panel[0] == null) {
                //* Panel stock handling
                $final_panel_qty = 0;
                $panel_c = $request->panel;
                $total_panel_q = $request->total_panel_qty;
                foreach ($panel_c as $idx => $panel_x) {
                    $PanelStockDB = Panel::where('info_id', $panel_x)->first();
                    $final_panel_qty += $total_panel_q[$idx];
                    $final_panel_remaining_qty = $PanelStockDB->quantity - $final_panel_qty;
                    if ($total_panel_q[$idx] > 0) {
                        $used_panel_qty = $PanelStockDB->quantity - $final_panel_remaining_qty;
                    } else {
                        // TODO: Make this Check on the frontend (qty > 0)
                        session()->flash('error', 'Quantity cannot be zero');
                        return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                    }
                }
                if ($final_panel_remaining_qty < 0) {
                    // dd($final_panel_remaining_qty);
                    session()->flash('error', 'Quantity exceeded available stock. (Panel)');
                    return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                }
                Panel_stock::where('panel_id', $panel_x)->update(['used_qty' => $used_panel_qty, 'remaining_qty' => $final_panel_remaining_qty]);
                Panel::where('info_id', $panel_x)->update(['quantity' => $final_panel_remaining_qty]);
            }

            if (!$request->inverter[0] == null) {
                //* Inverter stock handling
                $final_inverter_qty = 0;
                $inverter_c = $request->inverter;
                $total_inverter_q = $request->total_inverter_qty;
                foreach ($inverter_c as $idx => $inverter_x) {
                    $InverterStockDB = Inverter::where('info_id', $inverter_x)->first();
                    $final_inverter_qty += $total_inverter_q[$idx];
                    $final_inverter_remaining_qty = $InverterStockDB->quantity - $final_inverter_qty;
                    if ($total_inverter_q[$idx] > 0) {
                        $used_inverter_qty = $InverterStockDB->quantity - $final_inverter_remaining_qty;
                    } else {
                        // TODO: Make this Check on the frontend (qty > 0)
                        session()->flash('error', 'Quantity cannot be zero');
                        return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                    }
                }
                if ($final_inverter_remaining_qty < 0) {
                    // dd($final_inverter_remaining_qty);
                    session()->flash('error', 'Quantity exceeded available stock. (Inverter)');
                    return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                }
                Inverter_stock::where('inverter_id', $inverter_x)->update(['used_qty' => $used_inverter_qty, 'remaining_qty' => $final_inverter_remaining_qty]);
                Inverter::where('info_id', $inverter_x)->update(['quantity' => $final_inverter_remaining_qty]);
            }

            if (!$request->cable[0] == null) {
                //* Cable stock handling
                $final_cable_qty = 0;
                $cable_c = $request->cable;
                $total_cable_q = $request->total_cable_qty;
                foreach ($cable_c as $idx => $cable_x) {
                    $CableStockDB = Cable::where('info_id', $cable_x)->first();
                    $final_cable_qty += $total_cable_q[$idx];
                    $final_cable_remaining_qty = $CableStockDB->quantity - $final_cable_qty;
                    if ($total_cable_q[$idx] > 0) {
                        $used_cable_qty = $CableStockDB->quantity - $final_cable_remaining_qty;
                    } else {
                        // TODO: Make this Check on the frontend (qty > 0)
                        session()->flash('error', 'Quantity cannot be zero');
                        return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                    }
                }
                if ($final_cable_remaining_qty < 0) {
                    // dd($final_cable_remaining_qty);
                    session()->flash('error', 'Quantity exceeded available stock. (Cable)');
                    return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                }
                Cable_stock::where('cable_id', $cable_x)->update(['used_qty' => $used_cable_qty, 'remaining_qty' => $final_cable_remaining_qty]);
                Cable::where('info_id', $cable_x)->update(['quantity' => $final_cable_remaining_qty]);
            }

            if (!$request->wiring[0] == null) {
                //* Wiring stock handling
                $final_wiring_qty = 0;
                $wiring_c = $request->wiring;
                $total_wiring_q = $request->total_wiring_qty;
                foreach ($wiring_c as $idx => $wiring_x) {
                    $WiringStockDB = Wiring_Accessories::where('info_id', $wiring_x)->first();
                    $final_wiring_qty += $total_wiring_q[$idx];
                    $final_wiring_remaining_qty = $WiringStockDB->quantity - $final_wiring_qty;
                    if ($total_wiring_q[$idx] > 0) {
                        $used_wiring_qty = $WiringStockDB->quantity - $final_wiring_remaining_qty;
                    } else {
                        // TODO: Make this Check on the frontend (qty > 0)
                        session()->flash('error', 'Quantity cannot be zero');
                        return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                    }
                }
                if ($final_wiring_remaining_qty < 0) {
                    // dd($final_wiring_remaining_qty);
                    session()->flash('error', 'Quantity exceeded available stock. (wiring)');
                    return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
                }
                Wiring_stock::where('wiring_id', $wiring_x)->update(['used_qty' => $used_wiring_qty, 'remaining_qty' => $final_wiring_remaining_qty]);
                Wiring_Accessories::where('info_id', $wiring_x)->update(['quantity' => $final_wiring_remaining_qty]);
            }


            //* Client materials saving
            $structure = implode(',', $request->structure);
            $total_structure_qty = implode(',', $request->total_structure_qty);
            $panel = implode(',', $request->panel);
            $total_panel_qty = implode(',', $request->total_panel_qty);
            $inverter = implode(',', $request->inverter);
            $total_inverter_qty = implode(',', $request->total_inverter_qty);
            $cable = implode(',', $request->cable);
            $total_cable_qty = implode(',', $request->total_cable_qty);
            $wiring = implode(',', $request->wiring);
            $total_wiring_qty = implode(',', $request->total_wiring_qty);

            $client_materials = new Client_material;
            $client_materials->consumer_number = $request->consumer_number ?? '-';
            $client_materials->structure = $structure ?? '-';
            $client_materials->total_structure_qty = $total_structure_qty ?? '-';
            $client_materials->panel = $panel ?? '-';
            $client_materials->total_panel_qty = $total_panel_qty ?? '-';
            $client_materials->inverter = $inverter ?? '-';
            $client_materials->total_inverter_qty = $total_inverter_qty ?? '-';
            $client_materials->cable = $cable ?? '-';
            $client_materials->total_cable_qty = $total_cable_qty ?? '-';
            $client_materials->wiring = $wiring ?? '-';
            $client_materials->total_wiring_qty = $total_wiring_qty ?? '-';
            $client_materials->date = $request->date;

            if ($client_materials->save()) {
                session()->flash('success', 'Material added Successfully.');
                return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
            } else {
                session()->flash('error', 'Error in adding Material.');
                return redirect()->route('installer.client_stock_details', ['consumer_number' => $request->consumer_number]);
            }
        } catch (Exception $th) {
            dd($th->getMessage());
        }
    }


    public function material_report(Request $request)
    {
        // Product::whereJsonContains('attributes', ['color' => 'green'])->get();
        $consumer_number = decrypt(request('authUser'));
        $client_materials = Client_material::where('consumer_number', $consumer_number);
        return view("installer.material_report")->with("client_materials", $client_materials);
    }
    public function add_completion_images()
    {
        // * six images of completion 
        // $client_materials = Client_material::find(1);
        // $attributes = $client_materials->attributes;
    }
}
