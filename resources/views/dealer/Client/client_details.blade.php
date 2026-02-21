@extends('dealer.dealer_layout')

@section('page-title')
    Client Detaile
@endsection

@section('title')
    Client Detail
@endsection

@section('content')
    <style>
        .h-custom {
            height: 100vh !important;
        }

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

        /* .horizontal-timeline .items .items-list:nth-child(9):before {
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
                } */

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
                    <h2 class="font-bold">Documents</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content  mx-4">
                    {{-- <a href="{{route("admin.add_client_document")}}" > --}}
                    @if (empty($Client_Document_Data) || empty($Client_Document_Data->consumer_number))
                        <a href="{{ URL::to('dealer/') }}/add_client_document/?authUser={{ $consumer_number }}">
                            <h6 class="mb-2">
                                <i class="fa fa-angle-right mx-2"></i>
                                Add Document
                            </h6>
                        </a>
                    @endif
                    {{-- <a href="{{ route('employee.Clientdownload_document_and_update') }}"> --}}
                    <a href="{{ URL::to('dealer/') }}/download_document_and_update/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Download And Update Documents</span>
                        </h6>
                    </a>
                    {{-- <a href="{{ route('employee.Clientmanage_payment') }}"> --}}
                    <a href="{{ URL::to('dealer/') }}/manage_payment/?authUser={{ $consumer_number }}">
                        {{-- <a href="{{ URL::to('dealer/Client') }}/add_payment/?authUser={{ $consumer_number }}"> --}}
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Payment</span>
                        </h6>
                    </a>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4 p-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="font-bold">Track</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content p-2  mx-4">
                    <a href="{{ URL::to('dealer/') }}/add_client_tracking/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            Add Client Tracking
                        </h6>
                    </a>
                    
                    <a href="{{ URL::to('dealer/') }}/dealer_add_material/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Add Material</span>
                        </h6>
                    </a>
                    <a href="{{ URL::to('dealer/') }}/dealer_material_report/?authUser={{ $consumer_number }}">
                        <h6 class="mb-2">
                            <i class="fa fa-angle-right mx-2"></i>
                            <span style="font-size: 15px">Material Report</span>
                        </h6>
                    </a>
                </div>
            </div>
        </div>



    </div>
    @if ($Client_tracking_Data)
        <section class="h-100 h-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important">
                            <div class="card-body p-5">
                                <p class="lead fw-bold mb-5" style="color: #f37a27">
                                    Customer Documents Tracking
                                </p>

                                <div class="row">
                                    <div class="col mb-3">
                                        <h6>Customer Name</h6>
                                        <p>{{ $Client_tracking_Data->client_tracking->name }}</p>
                                    </div>
                                    <div class="col mb-3">
                                        {{-- <p class="small text-muted mb-1">Consumer No.</p> --}}
                                        <h6>Consumer No.</h6>
                                        <p>{{ $Client_tracking_Data->consumer_number }}</p>
                                    </div>
                                    <div class="col mb-3">
                                        <h6>Application No.</h6>
                                        <p>{{ $Client_tracking_Data->application_number_1 }}</p>
                                    </div>

                                    <div class="col mb-3">
                                        <h6>Amount</h6>
                                        <p>{{ $Client_tracking_Data->amount_1 }}</p>
                                    </div>

                                </div>

                                <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27">
                                    Suggest Name
                                </p>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="horizontal-timeline">
                                            <ul class="list-inline items">

                                                <li
                                                    class="list-inline-item items-list @if (
                                                        $Client_tracking_Data->application_number_1 ||
                                                            $Client_tracking_Data->appication_1 ||
                                                            $Client_tracking_Data->amount_1) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Application Submitted
                                                    </p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if ($Client_tracking_Data->document_verified_2 || $Client_tracking_Data->resion_2) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Document Verified
                                                    </p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if ($Client_tracking_Data->metter_fee_3) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">Meter Fee</p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if ($Client_tracking_Data->fesibility_approved_4 || $Client_tracking_Data->resion_4) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Feasibility Approved
                                                    </p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if ($Client_tracking_Data->structure_image_5) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">Inverter Details</p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if (
                                                        $Client_tracking_Data->make_of_module_6 ||
                                                            $Client_tracking_Data->sr_no_module_6 ||
                                                            $Client_tracking_Data->module_mount_image_6) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">Module Details</p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if ($Client_tracking_Data->perform_7 || $Client_tracking_Data->form_16_7) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Meter Installation
                                                    </p>
                                                </li>

                                                <li
                                                    class="list-inline-item items-list @if (
                                                        $Client_tracking_Data->jr_form_8 ||
                                                            $Client_tracking_Data->subsidy_clamp_8 ||
                                                            $Client_tracking_Data->amount_8 ||
                                                            $Client_tracking_Data->description_8 ||
                                                            $Client_tracking_Data->recived_8 ||
                                                            $Client_tracking_Data->pdf_8) active @endif">
                                                    <p class="py-1 px-2 rounded mt-3">Subsidy Clamp</p>
                                                </li>

                                                {{-- <li class="list-inline-item items-list">
                                            <p class="py-1 px-2 rounded mt-3">Demo</p>
                                        </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="h-100 h-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important">
                            <div class="card-body p-5">
                                <p class="lead fw-bold mb-5" style="color: #f37a27">
                                    Customer Documents Tracking
                                </p>

                                <div class="row">
                                    <div class="col mb-3">
                                        <h6>Customer Name</h6>
                                        <p>{{ $Client_Data->name }}</p>
                                    </div>
                                    <div class="col mb-3">
                                        {{-- <p class="small text-muted mb-1">Consumer No.</p> --}}
                                        <h6>Consumer No.</h6>
                                        <p>{{ $Client_Data->consumer_number }}</p>
                                    </div>
                                    <div class="col mb-3">
                                        <h6>Application No.</h6>
                                        <p>-</p>
                                    </div>

                                    <div class="col mb-3">
                                        <h6>Amount</h6>
                                        <p>-</p>
                                    </div>

                                </div>

                                <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27">
                                    Suggest Name
                                </p>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="horizontal-timeline">
                                            <ul class="list-inline items">

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Application Submitted
                                                    </p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Document Verified
                                                    </p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">Meter Fee</p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Feasibility Approved
                                                    </p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">Inverter Details</p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">Module Details</p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">
                                                        Meter Installation
                                                    </p>
                                                </li>

                                                <li class="list-inline-item items-list">
                                                    <p class="py-1 px-2 rounded mt-3">Subsidy Clamp</p>
                                                </li>

                                                {{-- <li class="list-inline-item items-list">
                                            <p class="py-1 px-2 rounded mt-3">Demo</p>
                                        </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
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
                    title: '<h1>{{ session('error') }}</h1>',
                })
            });
        </script>
    @endif
@endsection
