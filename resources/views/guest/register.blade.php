@extends('master_layout.guest_master')

@section('title')
    Sign Up
@endsection

@section('content')
    <style>
        .flex {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
    </style>

    <!-- Signup form -->
    <div class="container bg-light overflow-hidden card text-center flex" style="max-width: 30rem;">
        <div class="contact card-body flex">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-12 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div>
                        <div class="pt-4 pb-2">
                            <h4 class="card-title text-center pb-0 fs-4 text-primary">Create an Account</h4>
                            <p class="text-center small">Enter your personal details to create an account</p>
                        </div>
                        <form action="{{ route('guest.insert_user') }}" method="POST" id="registrationlForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="fname" id="fname1"
                                            placeholder="Enter Name" value="{{old('fname')}}" required>
                                        <label for="fname1">Enter Name</label>
                                        <span style="color:red">
                                            @error('fname')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email1"
                                            placeholder="Enter Email" value="{{old('email')}}" required>
                                        <label for="email1">Enter Email</label>
                                        <span style="color:red">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number1"
                                            placeholder="Enter Mobile No." value="{{old('mobile_number')}}" required>
                                        <label for="mobile_number1">Enter Mobile No.</label>
                                        <span style="color:red">
                                            @error('mobile_number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="pwd" id="pwd1"
                                            placeholder="Enter Password" autocomplete="off" value="{{old('pwd')}}" required>
                                        <label for="pwd1">Enter Password</label>
                                        <span style="color:red">
                                            @error('pwd')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="pwd_confirmation"
                                            id="pwd_confirmation1" placeholder="Enter Confirm Password" autocomplete="off" required>
                                        <label for="pwd_confirmation1">Enter Confirm Password</label>
                                        <span style="color:red">
                                            @error('pwd_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
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
    <!-- Signup form -->
@endsection

@section('scriot')
    <script>
        $(document).ready(function() {
            var addForm = $("#registrationlForm");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });
        });
    </script>
@endsection
