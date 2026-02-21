@extends('master_layout.guest_master')

@section('title')
    Service
@endsection

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Our Services</h6>
                <h3 class="mb-4">We believe in making a positive impact on our profits, our people and our planet.</h3>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/1.jpeg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-solar-panel fa-3x"></i>
                            </div>
                            <h5 class="mb-3">ON GRID SOLAR SYSTEM</h5>
                            <p>Energy conservation is the foundation of energy independence. Sunshine is renewable energy. Renewable energy comes from sources that nature will replace.</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/a7.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-wind fa-3x"></i>
                            </div>
                            <h5 class="mb-3">OFF GRID SOLAR SYSTEM</h5>
                            <p>Off-grid solar products are renowned for their flexibility and reliability, as they harness solar energy for electricity generation without relying on the conventional power grid.</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/solarpark.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-lightbulb fa-3x"></i>
                            </div>
                            <h5 class="mb-3">SOLAR PARK</h5>
                            <p>Powering a sustainable future with solar energy. A responsibility beyond commitment.</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/agri.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-solar-panel fa-3x"></i>
                            </div>
                            <h5 class="mb-3">SOLAR AGRI PUMP SYSTEM</h5>
                            <p>Sunshine is renewable energy. Renewable energy comes from sources that nature will replace.Because at Bright, we believe that every drop contains infinite possibilities, and that water has the power to change the world.</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/EQUIPMENT.png" alt="" height="100">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-wind fa-3x"></i>
                            </div>
                            <h5 class="mb-3">ALL TYPE OF SOLAR EQUIPMENT</h5>
                            <p>We pride ourselves on creating an environment which rewards creativity and ensure we have the right tools to realize our ideas. We believe in making a positive impact on our profits, our people and our planet.Together, we can accelerate the sustainable energy transition.</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/12345.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-lightbulb fa-3x"></i>
                            </div>
                            <h5 class="mb-3">GOVT.APPROVED ELEC CONTRACTOR</h5>
                            <p>OVERHEAD AND UNDERGROUND TRANSMISSION LINE WORK WITH SUBSTATION WORK AND UNDERGROUND CABLE WORK</p>
                            {{-- <a class="small fw-medium" href="">Read More<i
                                            class="fa fa-arrow-right ms-2"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="p-lg-5 ps-lg-0">
                        <h6 class="text-primary">Why Choose Us!</h6>
                        <h1 class="mb-2 text-primary">GO ABOVE AND BEYOND</h1>
                        <h5> We go out of our way to exceed every customer’s expectations. If there’s a problem, we make it right.</h5>
                        <h6 class="text-primary">KINDNESS</h6>
                        <p class="mb-4 pb-2">Everyone within the Group acts individually and collectively to ensure respect
                            for all, constantly improve working comfort and promote a calm, pleasant and constructive
                            climate.
                        </p>
                        <h6 class="text-primary">COMMITMENT</h6>
                        <p class="mb-4 pb-2">Loyalty and involvement are the basis of balanced relationships between
                            employees, the company and external partners. This is particularly why the vast majority of
                            BRIGHT employees are on permanent contracts.
                        </p>
                        <h6 class="text-primary">ETHICS</h6>
                        <p class="mb-4 pb-2">BRIGHT is committed, through its actions and strategies, to acting in a
                            morally just manner at the social, environmental and economic levels. Thus, as part of its
                            active approach to Corporate Social Responsibility, BRIGHT is particularly committed, through a
                            Responsible Purchasing Charter, to maintaining a balanced relationship with its partners.
                        </p>
                        <h6 class="text-primary">PROFESSIONALISM</h6>
                        <p class="mb-4 pb-2">The BRIGHT teams are committed to accomplishing their mission with rigor and
                            professionalism, in order to support the development of meaningful photovoltaic projects. This
                            value implies a constant training effort. This is why BRIGHT supports its employees in their
                            development, whether it involves increasing their skills or evolving into new professions.
                        </p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-lg-square bg-primary rounded-circle">
                                        <i class="fa fa-check text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-0">Quality</p>
                                        <h5 class="mb-0">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-lg-square bg-primary rounded-circle">
                                        <i class="fa fa-user-check text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-0">Expert</p>
                                        <h5 class="mb-0">Workers</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-lg-square bg-primary rounded-circle">
                                        <i class="fa fa-drafting-compass text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-0">Free</p>
                                        <h5 class="mb-0">Consultation</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-lg-square bg-primary rounded-circle">
                                        <i class="fa fa-headphones text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-0">Customer</p>
                                        <h5 class="mb-0">Support</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ URL::to('/') }}/img/why1.jpg"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

@endsection