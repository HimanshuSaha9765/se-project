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
                    <div>
                        <div class="pt-4 pb-2">
                            <h4 class="card-title text-center pb-0 fs-4 text-primary">Password Retrieval</h4>
                            <p class="text-center small">Enter your user account's verified email address and we will send
                                you a password reset link.</p>
                        </div>
                        <form action="{{ route('guest.forgot_password_form_submit') }}" method="POST" id="AddForgotPasswordEmailForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="em"
                                            placeholder="Email" autocomplete="off" required>
                                        <label for="email">Enter Email</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send Verification
                                        Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    @if (session()->has('warning'))
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
                    icon: 'warning',
                    title: '{{ session('warning') }}',
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
