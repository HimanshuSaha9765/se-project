<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ URL::to('/') }}/img/8 LOGO.png" rel="icon">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Libraries Stylesheet -->
    <link href="{{ URL::to('/') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/styles.css" rel="stylesheet">

    <style>
        #wpcp-error-message {
            direction: ltr;
            text-align: center;
            transition: opacity 900ms ease 0s;
            z-index: 99999999;
        }

        .hideme {
            opacity: 0;
            visibility: hidden;
        }

        .showme {
            opacity: 1;
            visibility: visible;
        }

        .msgmsg-box-wpcp {
            border: 1px solid #f5aca6;
            border-radius: 10px;
            color: #555;
            font-family: Tahoma;
            font-size: 11px;
            margin: 10px;
            padding: 10px 36px;
            position: fixed;
            width: 255px;
            top: 50%;
            left: 50%;
            margin-top: -10px;
            margin-left: -130px;
            -webkit-box-shadow: 0px 0px 34px 2px rgba(242, 191, 191, 1);
            -moz-box-shadow: 0px 0px 34px 2px rgba(242, 191, 191, 1);
            box-shadow: 0px 0px 34px 2px rgba(242, 191, 191, 1);
        }

        .msgmsg-box-wpcp span {
            font-weight: bold;
            text-transform: uppercase;
        }

        .warning-wpcp {
            background: #ffecec url('https://fsolarme.com/wp-content/plugins/wp-content-copy-protector/images/warning.png') no-repeat 10px 50%;
        }


        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 5px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #32C36C;
            border-radius: 5px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #32c36c96;
        }
    </style>
</head>

{{-- <body onselectstsrt="return false" oncontextmenu="return false;"> --}}

