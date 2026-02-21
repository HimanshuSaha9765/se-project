@extends('master_layout.guest_master')

@section('title')
    Contact-Us
@endsection

@section('content')
    <link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0" style="margin: 6rem 0;">
        <div class="container contact px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <h6 class="text-primary">Contact Us</h6>
                        <h1 class="mb-4">Feel Free To Contact Us</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name"
                                            required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email"
                                            required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject"
                                            required>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px" required></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send
                                        Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        {{-- <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29536.41850654841!2d70.75531121243849!3d22.276008105153725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca47bde4450d%3A0x51be593cbf3bc693!2sBRIGHT%20ENERGY!5e0!3m2!1sen!2sin!4v1730979976879!5m2!1sen!2sin"
                        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}

                            <iframe class="position-absolute w-100 h-100" style="object-fit: cover;" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d140102.3849651617!2d70.68488227311417!3d22.31765638423821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x2e346bf913d4dd21%3A0x1ac73457a88abaa5!2sOffice%20No%20635%2C%20Rk%20World%20Tower%2C%20150%20Feet%20Ring%20Rd%2C%20Sheetal%20Park%2C%20Shastri%20Nagar%2C%20Dharam%20Nagar%20Society%2C%20Rajkot%2C%20Gujarat%20360005!3m2!1d22.3176772!2d70.7672839!5e1!3m2!1sen!2sin!4v1760176709217!5m2!1sen!2sin" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-office-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.15);
            background: #fff;
        }

        .custom-office-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 16px 48px rgba(44, 62, 80, 0.18);
        }

        .custom-office-header {
            background: linear-gradient(90deg, #007bff 0%, #ffc107 100%);
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
            color: #fff;
        }

        .custom-office-header img {
            background: #fff;
            border-radius: 50%;
            padding: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .custom-office-divider {
            width: 60px;
            border-top: 3px solid #fff;
            margin: 1rem auto;
        }

        .custom-office-icon {
            background: #f1f3f6;
            border-radius: 50%;
            padding: 12px;
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 16px;
        }

        .custom-call-btn {
            background: linear-gradient(90deg, #ffc107 0%, #ff9800 100%);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 2rem;
            padding: 0.75rem 2.5rem;
            font-size: 1.2rem;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.18);
            transition: background 0.2s;
        }

        .custom-call-btn:hover {
            background: linear-gradient(90deg, #ff9800 0%, #ffc107 100%);
            color: #fff;
        }

        /* Branch style card (like screenshot) */
        .branch-card {
            border-radius: 12px;
            border: 1px solid #e6eaef;
            background: #fff;
        }

        .branch-card .branch-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1f2d3d;
        }

        .branch-card .branch-address {
            color: #6c757d;
        }

        .branch-card .brand-pill {
            color: #9aa5b1;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .branch-card .btn-view {
            background-color: #2f855a;
            border-color: #2f855a;
            color: #fff;
        }

        .branch-card .btn-direction {
            background-color: #fff;
            color: #2f855a;
            border-color: #2f855a;
        }
    </style>



    <!-- Branch card sample -->
    @foreach ($Branch_datas_inactive as $Branch_data)
        @if ($Branch_data->is_head_branch == 1)
            <div class="container my-4">
                <div class="row justify-content-center">
                    <div class="col-md-11 col-lg-10">
                        <div class="branch-card p-4 p-md-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-md-2 text-md-start text-muted brand-pill">BELIANCE</div>
                                <div class="col-12 col-md-6">
                                    <div class="branch-title">{{ $Branch_data->branch_location_name }}</div>
                                    <div class="branch-address">{{ $Branch_data->address }}</div>
                                </div>
                                <div class="col-12 col-md-4 d-flex gap-2 justify-content-md-end">
                                    <a href="{{ URL::to('') }}/guest/details/{{ $Branch_data->id }}" class="btn btn-view">View details</a>
                                    {{-- <a href="{{ route('guest.details') }}" class="btn btn-view">View details</a> --}}
                                    <a href="{{ $Branch_data->location_link }}" target="_blank"
                                        class="btn btn-outline-success btn-direction"><i class="fa fa-map-marker me-1"></i>
                                        Get Direction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <!-- Contact End -->
@endsection
