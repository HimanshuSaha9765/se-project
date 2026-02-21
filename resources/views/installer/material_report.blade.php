{{-- {{ dd($client_materials) }} --}}
@php
    use Carbon\Carbon;
    use App\Models\Client_material;

    $currentDate = Carbon::now('Asia/Kolkata')->format('d-m-Y');
    // Query for structures
    // $structureUsedData = Client_material::whereJsonContains('materials', ['structure'])->get();
    // $structure_used_data = Client_material::whereJsonContains(
    //     'materials->structure',
    //     'structures-197a075b971a3914ec2a55b8874ab08b331f6d01',
    // )->get();

    // // Query for panels
    // $panelUsedData = Client_material::whereJsonContains('materials', ['panel'])->get();

    // // Query for inverters
    // $inverterUsedData = Client_material::whereJsonContains('materials', ['inverter'])->get();

    // // Query for cables
    // $cableUsedData = Client_material::whereJsonContains('materials', ['cable'])->get();

    // // Query for wiring
    // $wiringUsedData = Client_material::whereJsonContains('materials', ['wiring'])->get();

    // dd($structure_used_data);

    $client_materials = $client_materials->get();
    // dd($client_materials);
    $client_materials_first = $client_materials->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @if ($client_materials_first)
        <div class="container mt-5">
            <h1 class="text-center mb-4">Material Report</h1>


            <div class="card mb-2" style="border: 1px solid black">
                <div class="card-header"
                    style="border-bottom: 1px solid black;display: flex;justify-content: space-between;align-items: center">
                    <img src="{{ URL::to('/') }}/img/bright_logo.png" height="70" width="140">
                    <h2 style="font-weight: 600;text-transform: capitalize;">
                        <span class="badge px-2 py-2 text-white" style="font-weight: 800;background: #63E6BE">
                            Beliance Energy
                        </span>
                    </h2>
                </div>
                <ul class="p-2">
                    <li class="list-group-item" style="font-size: 18px">
                        Consumer Number : {{ $client_materials_first->consumer_number }}</li>
                    <li class="list-group-item " style="font-size: 18px;border-bottom: 1px solid black !important">
                        Consumer Name : {{ $client_materials_first->Client_material->name }}</li>
                    <li class="list-group-item " style="font-size: 18px;font-weight: bold;background: none !important;">
                        Date : {{ $currentDate }}</li>
                </ul>
            </div>
            {{-- <div class="row">
            <div class="col-md-12">
                @php $i = 1; @endphp
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="text-transform: capitalize">
                                    <tr>
                                        <th>SR. No.</th>
                                        <th>structure</th>
                                        <th>total_structure_qty</th>
                                        <th>panel</th>
                                        <th>total_panel_qty</th>
                                        <th>inverter</th>
                                        <th>total_inverter_qty</th>
                                        <th>cable</th>
                                        <th>total_cable_qty</th>
                                        <th>wiring</th>
                                        <th>total_wiring_qty</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($client_materials as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->structure }}</td>
                                            <td>{{ $item->total_structure_qty }}</td>
                                            <td>{{ $item->panel }}</td>
                                            <td>{{ $item->total_panel_qty }}</td>
                                            <td>{{ $item->inverter }}</td>
                                            <td>{{ $item->total_inverter_qty }}</td>
                                            <td>{{ $item->cable }}</td>
                                            <td>{{ $item->total_cable_qty }}</td>
                                            <td>{{ $item->wiring }}</td>
                                            <td>{{ $item->total_wiring_qty }}</td>
                                            <td>{{ $item->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
            <div class="row">
                @foreach ($client_materials as $item)
                    @php
                        $structureData = explode(',', $item->structure);
                        $panelData = explode(',', $item->panel);
                        $inverterData = explode(',', $item->inverter);
                        $cableData = explode(',', $item->cable);
                        $wiringData = explode(',', $item->wiring);
                        $total_structure_qty = explode(',', $item->total_structure_qty);
                        $total_panel_qty = explode(',', $item->total_panel_qty);
                        $total_inverter_qty = explode(',', $item->total_inverter_qty);
                        $total_cable_qty = explode(',', $item->total_cable_qty);
                        $total_wiring_qty = explode(',', $item->total_wiring_qty);
                    @endphp
                    <div class="col-12">
                        <div class="card mb-2">
                            <div class="card-header" style="display: flex;justify-content: space-between;">
                                <h5>Materials Used</h5>
                                <h4>Date : {{ $item->date }}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group p-4" style="border: 1px solid #aaa;">
                                    <h4 class="p-2">Structure</h4>
                                    @foreach ($structureData as $key => $structure)
                                        <li class="list-group-item"
                                            style="display: flex;justify-content: space-between;">
                                            @php
                                                $material_info = DB::table('structures')
                                                    ->where('info_id', $structure)
                                                    ->first();
                                            @endphp
                                            <h5>{{ $material_info->accessories_name ?? '-'}}</h5>
                                            <h6>{{ $material_info->unit ?? '-'}}</h6>
                                            <h6>{{ $total_structure_qty[$key] ?? '-'}}</h6>
                                        </li>
                                    @endforeach

                                    <h4 class="p-2">Panel</h4>
                                    @foreach ($panelData as $panel)
                                        <li class="list-group-item"
                                            style="display: flex;justify-content: space-between;">
                                            @php
                                                $material_info = DB::table('panels')->where('info_id', $panel)->first();
                                            @endphp

                                            <h5>{{ $material_info->panel_name ?? '-'}}</h5>
                                            <h6>{{ $material_info->category ?? '-'}}</h6>
                                            <h6>{{ $total_panel_qty[$key] ?? '-'}}</h6>

                                        </li>
                                    @endforeach

                                    <h4 class="p-2">Inverter</h4>
                                    @foreach ($inverterData as $inverter)
                                        <li class="list-group-item"
                                            style="display: flex;justify-content: space-between;">
                                            @php
                                                $material_info = DB::table('inverters')
                                                    ->where('info_id', $inverter)
                                                    ->first();
                                            @endphp
                                            <h5>{{ $material_info->inverter_name ?? '-'}}</h5>
                                            <h5>{{ $material_info->inverter_brand ?? '-'}}</h5>
                                            <h6>{{ $total_inverter_qty[$key] ?? '-'}}</h6>
                                        </li>
                                    @endforeach

                                    <h4 class="p-2">Cable</h4>
                                    @foreach ($cableData as $cable)
                                        <li class="list-group-item"
                                            style="display: flex;justify-content: space-between;">
                                            @php
                                                $material_info = DB::table('cables')->where('info_id', $cable)->first();
                                            @endphp
                                            <h5>{{ $material_info->cable_type ?? '-'}} </h5>
                                            <h5>{{ $material_info->cable_length ?? '-'}}</h5>
                                            <h6>{{ $total_cable_qty[$key] ?? '-'}}</h6>
                                        </li>
                                    @endforeach

                                    <h4 class="p-2">Wiring</h4>
                                    @foreach ($wiringData as $wiring)
                                        <li class="list-group-item"
                                            style="display: flex;justify-content: space-between;">
                                            @php
                                                $material_info = DB::table('wiring_accessories')
                                                    ->where('info_id', $wiring)
                                                    ->first();
                                            @endphp
                                            <h5>{{ $material_info->accessories_name ?? '-'}}</h5>
                                            <h5>{{ $material_info->unit ?? '-'}}</h5>
                                            <h6>{{ $total_wiring_qty[$key] ?? '-'}}</h6>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        {{-- <h1 style="text-align: center; align-items: center">Please Add Meterial First.</h1> --}}
        <h1 style="text-align: center; align-items: center; justify-content: center;color: red">Please Add Meterial First.</h1>

    @endif
</body>

</html>
