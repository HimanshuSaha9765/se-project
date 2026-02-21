<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ URL::to('/') }}/img/bright.jpg" rel="icon">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

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

        body {
            background-color: #fff;
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

    @yield('content')

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
    </script>
    @yield('script')
</body>

</html>
