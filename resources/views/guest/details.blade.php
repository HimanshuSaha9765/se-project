@extends('master_layout.guest_master')

@section('title')
    Details
@endsection

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">Solar Solutions</h2>
        <div class="row">
            <div class="col-md-6" style="background-color: #f7f7f7; padding: 20px; border-radius: 8px;">
                <h5 style="color: #2f855a;">Solar Solutions - {{ $branch_location_details->branch_location_name }}</h5>
                <p><i class="fas fa-map-marker-alt" style="color: #2f855a;"></i> {{ $branch_location_details->address }}</p>
                <p><i class="fas fa-phone" style="color: #2f855a;"></i> {{ $branch_location_details->mobile_number }}</p>
                <p><strong>Working Hours :</strong></p>
                <p>{{ $branch_location_details->working_time }}</p>
                <p>Sunday: Closed</p>
                <div class="d-flex gap-3">
                    <a href="{{ $branch_location_details->location_link }}" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-map-marker-alt"></i> Get Direction
                    </a>
                    <a href="https://wa.me/{{ $branch_location_details->mobile_number }}" target="_blank"
                        class="btn btn-outline-success">
                        <i class="fab fa-whatsapp"></i> Via whatsapp
                    </a>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Store Image"
                    style="max-width: 100%; height: auto; border-radius: 8px;">
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Add any custom JavaScript here if needed
    </script>
@endsection
