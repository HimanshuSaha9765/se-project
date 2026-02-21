@extends('installer.intsaller_layout')

@section('page-title')
    Client Stock Details
@endsection

@section('title')
    Client Stock Details
@endsection

@section('content')
    <style>

        .horizontal-timeline .items {
            border-top: 2px solid #ddd;
            display: flex;
            justify-content: space-around;
            gap: 1rem;
        }

        .horizontal-timeline .items .items-list {
            position: relative;
            margin-right: 0;
        }

        .horizontal-timeline .items .items-list:nth-child(1):before {
            content: "1";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background: gray;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(2):before {
            content: "2";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            background: gray;
            color: white;
        }

        .horizontal-timeline .items .items-list:nth-child(3):before {
            content: "3";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(4):before {
            content: "4";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(5):before {
            content: "5";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(6):before {
            content: "6";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(7):before {
            content: "7";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(8):before {
            content: "8";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list:nth-child(9):before {
            content: "9";
            position: absolute;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: gray;
            top: -12px;
            left: 22px;
            text-align: center;
            margin-top: -7px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .horizontal-timeline .items .items-list {
            padding-top: 15px;
            font-size: 12px;
            width: 230px;
        }

        .horizontal-timeline .items .items-list p {
            background: gray;
            font-weight: 700;
            color: white;
        }

        .horizontal-timeline .items .items-list.active p {
            color: white;
            background-color: #3fc91d;
        }

        .horizontal-timeline .items .items-list.active:before {
            background-color: #3fc91d;
        }

        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        @media screen and (max-width: 768px) {
            .horizontal-timeline .items {
                flex-direction: column;
            }

            .horizontal-timeline .items {
                border-top: none;
            }
        }
    </style>


    <div class="row g-4">
        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Client Stock</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content  mx-4">
                    <a href="{{ URL::to('installer/') }}/installer_add_material/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Add Material
                        </h6>
                    </a>
                    <a href="{{ URL::to('installer/') }}/installer_material_report/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Material Report</span>
                        </h6>
                    </a>

                    {{-- <a href="{{ URL::to('installer/') }}/add_completion_images/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Add Completion Images</span>
                        </h6>
                    </a> --}}

                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Panel Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content  mx-4">
                    <a href="{{ URL::to('installer/') }}/add_material/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Add Panel Details
                        </h6>
                    </a>
                    <a href="{{ URL::to('installer/') }}/material_report/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Panel Report</span>
                        </h6>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- <section class="h-50 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-lg-12 col-xl-12">
                    <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important">
                        <div class="card-body p-5">
                            <p class="lead fw-bold mb-5" style="color: #f37a27">
                                Customer Material Tracking
                            </p>

                            <div class="row">
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Customer Name</p>
                                    <p>Demo</p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Application No.</p>
                                    <p>123456</p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Consumer No.</p>
                                    <p>012j1gvs356c</p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Amount</p>
                                    <p>10000</p>
                                </div>

                            </div>

                            <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27">
                                Suggest Name
                            </p>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="horizontal-timeline">
                                        <ul class="list-inline items">
                                            <li class="list-inline-item items-list active">
                                                <p class="py-1 px-2 rounded mt-3">
                                                    Structure
                                                </p>
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded mt-3">
                                                    Panel
                                                </p>
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded mt-3">Inverter</p>
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded mt-3">
                                                    Cable
                                                </p>
                                            </li>

                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded mt-3">Wiring</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection


@section('script')
    @if (session()->has('success'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        title: 'title'
                    },
                    width: '25rem',
                    padding: '10px',
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                })
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        title: 'title'
                    },
                    width: '25rem',
                    padding: '10px',
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                })
            });
        </script>
    @endif
@endsection
