@extends('master_layout.layout')

@section('title')
    Stock Report
@endsection

@section('page-title')
    Stock Report
@endsection

{{-- * Total Stock Calculation --}}
@php
    $structureTotalStock = 0;
    $panelTotalStock = 0;
    $inverterTotalStock = 0;
    $cableTotalStock = 0;
    $wiringTotalStock = 0;
    foreach ($structureStock as $item) {
        $structureTotalStock += $item->remaining_qty;
    }
    foreach ($panelStock as $item) {
        $panelTotalStock += $item->remaining_qty;
    }
    foreach ($inverterStock as $item) {
        $inverterTotalStock += $item->remaining_qty;
    }
    foreach ($cableStock as $item) {
        $cableTotalStock += $item->remaining_qty;
    }
    foreach ($wiringStock as $item) {
        $wiringTotalStock += $item->remaining_qty;
    }
@endphp

@section('content')
    <div style="display: flex; justify-content: flex-end;">
        <button type="button" class="btn btn-outline-dark print_stock_report">
            <i class="fa fa-cubes" aria-hidden="true"></i>
            Print Stock Report
        </button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Stock Report</h2>
                    {{-- <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul> --}}
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    Structure Stock
                                </div>
                                <div
                                    style="display: flex;
                                justify-content: space-around;
                                align-items: center;
                                padding: 10px;
                                ">
                                    <div class="card-body" style="font-weight: 800">
                                        {{ $structureTotalStock }}
                                    </div>
                                    @if ($structureTotalStock < 50)
                                        <div class="bg-danger p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">Low
                                            In Stock
                                        </div>
                                    @else
                                        <div class="bg-success p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">
                                            In Stock
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    Panel Stock
                                </div>
                                <div
                                    style="display: flex;
                            justify-content: space-around;
                            align-items: center;
                            padding: 10px;
                            ">
                                    <div class="card-body" style="font-weight: 800">
                                        {{ $panelTotalStock }}
                                    </div>
                                    @if ($panelTotalStock < 50)
                                        <div class="bg-danger p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">Low
                                            In Stock
                                        </div>
                                    @else
                                        <div class="bg-success p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">
                                            In Stock
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    Inverter Stock
                                </div>
                                <div
                                    style="display: flex;
                            justify-content: space-around;
                            align-items: center;
                            padding: 10px;
                            ">
                                    <div class="card-body" style="font-weight: 800">
                                        {{ $inverterTotalStock }}
                                    </div>
                                    @if ($inverterTotalStock < 50)
                                        <div class="bg-danger p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">Low
                                            In Stock
                                        </div>
                                    @else
                                        <div class="bg-success p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">
                                            In Stock
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    Cable Stock
                                </div>
                                <div
                                    style="display: flex;
                            justify-content: space-around;
                            align-items: center;
                            padding: 10px;
                            ">
                                    <div class="card-body" style="font-weight: 800">
                                        {{ $cableTotalStock }}
                                    </div>
                                    @if ($cableTotalStock < 50)
                                        <div class="bg-danger p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">Low
                                            In Stock
                                        </div>
                                    @else
                                        <div class="bg-success p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">
                                            In Stock
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    Wiring Stock
                                </div>
                                <div
                                    style="display: flex;
                            justify-content: space-around;
                            align-items: center;
                            padding: 10px;
                            ">
                                    <div class="card-body" style="font-weight: 800">
                                        {{ $wiringTotalStock }}
                                    </div>
                                    @if ($wiringTotalStock < 50)
                                        <div class="bg-danger p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">Low
                                            In Stock
                                        </div>
                                    @else
                                        <div class="bg-success p-2 text-white text-center"
                                            style="font-weight: 900;width: fit-content">
                                            In Stock
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $(".print_stock_report").click(function() {
                window.print()
            })
        })
    </script>
@endsection
