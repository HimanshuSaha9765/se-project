@extends('master_layout.guest_master')
@section('title')
    Gallery
@endsection

@section('content')
    <style>
        .service-item {
            height: 300px;
            overflow: hidden;
        }

        .service-item img,
        .service-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .img-fluid{
            transition: transform .5s;
        

        }
        .img-fluid:hover{
            transform: scale(1.05);
            box-shadow:rgba(114, 137, 91, 0.804);
            /* transition-delay:3s;           */
        }
    </style>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Gallery</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-2">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 600px;">
                <h6 class="text-primary">Our Gallery</h6>
                <h1 class="mb-4">Solar Gallery</h1>
            </div>
            <div class="row g-4" style="justify-content: center;align-items: center;align-content: center;">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a1.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a2.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a3.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a4.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a5.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a6.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a7.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a8.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a11.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a9.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d4.jpg">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <video src="{{ URL::to('/') }}/img/d8.mp4" autoplay muted loop></video>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a14.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a13.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d1.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d9.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d2.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d3.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d12.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d13.jpg">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/d14.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
