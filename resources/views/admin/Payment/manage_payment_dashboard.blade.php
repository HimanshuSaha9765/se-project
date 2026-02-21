@extends('master_layout.layout')

@section('title')
    Manage Paymet
@endsection

@section('page-title')
    Manage Paymet
@endsection

@section('content')
    @php
        // $admin = session()->has('admin');
        // $employee = session()->has('employee');
        // $dealer = session()->has('dealer');

        $paymentsFatchData = $payments->get();
        $paymentsFatchDataSimplequeryGet = $payments_simple_query->get();
        $paymentsFatchDataSimplequeryfirst = $payments_simple_query->first();
    @endphp

    <div class="x_panel">
        <div class="x_content">

            {{-- * INFO MODAL --}}
            @include('Modals.info_modal')
            <table class="table table-bordered  table-hover text-nowrap text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>Total Amount</th>
                        <th>Recived Amount</th>
                        <th>Due Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        foreach ($paymentsFatchData as $payment) {
                            // $documentModalData = $payment->Client_Document->various_amount;
                            // $totalAmount = $documentModalData->sum('various_amount') ?? 0;

                            $totalAmount = optional($payment->Client_Document)->variation_amount ?? 0;
                            // dd($pay);
                            // $totalAmount = $documentModalData->sum('variation_amount');
                        }

                        $ResivedAmount = $paymentsFatchDataSimplequeryGet->sum('recieved_amount');
                        $dueAmount = $payments->sum('due_amount');
                    @endphp
                    @if ($paymentsFatchDataSimplequeryfirst)
                        <td style="color: green; font-weight: bold;">
                            {{ $totalAmount }}
                        </td>

                        <td style="color: {{ $totalAmount == $ResivedAmount ? 'green' : 'red' }}; font-weight: bold;">
                            {{ $ResivedAmount }}
                        </td>

                        <td style="color: {{ $dueAmount <= 0 ? 'green' : 'red' }}; font-weight: bold;">
                            {{ $dueAmount }}
                        </td>
                    @else
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    @endif
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="managePaymentdashboard" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead
                                style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                <tr>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Consumer Number</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">KW</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Recived Amount</th>
                                    <th class="text-center">Due Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($paymentsFatchData as $payment)
                                    @php
                                        $documentModalData = $payment->Client_Document;
                                    @endphp
                                    <tr>

                                        <td>
                                            <div>
                                                <a style="text-decoration: none" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots-vertical"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                    </svg><i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <a class="dropdown-item edit-btn" type="button"
                                                        href="{{ URL::to('admin/') }}/add_payment/?authUser={{ encrypt($payment->consumer_number) }}"
                                                        type="button"><i class="fa fa-plus mx-2"></i>Add Payment</a>

                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $payment->info_id }}" data-toggle="modal"
                                                        data-target="#infoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- <td><a href="{{ Route('admin.client_details') }}" class="flex-shrink-0">{{ $payment->consumer_number ?? '-' }}</a></td> --}}
                                        <td><a href="{{ URL::to('admin/') }}/manage_payment/?authUser={{ encrypt($payment->consumer_number) }}"
                                                class="flex-shrink-0">{{ $payment->consumer_number ?? '-' }}</a></td>

                                        <td>{{ $documentModalData->Clients->name ?? '-' }}</td>
                                        <td>{{ $documentModalData->Clients->mobile_number ?? '-' }}</td>
                                        <td>{{ $documentModalData->Clients->kw ?? '-' }}</td>

                                        <td
                                            style="color: 
                                            {{ $documentModalData->variation_amount == $payment->total_amount ? 'green' : ($documentModalData->variation_amount <= $payment->total_amount ? 'green' : 'black') }}; 
                                            font-weight: bold;">
                                            {{ $documentModalData->variation_amount ?? '-' }}
                                        </td>

                                        <td
                                            style="color: 
                                            {{ $documentModalData->variation_amount == $payment->total_amount
                                                ? 'green'
                                                : ($documentModalData->variation_amount <= $payment->total_amount != 0
                                                    ? 'green'
                                                    : ($payment->due_amount != 0
                                                        ? 'red'
                                                        : 'black')) }}; 
                                            font-weight: bold;">
                                            {{ $payment->total_amount ?? '-' }}
                                        </td>

                                        <td
                                            style="color: {{ $documentModalData->variation_amount == $payment->total_amount
                                                ? 'green'
                                                : ($payment->total_amount == 0
                                                    ? 'red'
                                                    : ($payment->due_amount <= 0
                                                        ? '#0029ff'
                                                        : ($payment->due_amount != 0
                                                            ? 'red'
                                                            : 'green'))) }}; 
                                        font-weight: bold;">
                                            {{ $payment->due_amount ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#managePaymentdashboard thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#managePaymentdashboard thead');

            var table = $('#managePaymentdashboard').DataTable({
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
                            if (colIdx == 0 || colIdx == 8) {
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


            // Status
            $(document).on('change', '.toggle-status', function() {
                var userId = $(this).data("user-id");
                var status = $(this).prop('checked') ? 'active' : 'inactive';
                var toggleElement = $(this);

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.update_client_status', ['id' => ':id', 'status' => ':status']) }}'
                        .replace(':id', userId)
                        .replace(':status', status),
                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 160);
                        console.log(response);
                        toggleElement.bootstrapToggle('destroy').bootstrapToggle();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            $(document).on('change', '.toggle-status-permision', function() {
                var userId = $(this).data("user-permision-id");

                var status = $(this).prop('checked') ? 'Yes' : 'No';
                var toggleElement1 = $(this);

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.update_client_permision', ['id' => ':id', 'permision' => ':status']) }}'
                        .replace(':id', userId)
                        .replace(':status', status),
                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 160);
                        // console.log(response);
                        toggleElement1.bootstrapToggle('destroy').bootstrapToggle();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });


            //* delete Confirmation
            $(document).on('click', '#delete_btn', function() {
                var userId = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.delete_client', ['id' => ':id']) }}'
                                .replace(':id', userId),
                            type: 'GET',
                            success: function(response) {
                                location.reload()
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to delete the file.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
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

            $(".client_img").click(function() {
                var img = $(this).data('image');
                var imgURL = `{{ URL::to('/') }}/images/${img}`
                var hyperlink = $('.hyperlink')
                var img_modal = $(".img_modal");
                img_modal.attr('src', imgURL);
                hyperlink.attr('href', imgURL);
                $('#clientImgModal').modal('show');
            });
        });
    </script>
@endsection
