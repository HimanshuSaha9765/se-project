@extends('master_layout.layout')

@section('title')
    Master
@endsection

@section('page-title')
    Master
@endsection

@section('content')
    <div class="row g-4">

        {{-- <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Structure Accessories</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_structure') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Structure
                        </h6>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Panel</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_panel') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Panel
                        </h6>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Inverter</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_inverter') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Inverter
                        </h6>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Wiring</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_cable') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Cable
                        </h6>
                    </a>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_wiring_accessories') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Wiring Accessories
                        </h6>
                    </a>
                </div>
            </div>
        </div> --}}

        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Dealers</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_dealer_city') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Dealer City
                        </h6>
                    </a>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ route('admin.manage_reference') }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Dealer
                        </h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script></script>
@endsection
