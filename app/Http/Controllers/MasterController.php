<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function master()
    {
        return view("admin.Master.master");
    }

    public function manage_cable()
    {
        return view("admin.Master.manage_cable");
    }
    public function add_cable()
    {
        return view("admin.Master.add_cable");
    }
    public function manage_inverter()
    {
        return view("admin.Master.manage_inverter");
    }
    public function add_inverter()
    {
        return view("admin.Master.add_inverter");
    }
    public function manage_panel()
    {
        return view("admin.Master.manage_panel");
    }
    public function add_panel()
    {
        return view("admin.Master.add_panel");
    }
    public function manage_structure()
    {
        return view("admin.Master.manage_structure");
    }
    public function add_structure()
    {
        return view("admin.Master.add_structure");
    }
    public function manage_wiring()
    {
        return view("admin.Master.manage_wiring");
    }
    public function add_wiring()
    {
        return view("admin.Master.add_wiring");
    }
}