<body>

    {{-- onmousedown="return false" --}}
    <!--<body>-->
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5 ">
            {{-- <h2 class="m-0 text-primary">Bright</h2> --}}
            <img src="{{ URL::to('/') }}/img/8 LOGO.png" height="70" width="170">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a class="nav-item nav-link {{ request()->is('/') ? 'active bg-gradient-primary' : '' }}"
                    href="/">Home</a>
                {{-- class="nav-link text-white {{ request()->routeIs('user.dashboard') ? 'active bg-gradient-primary' : '' }}"href="{{ route('user.dashboard') }}"> --}}
                <a class="nav-item nav-link {{ request()->routeIs('guest.about') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.about') }}">About</a>
                {{-- <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ request()->routeIs('guest.service', 'dealer_ship.goldi_solar') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">Services</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a class="dropdown-item {{ request()->routeIs('guest.service') ? 'active' : '' }}"
                            href="{{ route('guest.service') }}">Service</a>
                        <a class="dropdown-item {{ request()->routeIs('dealer_ship.goldi_solar') ? 'active' : '' }}"
                            href="{{ route('dealer_ship.goldi_solar') }}">Goldi Solar</a>
                    </div>
                </div> --}}
                <a class="nav-item nav-link {{ request()->routeIs('guest.service') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.service') }}">Service</a>
                <a class="nav-item nav-link {{ request()->routeIs('guest.gallery') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.gallery') }}">Gallery</a>
                <a class="nav-item nav-link {{ request()->routeIs('guest.contact') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.contact') }}">Contact</a>
                <a class="nav-item nav-link {{ request()->routeIs('guest.branches') ? 'active bg-gradient-primary' : '' }}"
                href="{{ route('guest.branches') }}">Branch Locations </a>
                <a class="nav-item nav-link {{ request()->routeIs('guest.career') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.career') }}">Career</a>
                <a class="nav-item nav-link {{ request()->routeIs('guest.login') ? 'active bg-gradient-primary' : '' }}"
                    href="https://sms.belianceweb.com">Login</a>
                {{-- <a class="nav-item nav-link {{ request()->routeIs('guest.login') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('guest.login') }}">Login</a> --}}
            </div>
        </div>
    </nav>
    
    <!-- Navbar End -->

    


    @yield('content')
    <h1 class="text-center text-primary" style="font-size: 320%">Let The Sun Do The Work</h1>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row d-flex flex-wrap justify-content-between g-5">
                <!-- Logo Section -->
                <div class="col-lg-2 col-md-3 mb-3 d-flex flex-column align-items-center">
                    <img src="{{ URL::to('/') }}/img/8 LOGO.png" alt="Bright Logo" class="img-fluid">
                    <p class="footer-paragraph p-3">
                        Over the past five years, Beliance Energy has helped thousands of customers generate their own solar power.</p>
                </div>

                <!-- Quick Links Section -->
                <div class="col-lg-2 col-md-3">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="/">Home</a>
                    <a class="btn btn-link" href="{{ route('guest.about') }}">About Us</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">Service</a>
                    <a class="btn btn-link" href="{{ route('guest.gallery') }}">Gallery</a>
                    <a class="btn btn-link" href="{{ route('guest.contact') }}">Contact</a>
                    <a class="btn btn-link" href="{{ route('guest.career') }}">Career</a>
                </div>

                <!-- Services Section -->
                <div class="col-lg-3 col-md-4 col-sm-6 custom-service-column">
                    <h5 class="text-white mb-4">Services</h5>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">On Grid Solar System</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">Off Grid Solar System</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">Solar Park</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">Solar Agri Pump System</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">All Type Of Solar Equipment</a>
                    <a class="btn btn-link" href="{{ route('guest.service') }}">Govt.approved Elec Contractor</a>
                </div>

                <!-- Useful Links Section -->
                <div class="col-lg-2 col-md-3">
                    <h5 class="text-white mb-4">Useful Links</h5>
                    <a class="btn btn-link" href="{{ route('guest.terms&condition') }}">Terms & Conditions</a>
                </div>

                <!-- Social Media Section -->
                <div class="col-lg-2 col-md-3">
                    <h5 class="text-white mb-4">Follow Us</h5>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light btn-social"
                            href="https://wa.me/918511641364?text=Hello%21%20I%27m%20looking%20for%20a%20solar%20rooftop%20system."
                            target="_blank">
                            <i class="fab fa-whatsapp"></i>


                            <a class="btn btn-square btn-outline-light btn-social"
                                href="https://www.instagram.com/brightenergy.co.in?igsh=MWk1anUzcWxjcWJvdg=="
                                target="_blank"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-outline-light btn-social"
                                href="https://www.facebook.com/people/Bright_Energy/100077395485731/?mibextid=ZbWKwL"
                                target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light btn-social"
                                href="https://www.youtube.com/@brightenergy5882" target="_blank"><i
                                    class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        {{-- &copy; <a href="#">2023-24 </a>Beliance Energy. --}}
                        &copy; <a href="#">2025-26 </a>Beliance Energy.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Developed By: <a href="https://www.belianceweb.com/" target="_blank">Beliance Web</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer End -->


    <div id="wpcp-error-message" class="msgmsg-box-wpcp warning-wpcp hideme"><span>Alert: </span>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/wow/wow.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/easing/easing.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/lightbox/js/lightbox.min.js"></script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::to('/') }}/js/main.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        var timeout_result;

        function show_wpcp_message(smessage) {
            if (smessage !== "") {
                // smessage = "content is protected";
                var smessage_text = '<span>Alert: </span>' + smessage;
                document.getElementById("wpcp-error-message").innerHTML = smessage_text;
                document.getElementById("wpcp-error-message").className = "msgmsg-box-wpcp warning-wpcp showme";
                clearTimeout(timeout_result);
                timeout_result = setTimeout(hide_message, 4000);
            }
        }

        function hide_message() {
            document.getElementById("wpcp-error-message").className = "msgmsg-box-wpcp warning-wpcp hideme";
        }

        document.onkeydown = function(e) {
            if (event.keyCode == 123) {
                show_wpcp_message("You are not allowed to inspect or debug the content.");
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                show_wpcp_message("You are not allowed to inspect or debug the content.");
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                show_wpcp_message("You are not allowed to inspect or debug the content.");
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
                show_wpcp_message("Copying content is restricted.");
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'X'.charCodeAt(0)) {
                show_wpcp_message("Cutting content is restricted.");
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                show_wpcp_message("Viewing page source is restricted.");
                return false;
            }
        };
        document.ondblclick = function() {
            show_wpcp_message("Content is protected.");
        };
        // Disable right-click
        document.oncontextmenu = function() {
            show_wpcp_message("Content is protected.");
            return false;
        };
    </script>
</body>
@yield('script')

</html>
