@extends('master_layout.guest_master')

@section('title')
    Login
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

    <!-- Login form -->

    <div class="container bg-light overflow-hidden card text-center flex" style="max-width: 30rem;">
        <div class="contact card-body flex">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-12 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="text-primary">Login</h4>
                    <form action="{{ route('login_authentication') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email1" name="email"
                                        placeholder="Email" value="{{ old('email') }}">
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
                                    <input type="password" class="form-control" id="password1" name="password"
                                        placeholder="Password" autocomplete="off">
                                    <label for="password1">Enter Password</label>
                                    <span style="color:red">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Submit</button>
                            </div>

                            <div class="col-sm-12" style="margin-top: 1rem;">
                                <div class="flex justify-content-between">
                                    <a href="{{ route('guest.forgot_password') }}">Forgot Password?</a>
                                    <a href="{{ route('guest.register') }}">Create Account</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login form-->
@endsection

@section('script')
    @if (session()->has('success'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        title: 'title'
                    },
                    width: '32rem',
                    padding: '1rem',
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                })
            });
        </script>
    @endif
    @if (session()->has('error_middleware'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        title: 'title'
                    },
                    width: '32rem',
                    padding: '1rem',
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'warning',
                    title: '{{ session('error_middleware') }}',
                })
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        title: 'title'
                    },
                    width: '32rem',
                    padding: '1rem',
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'warning',
                    title: '{{ session('error') }}',
                })
            });
        </script>
    @endif
@endsection
