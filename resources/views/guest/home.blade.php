@extends('master_layout.guest_master')

@section('title')
    Home
@endsection

@section('content')
    <style>
        .required_input::after {
            content: "*";
            padding: 5px;
            color: red;
        }
    </style>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            {{-- <div class="owl-carousel-item position-relative" data-dot="<img src='{{ URL::to('/') }}/img/carousel-1.jpg'>"> --}}
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ URL::to('/') }}/img/6.jpeg'>">
                <img class="img-fluid carousel-image" src="{{ URL::to('/') }}/img/6.jpeg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Clean energy is for everyone
                                </h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">BELIANCE ENERGY is expanding access to clean
                                    energy with novel platform solutions that empower everyone to go solar, enable
                                    businesses to grow, and drive environmental impact at scale.</p>
                                {{-- <a href=""
                                        class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ URL::to('/') }}/img/carousel-2.jpg'>">
                <img class="img-fluid carousel-image" src="{{ URL::to('/') }}/img/carousel-2.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">We’re into long-term relationships.
                                </h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Clean energy is not a short-term solution, so
                                    why bother with a short-term approach? Plug into a lifetime of clean energy savings with
                                    BELIANCE ENERGY end-to-end solutions. From solar design and financing to tracking,
                                    maintenance, resources, and support—we’ve got you covered!</p>
                                {{-- <a href=""
                                        class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="owl-carousel-item position-relative" data-dot="<img src='{{ URL::to('/') }}/img/carousel-3.jpg'>"> --}}
            <div class="owl-carousel-item position-relative" data-dot="<img src='{{ URL::to('/') }}/img/9.jpg'>">
                <img class="img-fluid carousel-image" src="{{ URL::to('/') }}/img/9.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">GO ABOVE AND BEYOND</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">We go out of our way to exceed every
                                    customer’s expectations. If there’s a problem, we make it right.</p>
                                {{-- <a href=""
                                        class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h3 style="text-align:center;color:#464646;"><span class="text-primary">WHAT WE DO</span></h3>
                <span style="font-weight: 500 !important;">YOU PROVIDE THE HOME. WE PROVIDE THE REST.</span>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img decoding="async" class="vc_single_image-img " src="https://blueravensolar.com/wp-content/uploads/2021/09/Professional-Rep-Bubble-03-200x200.png" width="200" height="200" alt="blue raven solar rep" title="Professional Rep Bubble-03" loading="lazy">
                    </div>
                    <span>A professional Beliance Energy Solar Representative will visit your home to outline the benefits and
                        savings you can expect by going solar.</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                            <img decoding="async" class="vc_single_image-img " src="https://blueravensolar.com/wp-content/uploads/2021/09/Panel-Bubble-02-190x190.png" width="190" height="190" alt="Solar panel icon" title="Panel Bubble-02" loading="lazy">
                    </div>
                    <span>A survey team will visit your home to design a customized solar panel system.</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img decoding="async" class="vc_single_image-img " src="https://blueravensolar.com/wp-content/uploads/2021/09/Install-Team-Bubble-03-200x200.png" width="200" height="200" alt="Trustworthy technicians and installers" title="Install Team Bubble-03" loading="lazy">
                    </div>
                    <span>The installation team will finish the process by installing the most advanced solar panel
                        technology to your home.</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img decoding="async" class="vc_single_image-img " src="https://blueravensolar.com/wp-content/uploads/2021/09/Piggy-Bank-Bubble-03-200x200.png" width="200" height="200" alt="savings" title="Piggy Bank Bubble-03" loading="lazy">
                    </div>
                    <span>Watch your efficiency increase while your utility bill decreases. Enjoy your savings each month!
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->


    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ URL::to('/') }}/img/about.jpg"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <h6 class="text-primary">About Us</h6>
                        <h3 class="mb-4">Over the past half a decade, beliance energy has assisted thousands of customers
                            in producing their own power with solar.</h3>
                        <p> Being proud pioneers of the solar industry, we believe that our solar solutions help homeowners
                            save money, become energy independent and eco-friendly. We are committed to delivering
                            cost-effective, efficient clean energy solutions to every customer.
                        </p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Customized System Design</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Convenient Financing Options</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Installations in all of india</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>30 Year Warranty</p>
                        <a href="#quote" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Get a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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
                            <p>Energy conservation is the foundation of energy independence. Sunshine is renewable energy.
                                Renewable energy comes from sources that nature will replace.</p>
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
                            <p>Off-grid solar products are renowned for their flexibility and reliability, as they harness
                                solar energy for electricity generation without relying on the conventional power grid.</p>
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
                            <p>Sunshine is renewable energy. Renewable energy comes from sources that nature will
                                replace.Because at BELIANCE, we believe that every drop contains infinite possibilities, and
                                that water has the power to change the world.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="{{ URL::to('/') }}/img/EQUIPMENT.png" alt=""
                            height="100">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-wind fa-3x"></i>
                            </div>
                            <h5 class="mb-3">ALL TYPE OF SOLAR EQUIPMENT</h5>
                            <p>We pride ourselves on creating an environment which rewards creativity and ensure we have the
                                right tools to realize our ideas. We believe in making a positive impact on our profits, our
                                people and our planet.Together, we can accelerate the sustainable energy transition.</p>
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
                            <p>OVERHEAD AND UNDERGROUND TRANSMISSION LINE WORK WITH SUBSTATION WORK AND UNDERGROUND CABLE
                                WORK</p>
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
                        <h5> We go out of our way to exceed every customer’s expectations. If there’s a problem,
                            we make it right.</h5>
                        <h6 class="text-primary">KINDNESS</h6>
                        <p class="mb-4 pb-2">Everyone within the Group acts individually and collectively to ensure respect
                            for all, constantly improve working comfort and promote a calm, pleasant and constructive
                            climate.
                        </p>
                        <h6 class="text-primary">COMMITMENT</h6>
                        <p class="mb-4 pb-2">Loyalty and involvement are the basis of balanced relationships between
                            employees, the company and external partners. This is particularly why the vast majority of
                            BELIANCE employees are on permanent contracts.
                        </p>
                        <h6 class="text-primary">ETHICS</h6>
                        <p class="mb-4 pb-2">BELIANCE is committed, through its actions and strategies, to acting in a
                            morally just manner at the social, environmental and economic levels. Thus, as part of its
                            active approach to Corporate Social Responsibility, BELIANCE is particularly committed, through a
                            Responsible Purchasing Charter, to maintaining a balanced relationship with its partners.
                        </p>
                        <h6 class="text-primary">PROFESSIONALISM</h6>
                        <p class="mb-4 pb-2">The BELIANCE teams are committed to accomplishing their mission with rigor and
                            professionalism, in order to support the development of meaningful photovoltaic projects. This
                            value implies a constant training effort. This is why BELIANCE supports its employees in their
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
                            <div class="col-6">
                                <a href="#quote" class="btn btn-primary rounded-pill py-2 px-4 mt-2">Get a Quote</a>
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



    <!-- Quote Start -->
    <div id="quote" class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ URL::to('/') }}/img/quote.jpg"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <h6 class="text-primary">Free Quote</h6>
                        <h1 class="mb-4">Get A Free Quote</h1>
                        <p class="mb-4 pb-2">Our ultimate goal is to leave you feeling empowered about your decision to
                            take power into your own hands. Now that’s powerful!</p>
                        <form action="{{ route('guest.get_a_quote') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="form-floating col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" name="name" id="name1"
                                        placeholder="Your Name" value="{{old('name')}}">
                                    <label for="name" class="required_input">Enter Full Name</label>
                                    <span id="err_msg_name" style="color:red">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-floating col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Enter Your Email"
                                        name="email" id="email1" value="{{old('email')}}">
                                    <label for="name" class="required_input">Enter Email</label>
                                    <span id="err_msg_email" style="color:red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-floating col-12 col-sm-6">
                                    <input type="text" class="form-control border-0"
                                        placeholder="Enter Your Mobile Number" name="mobile_number" id="mobile_number1" value="{{old('mobile_number')}}">
                                    <label for="name" class="required_input">Enter Mobile Number</label>
                                    <span id="err_msg_mobile_number" style="color:red">
                                        @error('mobile_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;" name="service"
                                        id="service1" class="required_input">
                                    <option for="name" value="0" disabled selected>Select Service</option>
                                        <option value="Commercial"
                                        @if (old('service') == 'Commercial') selected @endif>
                                        Commercial</option>
                                        <option value="Industrial"
                                        @if (old('service') == 'Industrial') selected @endif>
                                        Industrial</option>
                                        <option value="Residential"
                                        @if (old('service') == 'Residential') selected @endif>
                                        Residential</option>
                                    </select>
                                    <span id="err_msg_service" style="color:red">
                                        @error('service')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-floating col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Mobile Number"
                                        name="running_bill" id="running_bill1" value="{{old('running_bill')}}">
                                    <label for="name" class="required_input">Enter Running Bill Amount</label>
                                    <span id="err_msg_running_bill" style="color:red">
                                        @error('running_bill')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-floating col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Mobile Number"
                                        name="kilowatt" id="kilowatt1" value="{{old('kilowatt')}}">
                                    <label for="name" class="required_input">Enter Requirement of KW</label>
                                    <span id="err_msg_kilowatt" style="color:red">
                                        @error('kilowatt')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-floating col-12">
                                    <textarea class="form-control border-0" placeholder="Specialaddress" name="address" id="address1">{{old('address')}}</textarea>
                                    <label for="name" class="required_input">Enter Your Address</label>
                                    <span id="err_msg_address" style="color:red">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('success'))
        <script>
            $(function() {
                Swal.fire({
                    icon: "success",
                    title: '{{ session('success') }}',
                    timer: 4000
                });
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            $(function() {
                Swal.fire({
                    icon: "error",
                    title: '{{ session('error') }}',
                    timer: 4000
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#name1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (inputValue.trim() === '') {
                    $('#err_msg_name').html('Please Enter a Name.');
                } else if (!/^[a-zA-Z ]*$/.test(inputValue)) {
                    $('#err_msg_name').html('Please Enter Valid Characters Only.');
                    $(this).val('');
                } else {
                    $('#err_msg_name').html('');
                }
            });



            $('#email1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/.test(inputValue)) {
                    $('#err_msg_email').html("Please enter a valid email address");
                    $(this).val('');
                } else {
                    $('#err_msg_email').html('');
                }
            });

            $('#mobile_number1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^[0-9]{10}$/.test(inputValue)) {
                    $('#err_msg_mobile_number').html("Please enter a valid mobile number only 10 digit");
                    $(this).val('');
                } else {
                    $('#err_msg_mobile_number').html('');
                }
            });

            $('#service1').on('blur', function() {
                var selectedService = $(this).val();
                if (selectedService === '0') {
                    $('#err_msg_service').text('Please select a valid service.').show();
                } else {
                    $('#err_msg_service').hide();
                }
            });

            $('#running_bill1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^[0-9]{1,7}$/.test(inputValue)) {
                    $('#err_msg_running_bill').html("Please enter a valid amount with 1 to 7 digits only.");
                    $(this).val('');
                } else {
                    $('#err_msg_running_bill').html('');
                }
            });

            $('#kilowatt1').on('blur', function(e) {
                var inputValue = $(this).val();
                if (!/^[0-9]{1,3}$/.test(inputValue)) {
                    $('#err_msg_kilowatt').html("Please enter only digits.");
                    $(this).val('');
                } else {
                    $('#err_msg_kilowatt').html('');
                }
            });

            $('#address1').on('blur', function(e) {
                var inputValue = $(this).val();
                var err_msg_note = $('#err_msg_address');

                if (inputValue === "") {
                    err_msg_note.html("Address field cannot be empty.");
                    $(this).val('');
                } else {
                    err_msg_note.html('');
                }
            });


        });
    </script>
@endsection
