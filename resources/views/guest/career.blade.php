@extends('master_layout.guest_master')

@section('title')
    Career
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Career</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white active fw-bold" aria-current="page">Empower Your Journey</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container ">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h4 class="text-primary">WE'RE HIRING!</h4>
            <h6 class="mb-4">At the core of our mission, vision, and values, we have our people! Financial success is only possible through them, which is why we celebrate our employees’ achievements and pay special attention to their well-being</h6>
            <h6 class="mb-4">Our company is young, dynamic, and fun at heart! We want every Yellow Door Energy family member to feel at home when they walk through the office door.</h6>
            <h6 class="mb-4">As a fast-growing company, we are always looking for new team members. We are positively impacting the environment and society, and you can, too! Join us on this sustainable energy journey.</h6>
        </div>
    </div>
    <!-- career End -->

    <!-- career form -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0" style="margin: 6rem 0;">
        <div class="container contact px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-12 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <h4 class="text-primary">Career</h4>
                        <form enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                                        <label for="name">Enter Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                        <label for="email">Enter Contact No.</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="subject" placeholder="Subject" required>
                                        <label for="subject">Enter Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                                        <label for="subject">Enter Qualification</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                                        <label for="subject">Enter Passing Year</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                                        <label for="subject">Work Experience (If Any)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    {{-- <div class="form-floating"> --}}
                                    <input type="file" class="form-control" id="subject" placeholder="Subject" required>
                                    {{-- <label for="message">Upload Resume</label> --}}
                                    {{-- </div> --}}
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- career form-->
@endsection
