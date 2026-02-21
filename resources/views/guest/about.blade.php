@extends('master_layout.guest_master')

@section('title')
    About-Us
@endsection

@section('content')
    <style>
        .lh-2 {
            line-height: 2.7;
        }

        .flex-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 3rem;
        }

        @media (max-width: 550px) {
            .flex-item {
                flex-direction: column;
            }
        }
    </style>

    {{-- *Quote Modal --}}

    <div class="modal fade" id="get_a_quote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Quotation Inquiry</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guest.get_a_quote') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label required_input">Enter Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name1" value="{{old('name')}}">
                                    <span id="err_msg_name" style="color:red">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label required_input">Enter Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email1" value="{{old('email')}}">
                                    <span id="err_msg_email" style="color:red">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label required_input">Enter Your Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number1" value="{{old('mobile_number')}}">
                                    <span id="err_msg_mobile_number" style="color:red">
                                        @error('mobile_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label required_input">Please Select Service</label>
                                <select class="form-control" name="service" id="service1">
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
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label required_input">Enter Running Bill Amount</label>
                                    <input type="text" class="form-control" name="running_bill" id="running_bill1" value="{{old('running_bill')}}">
                                    <span id="err_msg_running_bill" style="color:red">
                                        @error('running_bill')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label required_input">Enter Requirement of KW</label>
                                    <input type="text" class="form-control" name="kilowatt" id="kilowatt1" value="{{old('kilowatt')}}">
                                    <span id="err_msg_kilowatt" style="color:red">
                                        @error('kilowatt')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label required_input">Enter Your Address</label>
                            <textarea class="form-control" name="address" id="address1">{{old('address')}}</textarea>
                            <span id="err_msg_address" style="color:red">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">About Us</h1>
        </div>
    </div>
    <!-- Page Header End -->

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
                        <h1 class="mb-4">Over the past half a decade, beliance energy has assisted thousands of customers
                            in
                            producing their own power with solar.</h1>
                        <p> Being proud pioneers of the solar industry, we believe that our solar solutions help homeowners
                            save money, become energy independent and eco-friendly. We are committed to delivering
                            cost-effective, efficient clean energy solutions to every customer.
                        </p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Customized System Design</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Convenient Financing Options</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>Installations in all of india</p>
                        <p><i class="fa fa-check-circle text-primary me-3"></i>30 Year Warranty</p>
                        {{-- <a href="" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Get a Quote</a> --}}
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5 mt-3" data-bs-toggle="modal"
                            data-bs-target="#get_a_quote" data-bs-whatever="@mdo">Get a Quote</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <div class="container">

        <div class="" style="border: 3px solid #32C36C;
        padding: 1rem;">
            <h3 style="text-align:center;color:#464646;"><span class="text-primary">Solar PV</span></h3>

            <div class="flex-item">
                <p class="lh-2">PV Uses a network of solar cells, made of silicon, which are linked together to form a
                    panel.
                    Panels can be sized or linked together to meet specific energy requirements
                    When sunlight shines on the panels an electrical
                    field is
                    created across the cells
                    This allows an electrical current to flow through the layers of cells
                    The greater the intensity of light, the greater the flow of electricity</p>
                <figure class="alignright size-full">
                    <img decoding="async" width="300" height="300"
                        src="https://www.aessolar.co.uk/wp-content/uploads/2021/12/PV1a.gif" alt=""
                        class="wp-image-5485">
                </figure>
            </div>

            <hr class="wp-block-separator has-css-opacity">

            <div class="flex-item">
                <figure class="alignleft size-full">
                    <img decoding="async" width="300" height="230"
                        src="https://www.aessolar.co.uk/wp-content/uploads/2021/12/PV2b.gif" alt=""
                        class="wp-image-5496">
                </figure>

                <p class="lh-2">The result is Direct Current (DC) electricity, which is passed to an ‘inverter’
                    The inverter changes the DC into Alternating Current (AC) electricity
                    AC is what we use everyday as mains electricity
                    The inverter then supplies this usable AC power to us through the fuse board
                </p>
            </div>

            <hr class="wp-block-separator has-css-opacity">

            <div class="flex-item">
                <p class="lh-2">If the energy created is less than required the remainder is drawn from the national
                    grid, helping to
                    keep
                    your
                    energy bills low
                    If the energy created is more than required it could
                    be
                    exported to the national grid, potentially earning you incentive payments
                    Alternatively, battery storage systems can be used to store excess energy for use at a later time,
                    rather
                    than
                    releasing it to the national grid</p>
                <figure class="alignright size-full">
                    <img decoding="async" width="300" height="300"
                        src="https://www.aessolar.co.uk/wp-content/uploads/2021/12/PV3a.gif" alt=""
                        class="wp-image-5489">
                </figure>
            </div>

        </div>

    </div>

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h3 style="text-align:center;color:#464646;"><span class="text-primary">Our Founders</span></h3>
            </div>
            <div class="row g-4" style="
            justify-content: center;
            align-items: center;">
                <div class="col-lg-4 col-md-6">
                    <div class="team-item rounded overflow-hidden">
                        <div class="p-4">
                            <h5>Bhargav Patoliya</h5>
                            <span>Founder</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-item rounded overflow-hidden">
                        <div class="p-4">
                            <h5>Keval Patel</h5>
                            <span>CEO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
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
            if (!/^[0-9]{1,6}$/.test(inputValue)) {
                $('#err_msg_running_bill').html("Please enter a valid amount with 1 to 6 digits only.");
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
