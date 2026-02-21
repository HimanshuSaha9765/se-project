@extends('dealer.dealer_layout')

@section('title')
    Payment
@endsection

@section('page-title')
    Payment
@endsection

@php
    // $admin = session()->has('admin');
    // $employee = session()->has('employee');
    // $dealer = session()->has('dealer');

    if (count($payment->get()) > 0) {
        $payment123 = $payment->get();
        $payment_first = $payment->first();

        if ($payment->latest()->first() !== null) {
            $Payment2 = $payment->latest()->first();
        } else {
            $Payment2 = $payment->latest('id')->skip(1)->take(1)->first();
        }

        // $fatch_payment_table = $payment->get();
    }
@endphp


@section('content')
    <style>
        .form-control {
            min-height: 48px;
            border-radius: 8px;
        }

        button.btn {
            min-height: 54px;
        }

        #cartTable td {
            padding: 6px;
        }

        #cartTable td:nth-of-type(2) {
            text-align: right
        }

        #ticket:before {
            content: "";
            background: #fff;
            width: 32px;
            height: 32px;
            position: absolute;
            top: -16px;
            left: -16px;
            border-radius: 100%;
        }

        #ticket:after {
            content: "";
            background: #fff;
            width: 32px;
            height: 32px;
            position: absolute;
            top: -16px;
            right: -16px;
            border-radius: 100%;
        }

        #ticket {
            background: #dde8f0;
            border-top: 1px dashed #bdbdbd;
            position: relative;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        #cardNumber {
            padding-right: 60px;
        }

        #cardType {
            width: 58px;
            height: 36px;
            background: url('/static_files/images/cardLogos.png') no-repeat;
            background-size: auto 100%;
            background-position: -59px;
            position: absolute;
            right: 10px;
            top: 5px;
        }
    </style>

    <div class="x_panel">
        <div class="x_content">
            {{-- INFO MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="structureTableModalLabel">Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <h4>Created Log</h4>
                                    <hr>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Email</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="email"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Name</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="name"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Ip Address</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="ip"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Date</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="date"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Time</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="time"></h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <h4>Updated Log</h4>
                                    <hr>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Email</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="email1"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Name</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="name1"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Ip Address</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="ip1"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Date</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="date1"></h5>
                                    </div>
                                    <div class="info-child-container">
                                        <h5 class="info-heading">Time</h5>
                                        <span>:</span>
                                        <h5 class="align-center" id="time1"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-outline-secondary cl" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-2">
                <div class="container">
                    @if ($consumer_number_Of_client_documentsTable)
                        <div class="row g-5">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="p-2">
                                    <div class="mt-2">
                                        <div class="mt-2">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6 col-xs-12">
                                                    <h2 class="d-block" for="cvv"><strong>Consumer Number</strong></h2>
                                                    <small class="text-secondary"
                                                        style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->consumer_number ?? '-' }}</small>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <h2 class="d-block" for="cvv"><strong>Consumer Name</strong></h2>
                                                    <small class="text-secondary"
                                                        style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->Clients->name ?? '-' }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-2">

                                            @if ($payment->exists())
                                                @isset($payment_first->consumer_number)
                                                    @if ($payment_first->consumer_number == decrypt(request('authUser')))
                                                        <div class="row align-items-center">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <h2 class="d-block" for="cvv"><strong>Final Confirm
                                                                        Amount</strong>
                                                                </h2>

                                                                @php
                                                                    // $maxFinalConfirmAmount = $payment_first->max(
                                                                    //     'final_confirm_amount',
                                                                    // );
                                                                    $maxFinalConfirmAmount = $payment_first->final_confirm_amount;
                                                                @endphp

                                                                <small class="text-secondary" style="font-size: 17px;">
                                                                    {{ $maxFinalConfirmAmount ?? '-' }}
                                                                </small>
                                                            </div>

                                                            <div class="col-sm-4 col-xs-12">
                                                                <h2 class="d-block text-success fw-bolder" for="cvv">
                                                                    <strong>Total Recieved Amount</strong>
                                                                </h2>
                                                                <small class="text-success fw-bolder"
                                                                    style="font-size: 17px;">{{ $Payment2->total_amount ?? '-' }}</small>
                                                                {{-- <small class="text-secondary text-danger" style="font-size: 17px;">{{ $Payment2->final_confirm_amount ?? '-' }}</small> --}}
                                                            </div>

                                                            @if ($Payment2->total_amount > $maxFinalConfirmAmount && $Payment2->due_amount == '0')
                                                                <div class="col-sm-4 col-xs-12">
                                                                    <h2 class="d-block text-warning" for="cvv"><strong>
                                                                            Amount</strong>
                                                                    </h2>
                                                                    <small class="text-warning"
                                                                        style="font-size: 17px;">{{ $Payment2->due_amount ?? '-' }}</small>
                                                                </div>
                                                            @else
                                                                <div class="col-sm-4 col-xs-12">
                                                                    <h2 class="d-block text-danger" for="cvv">
                                                                        <strong>Due Amount</strong>
                                                                    </h2>
                                                                    <small class="text-danger"
                                                                        style="font-size: 17px;">{{ $Payment2->due_amount ?? '-' }}</small>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    @endif
                                                @endisset
                                            @else
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <h2 class="d-block" for="cvv"><strong>Total
                                                                Amount</strong>
                                                        </h2>
                                                        <small class="text-secondary"
                                                            style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->final_confirm_amount ?? '-' }}</small>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <h2 class="d-block text-success" for="cvv"><strong>Recieved
                                                                Amount(Deposit)</strong></h2>
                                                        <small class="text-success"
                                                            style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->deposit ?? '-' }}</small>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <h2 class="d-block text-danger" for="cvv"><strong>Due
                                                                Amount</strong></h2>
                                                        <small class="text-danger"
                                                            style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->due_amount ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        @if (!$payment)
                                            <hr>
                                            <div class="mt-2">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <h2 class="d-block text-danger" for="cvv"><strong>Due
                                                                Amount</strong></h2>
                                                        {{-- <small class="text-secondary text-danger" style="font-size: 17px;">{{ $consumer_number_Of_client_documentsTable->due_amount ?? '-' }}</small> --}}
                                                        <small class="text-secondary text-danger"
                                                            style="font-size: 17px;">{{ $Payment2->final_confirm_amount ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- <a href="{{ $admin ? URL::to('employee/') . '/add_payment/?authUser=' . $consumer_number : '' }}"> --}}
                                        <a href="{{  URL::to('dealer/') }}/add_payment/?authUser={{  $consumer_number }}">

                                            <button type="button" class="btn btn-primary mt-5 w-100">
                                                <i class="fa fa-plus mx-1"></i>
                                                Add Payment
                                            </button>
                                        </a>

                                    </div>
                                </div>


                                @if ($payment && count($payment->get()) > 0)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive" style="padding: 1rem;">
                                                <table id="paymentTable" class="table table-hover text-nowrap text-center"
                                                    style="width:100%">
                                                    <thead
                                                        style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                                        <tr>
                                                            <th class="text-center">Actions</th>
                                                            <th class="text-center">payment date</th>
                                                            <th class="text-center">Type of various</th>
                                                            <th class="text-center">various amount</th>
                                                            <th class="text-center">reason</th>
                                                            <th class="text-center">payment mode</th>
                                                            <th class="text-center">cheque number</th>
                                                            <th class="text-center">bank name</th>
                                                            <th class="text-center">type of payment</th>
                                                            <th class="text-center">transaction number</th>
                                                            <th class="text-center">final confirm amount</th>
                                                            <th class="text-center">deposit</th>
                                                            <th class="text-center">due amount</th>
                                                            <th class="text-center">recieved amount</th>
                                                            <th class="text-center">total amount</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        {{-- @foreach ($fatch_payment_table as $payments) --}}
                                                        @foreach ($payment123 as $payments)
                                                            {{-- @dd("payment :".$payments->consumer_number) --}}
                                                            <tr>
                                                                <td>
                                                                    <div>
                                                                        <a style="text-decoration: none"
                                                                            id="dropdownMenuLink" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-three-dots-vertical"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                                            </svg><i class="bi bi-three-dots"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenu2">
                                                                            {{-- <a class="dropdown-item edit-btn"
                                                                                type="button"
                                                                                href="{{ URL::to('admin/') }}/edit_user/{{ $payments->consumer_number }}"
                                                                                type="button"><i
                                                                                    class="fa fa-edit mx-2"></i>Edit</a> --}}


                                                                            {{-- <button id="delete_btn" class="dropdown-item" type="button"
                                                                            data-id="{{ $payments->id }}">
                                                                            <i class="glyphicon glyphicon-trash mx-2"></i>
                                                                            Delete
                                                                        </button> --}}
                                                                            <button id="info" class="dropdown-item"
                                                                                type="button"
                                                                                data-id="{{ $payments->info_id }}"
                                                                                data-toggle="modal"
                                                                                data-target="#userModal">
                                                                                <i
                                                                                    class="glyphicon glyphicon-info-sign mx-2"></i>
                                                                                Info
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $payments->payment_date ?? '-' }}</td>
                                                                <td>{{ $payments->type_of_various ?? '='}}</td>
                                                                <td>{{ $payments->various_amount ?? '-' }}</td>
                                                                <td>{{ $payments->reason ?? '-' }}</td>
                                                                <td>{{ $payments->payment_mode ?? '-' }}</td>
                                                                <td>{{ $payments->cheque_number ?? '-' }}</td>
                                                                <td>{{ $payments->bank_name ?? '-' }}</td>
                                                                <td>{{ $payments->type_of_payment ?? '-' }}</td>
                                                                <td>{{ $payments->transaction_number ?? '-' }}</td>
                                                                <td>{{ $payments->final_confirm_amount ?? '-' }}</td>
                                                                <td>{{ $payments->deposit ?? '-' }}</td>
                                                                <td>{{ $payments->due_amount ?? '-' }}</td>
                                                                <td>{{ $payments->recieved_amount ?? '-' }}</td>
                                                                <td>{{ $payments->total_amount ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif

                            </div>
                        </div>
                    @else
                        <h1 style="text-align: center; align-items: center">Please Add Document First.</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#paymentTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#paymentTable thead');

            var table = $('#paymentTable').DataTable({
                dom: 'Bfrtip',
                stateSave: true,
                ordering: false,
                pageLength: 0,
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],

                buttons: [
                    'pageLength',
                    {
                        extend: 'collection',
                        className: 'custom-html-collection',
                        buttons: [
                            '<h3>Export</h3>',
                            'pdf',
                            'csv',
                            'excel',
                            'print',
                            '<h3 class="not-top-heading">Column Visibility</h3>',
                            'columnsToggle'
                        ],
                    }
                ],

                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            if (colIdx == 0 || colIdx == 15) {
                                $(cell).html('');
                            } else {
                                $(cell).html(
                                    '<input type="text" class="column-wise-search" />');
                            }

                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})';

                                    var cursorPosition = this.selectionStart;
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });


            //* Info 
            $(document).on('click', '#info', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.info_data') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var created_date = new Date(response.created_date);
                        var updated_date = new Date(response.updated_date);

                        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                        ];

                        var date = created_date.getDate() + '-' + monthNames[created_date
                                .getMonth()] +
                            '-' + created_date.getFullYear();

                        var time = created_date.toLocaleTimeString('en-US', {
                            hour12: true,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        var date1 = updated_date.getDate() + '-' + monthNames[updated_date
                                .getMonth()] +
                            '-' + updated_date.getFullYear();

                        var time1 = updated_date.toLocaleTimeString('en-US', {
                            hour12: true,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        $('#email').text(response.created_email ?? '-');
                        $('#name').text(response.created_name ?? '-');
                        $('#ip').text(response.created_ip ?? '-');
                        $('#date').text(date ?? '-');
                        $('#time').text(time ?? '-');

                        $('#email1').text(response.updated_email ?? '-');
                        $('#name1').text(response.updated_name ?? '-');
                        $('#ip1').text(response.updated_ip ?? '-');

                        if (date1 === "1-Jan-1970" && time1 === "05:30:00 AM") {
                            $('#date1').text('-');
                            $('#time1').text('-');
                        } else {
                            $('#date1').text(date1 || '-');
                            $('#time1').text(time1 || '-');
                        }
                        $('#modal-info').modal('show');
                    },

                    error: function(error) {
                        alert(`Please try again, There's a server error !!`);
                        location.reload()
                    }
                });
            });
        });
    </script>
@endsection
