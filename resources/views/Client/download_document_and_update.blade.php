@extends('master_layout.layout')

@section('page-title')
    Documents Gallery
@endsection

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now('Asia/Kolkata')->format('d-m-Y');

    if (count($payment->get()) > 0) {
        $payment123 = $payment->get();
        $payment = $payment->first();

        if ($payment->latest()->first() !== null) {
            $Payment2 = $payment->latest()->first();
        } else {
            $Payment2 = $payment->latest('id')->skip(1)->take(1)->first();
        }

        $maxFinalConfirmAmount = $payment->max('final_confirm_amount');
    }
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($Client_Document)
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Documents Gallery</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <div style="display: flex; justify-content: flex-end;">
                                <a
                                    href="{{ URL::to('admin/') }}/edit_client_document/{{ $Client_Document->consumer_number }}">
                                    <button type="button" class="btn btn-outline-dark">
                                        <i class="fa fa-edit mx-1"></i>
                                        Edit Document
                                    </button>
                                </a>
                            </div>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @if ($payment->exists())
                            @isset($payment->consumer_number)
                                @if ($payment->consumer_number == decrypt(request('authUser')))
                                    <div class="card mb-2" style="border: 1px solid black">
                                        <div class="card-header" style="border-bottom: 1px solid black">
                                            <h2 style="font-weight: 600;text-transform: capitalize;">
                                                {{ $Client_Document->Clients->name }}
                                            </h2>
                                        </div>
                                        <ul class="p-2">
                                            <li class="list-group-item" style="font-size: 18px">Total Amount:
                                                {{ $maxFinalConfirmAmount }}</li>
                                            {{-- <li class="list-group-item text-success"
                                                style="font-size: 18px;border-bottom: 1px solid black !important">
                                                Deposit : {{ $Client_Document->deposit }}</li> --}}
                                            <li class="list-group-item text-success"
                                                style="font-size: 18px;border-bottom: 1px solid black !important">
                                                Recieved Amount : {{ $Payment2->total_amount ?? '-' }}</li>
                                            @if ($Payment2->total_amount > $maxFinalConfirmAmount)
                                                <li class="list-group-item text-warning"
                                                    style="font-size: 18px;font-weight: bold;background: none !important;">Total
                                                    Amount : {{ $Payment2->due_amount ?? '-' }}</li>
                                            @else
                                                <li class="list-group-item text-success"
                                                    style="font-size: 18px;font-weight: bold;background: none !important;">
                                                    Due Amount : {{ $Payment2->due_amount ?? '-' }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endisset
                            @endif
                        @else
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header" style="border-bottom: 1px solid black">
                                    <h2 style="font-weight: 600;text-transform: capitalize;">
                                        {{ $Client_Document->Clients->name }}
                                    </h2>
                                </div>
                                <ul class="p-2">
                                    <li class="list-group-item" style="font-size: 18px">Total Amount:
                                        {{ $Client_Document->final_confirm_amount }}</li>
                                    <li class="list-group-item text-success"
                                        style="font-size: 18px;border-bottom: 1px solid black !important">
                                        Deposit : {{ $Client_Document->deposit }}</li>
                                    <li class="list-group-item text-danger"
                                        style="font-size: 18px;font-weight: bold;background: none !important;">Due
                                        Amount : {{ $Client_Document->due_amount }}</li>
                                </ul>
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        {{-- <img style="width: 100%; display: block;" src="https://sample-videos.com/img/Sample-png-image-100kb.png" alt="image" width="100" height="200" /> --}}
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->adharcard_image) }}" alt="Image"
                                            width="100" height="200">
                                        <div class="mask">
                                            {{-- <p>{{ $Client_Document->adharcard_number }}</p> --}}
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->adharcard_image) }}"
                                                    download><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Aadhar Card</p>
                                        <p style="font-weight: 800">Adhar Card Number :
                                            {{ $Client_Document->adharcard_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->light_bill) }}" alt="image"
                                            width="100" height="200" />
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->light_bill) }}" download><i
                                                        class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Light Bill</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->text_bill) }}" alt="image"
                                            width="100" height="200" />
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->text_bill) }}" download><i
                                                        class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Text Bill</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->passport_size_image) }}"
                                            alt="image" width="100" height="200" />
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->passport_size_image) }}"
                                                    download><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Passport Size Image</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->pancard) }}" alt="image"
                                            width="100" height="200" />
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->pancard) }}" download><i
                                                        class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Pancard</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;"
                                            src="{{ asset('images/' . $Client_Document->bank_proof) }}" alt="image"
                                            width="100" height="200" />
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                <a href="{{ asset('images/' . $Client_Document->bank_proof) }}"
                                                    download><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>Bank proof (Cancel Cheque)</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            @else
                <h1 style="text-align: center; align-items: center">Please Add Document First.</h1>
            @endif
        </div>
    </div>
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
                    title: '<h1>{{ session('error') }}</h1>',
                })
            });
        </script>
    @endif
@endsection
