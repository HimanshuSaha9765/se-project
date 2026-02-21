@extends('master_layout.guest_master')

@section('content')
<div class="container-fluid page-header py-5 mb-5" style="min-height: 200px;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Branch</h1>
    </div>
</div>

<div class="container-fluid px-0 store-locator" style="margin-top:-20px">
    <!-- Search Header -->
    <!-- <div class="search-header bg-white p-3 shadow-sm mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-12">
                    <div class="d-flex flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control flex-grow-1 me-md-2 mb-2 mb-md-0" placeholder="Search stores here" id="storeSearch">
                        <button class="btn btn-success px-3" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Main Content -->
    <div class="row g-0">
        <!-- Map Column -->
        <div class="col-lg-6 col-12 mb-4 mb-lg-0">
            <div id="map" style="height: 70vh; width: 100%;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d140102.3849651617!2d70.68488227311417!3d22.31765638423821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x2e346bf913d4dd21%3A0x1ac73457a88abaa5!2sOffice%20No%20635%2C%20Rk%20World%20Tower%2C%20150%20Feet%20Ring%20Rd%2C%20Sheetal%20Park%2C%20Shastri%20Nagar%2C%20Dharam%20Nagar%20Society%2C%20Rajkot%2C%20Gujarat%20360005!3m2!1d22.3176772!2d70.7672839!5e1!3m2!1sen!2sin!4v1760176709217!5m2!1sen!2sin" width="100%" height="100%" style="border:0; min-height:300px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>

        <!-- Store List Column -->
        <div class="col-lg-6 col-12">
            <div class="store-list-container bg-light p-3 h-100" style="min-height: 250px; max-height: 70vh; overflow-y: auto;">
                @include('guest.BranchModal')
                <h5 class="mb-3 fw-semibold">Our Branches</h5>
                <div class="store-list">
                    @foreach ($Branch_datas_inactive as $Branch_data)
                        <div class="store-card mb-3 bg-white rounded shadow-sm p-3" data-lat="22.3072"
                            data-lng="73.1812">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="store-image-container">
                                        <div class="store-brand">BELIANCE</div>
                                       <!-- <img src="/images/branch1.jpg" alt="Store" class="store-image"
                                        onerror="this.style.display='none'">  -->
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="store-title mb-2">
                                        <span class="product-type">Solar Solutions</span> -
                                        <span class="store-name">{{ $Branch_data->branch_location_name }} Branch</span>
                                    </h6>
                                    <p class="store-address mb-3">{{ $Branch_data->address }}</p>
                                    <div class="store-actions d-flex flex-wrap gap-2">
                                        <button class="btn btn-success btn-sm px-3 view-branch-btn"
                                            data-id="{{ $Branch_data->id }}" data-bs-toggle="modal"
                                            data-bs-target="#branchModal">View details</button>
                                        @if ($Branch_data->mobile_number)
                                            <a href="https://wa.me/{{ $Branch_data->mobile_number }}" target="_blank"
                                                class="btn btn-outline-success btn-sm px-3">
                                                <i class="fab fa-whatsapp"></i> Via whatsapp
                                            </a>
                                        @endif
                                        @if ($Branch_data->location_link)
                                            <a href="{{ $Branch_data->location_link }}" target="_blank"
                                                class="btn btn-outline-success btn-sm px-3">
                                                <i class="fas fa-map-marker-alt me-1"></i>Get Direction
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Responsive fix for map and store list layout */
    .store-list-container {
        border-left: 1px solid #eee;
        min-height: 250px;
        max-height: 70vh;
        overflow-y: auto;
        height: 100%;
    }
    /* Store image responsiveness - handles the uncommented image */
    .store-image {
        max-width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 6px;
        display: block;
    }
    .store-image-container {
        max-width: 80px; /* Prevent image from dominating on mobile */
    }
    @media (max-width: 991.98px) {
        .store-list-container {
            border-left: none;
            border-top: 1px solid #eee;
            max-height: none;
            min-height: 200px;
        }
        #map {
            min-height: 250px;
            height: 300px !important;
        }
        .store-image-container {
            max-width: 60px; /* Smaller image on tablets */
        }
    }
    @media (max-width: 768px) {
        .store-list-container, #map {
            min-height: 240px;
            max-height: none;
            height: auto !important;
        }
        .page-header {
            min-height: 120px;
        }
        .store-image-container {
            max-width: 50px; /* Compact for mobile */
        }
    }
    .store-card .btn {
        white-space: nowrap;
    }
    /* Ensures cards and controls stack on small devices */
    .store-card .store-actions {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    @media (max-width: 576px) {
        .store-card {
            font-size: 0.96rem;
            padding: 1rem 0.5rem;
        }
        .store-card .store-title,
        .store-card .store-address {
            font-size: 1rem;
        }
        .store-image-container {
            max-width: 40px; /* Very small for phones */
        }
        .store-actions .btn {
            width: 100%; /* Full-width buttons on tiny screens */
            margin-bottom: 0.5rem;
        }
    }
    /* Brand and image placeholder */
    .store-brand {
        font-weight: 700;
        background: #dc3545;
        color: #fff;
        border-radius: 6px;
        padding: 4px 12px;
        margin-bottom: 6px;
        display: inline-block;
        font-size: 0.98rem;
    }
    /* Modal responsiveness */
    .modal-body {
        word-break: break-word;
    }
    @media (max-width: 576px) {
        .modal-dialog {
            max-width: 95vw;
            margin: 1rem auto;
        }
    }
</style>
@endpush