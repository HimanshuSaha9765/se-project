@extends('dealer.dealer_layout')

@section('title')
    Dashboard
@endsection
@section('page-title')
    Dashboard
@endsection

@php
    $Clients = $Dashboard_client_data;
    $Installers = $Dashboard_user_data->where('role', 'installer')->count();
@endphp

@section('content')
    <style>
        .background_color {
            background-color: #e9ebed;
        }

        /* 481px — 768px */
        @media only screen and (max-width: 768px) {
            .card_container_dashboard {
                gap: 1rem;
            }
        }
    </style>
    <!-- Sale & Revenue Start -->
    <div class="container">
        <div class="row card_container_dashboard">
            {{-- <div class="col-md-3 col-sm-12">
                <div class="rounded d-flex align-items-center justify-content-between p-4 background_color">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Users</p>
                        <h4 class="mb-0" style="font-weight: bold;">{{ $Users ?? '0' }}</h4>
                    </div>
                </div>
                <div style="width: 100%;text-align: center" class="bg-primary">
                    <a href="{{ route('admin.manage_user') }}">
                        <button class="btn text-white">More Info <i class="fas fa-arrow-circle-right"></i></button>
                    </a>
                </div>
            </div> --}}

            <div class="col-md-6 col-sm-12">
                <div class="rounded d-flex align-items-center justify-content-between p-4 background_color">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Clients</p>
                        <h4 class="mb-0" style="font-weight: bold;">{{ $Clients ?? '0' }}</h4>
                    </div>
                </div>
                <div style="width: 100%;text-align: center" class="bg-primary">
                    <a href="{{ route('dealer.manage_client') }}">
                        <button class="btn text-white">More Info <i class="fas fa-arrow-circle-right"></i></button>
                    </a>
                </div>
            </div>
            {{-- <div class="col-md-4 col-sm-12">
                <div class="rounded d-flex align-items-center justify-content-between p-4 background_color">
                    <i class="fa fa-handshake fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Dealears</p>
                        <h4 class="mb-0" style="font-weight: bold;">{{ $Dealears ?? '0' }}</h4>
                    </div>
                </div>
                <div style="width: 100%;text-align: center" class="bg-primary">
                    <a>
                        <button class="btn text-white" onclick="myFunction()">More Info <i
                                class="fas fa-arrow-circle-right"></i></button>
                    </a>
                </div>
            </div> --}}
            <div class="col-md-6 col-sm-12">
                <div class="rounded d-flex align-items-center justify-content-between p-4 background_color">

                    <i class="fa fa-solid fa-wrench fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Installers</p>
                        <h4 class="mb-0" style="font-weight: bold;">{{ $Installers ?? '0' }}</h4>
                    </div>
                </div>
                <div style="width: 100%;text-align: center" class="bg-primary">
                    <a>
                        <button class="btn text-white" onclick="myFunction()">More Info <i
                                class="fas fa-arrow-circle-right"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection


@section('script')
    <script>
        function myFunction() {
            alert("Not Access");
        }
    </script>
@endsection
