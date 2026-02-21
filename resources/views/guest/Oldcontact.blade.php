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

                        <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2457.1758193435317!2d70.76746982465366!3d22.317972783453943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaf6a7d9050d961ef%3A0xd72e8f12edd6ed01!2sbeliance%20energy!5e1!3m2!1sen!2sin!4v1755009841555!5m2!1sen!2sin"
                            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        {{-- * Head Office - Rajkot --}}
        <div class="d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                    <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                </div>
                <h2 style="text-align: center;">Head Office - Rajkot</h2>
                <p class="line"></p>
                <div class="card-body">
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>635 - Rk world tower, Shitel park, <br> 150 feet ring road, Rajkot - 360 006</p>
                    </div>
                    <div class="time">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:info@beliance.in" style="color: #555;">info@beliance.in</a>
                    </div>
                    <div class="phone">
                        <i class="fa fa-phone"></i>
                        <a href="tel:+91 85116 51364" style="color: #555;">+91 85116 51364</a>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="tel:+91 85116 51364" class="btn-center">
                        <button class="call-btn" type="button">
                            <i class="fa fa-phone me-2"></i> Call
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container">


        <div class="row my-2">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Branch Office - Junagadh --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Junagadh</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>101 - Crystal complex zanzarda
                                chockdi,<br>
                                Junagadh - 362 001 (Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:junagadh@beliance.in" style="color: #555;">junagadh@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 97271 65474" style="color: #555;">+91 97271 65474</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 97271 65474" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Branch Office - Jamnagar --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Jamnagar</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>1-Subhash Park, near samrpan
                                clinic,<br>
                                Ranjit sagar road Jamnagar-361 005(Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:jamnagar@beliance.in" style="color: #555;">jamnagar@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 99098 01890" style="color: #555;">+91 99098 01890</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 99098 01890" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Branch Office - Veraval --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Veraval</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>F-12 Shreeji, Shripal Chowk,<br>
                                Dabhor Road, Veraval - 362 265 (Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:veraval@beliance.in" style="color: #555;">veraval@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 63543 33326" style="color: #555;">+91 63543 33326</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 63543 33326" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-2">


            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Morbi --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Morbi</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>406, Shiddhi Vinayak Archade,<br>
                                Opp Rajkot Nagarik Sahkari Bank, <br>
                                Ravapar Road, Morbi - 363 641 (Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:morbi@beliance.in" style="color: #555;">morbi@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 98700 93089" style="color: #555;">+91 98700 93089</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 98700 93089" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Surat --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Surat</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Office No.14 Behind Astha Society Hall,<br>
                                Near Patel Nagar, Cenal Road Kamrj,<br> Surat - 360 003 (Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:surat@beliance.in" style="color: #555;">surat@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 78618 59687" style="color: #555;">+91 78618 59687</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 78618 59687" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                {{-- * Talala --}}
                <div class="card">
                    <div class="card-header">
                        <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Logo" class="logo">
                    </div>
                    <h2 style="text-align: center;">Branch Office - Talala Gir</h2>
                    <p class="line"></p>
                    <div class="card-body">
                        {{-- <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Office No.14 Behind Astha Society Hall,<br>
                                Near Patel Nagar, Cenal Road Kamrj,<br> Surat - 360 003 (Guj).</p>
                        </div> --}}
                        <div class="time">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:talala@beliance.in" style="color: #555;">talala@beliance.in</a>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"></i>
                            <a href="tel:+91 85111 20520" style="color: #555;">+91 85111 20520</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="tel:+91 85111 20520" class="btn-center">
                            <button class="call-btn" type="button">
                                <i class="fa fa-phone me-2"></i> Call
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact End -->
@endsection
