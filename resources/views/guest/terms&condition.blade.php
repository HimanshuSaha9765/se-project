@extends('master_layout.guest_master')

@section('title')
    Terms & Conditions
@endsection

@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5" >
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Terms & Conditions</h1>
        <p class="text-white">Read the terms and conditions carefully before using our services.</p>
    </div>
</div>
<!-- Page Header End -->

<!-- Terms & Conditions Content Start -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-15 ">
            <div class="terms-container bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-primary">Terms of Use</h2>
                @if($terms)
                    <p class="lead">{!! $terms->content !!}</p>
                @else
                    <p class="lead">Terms and Conditions content is not available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Terms & Conditions Content End -->

@endsection

@push('styles')
    <style>
        /* Terms Container Styling */
        .terms-container {
            line-height: 1.8;
            font-size: 1rem;
            color: #333;
            border: 1px solid #ddd;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .terms-container h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2C3E50;
            margin-top: 1.5rem;
        }

        .terms-container p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .terms-container ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .terms-container li {
            margin-bottom: 0.5rem;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .terms-container {
                padding: 1.5rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .terms-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush
