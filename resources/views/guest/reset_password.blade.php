@extends('master_layout.guest_master_login')

@section('title')
    BelianceEnergy
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

    <div class="container bg-light overflow-hidden card text-center flex" style="max-width: 30rem; margin-top: 200px;">
        <div class="contact card-body flex">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-12 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">

                        <h4 class="text-primary">Change Password</h4>
                        <form action="{{ route('guest.reset_password') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="npwd1" name="npwd"
                                            placeholder="npwd" value="{{ old('npwd') }}">
                                        <label for="npwd1">Enter New Password</label>
                                        <span style="color:red">
                                            @error('npwd')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="npwd_confirmation1" name="npwd_confirmation"
                                            placeholder="npwd_confirmation" autocomplete="off">
                                        <label for="npwd_confirmation1">Re-Type New Password</label>
                                        <span style="color:red">
                                            @error('npwd_confirmation')
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
                    width: '25rem',
                    padding: '10px',
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                })
            });
        </script>
    @endif
    @if (session()->has('error'))
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
                    width: '25rem',
                    padding: '10px',
                    timerProgressBar: true,
                });


                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                })
            });
        </script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            var addForm = $("#AddForgotPasswordEmailForm");
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
