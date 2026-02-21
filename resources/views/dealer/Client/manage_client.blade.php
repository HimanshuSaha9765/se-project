@extends('dealer.dealer_layout')

@section('title')
    Client
@endsection

@section('page-title')
    Client
@endsection

@section('content')
    {{-- @php
        $admin = session()->has('admin');
        $employee = session()->has('employee');
        $dealer = session()->has('dealer');
    @endphp --}}

    <div class="x_panel">
        <div class="x_content">

            {{-- INFO MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="clientModal" tabindex="-1" role="dialog" aria-hidden="true">
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

            {{-- IMAGE MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="clientImgModal" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Image Preview</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            <a href="" class="hyperlink" download><img src=""
                                    class="img_modal img-fluid"></a>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-outline-secondary cl" data-dismiss="modal">
                                Close
                            </button>
                            <a href="" class="hyperlink" download>
                                <button type="button" class="btn btn-secondary">
                                    Download
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div style="display: flex; justify-content: flex-end;">
                <a href="
             {{ route('dealer.add_client') }} 
            ">
                    <button type="button" class="btn btn-outline-dark">
                        <i class="fa fa-plus mx-1"></i>
                        Add Client
                    </button>
                </a>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="clientTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead
                                style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Consumer Number</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">KW</th>
                                    <th class="text-center">Quotation Amount</th>
                                    <th class="text-center">reference by</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Bill Amount</th>
                                    <th class="text-center">Structure Lengts</th>
                                    <th class="text-center">Structure Width</th>
                                    <th class="text-center">structure height</th>
                                    <th class="text-center">Structure Image</th>
                                    <th class="text-center">process of client</th>
                                    {{-- <th class="text-center">Client Status</th> --}}
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($clients as $client)
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
                                                        href="{{ URL::to('dealer') }}/edit_client/{{ $client->id }}"
                                                        type="button"><i class="fa fa-edit mx-2"></i>Edit</a>

                                                    <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $client->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button>
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $client->info_id }}" data-toggle="modal"
                                                        data-target="#clientModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td><a href="{{ Route('admin.client_details') }}" class="flex-shrink-0">{{ $client->consumer_number ?? '-' }}</a></td> --}}
                                        <td><a href="{{ URL::to('dealer/') }}/client_details/{{ $client->consumer_number }}"
                                                class="flex-shrink-0">{{ $client->consumer_number ?? '-' }}</a></td>

                                        <td>{{ $client->name ?? '-' }}</td>
                                        <td>{{ $client->mobile_number ?? '-' }}</td>
                                        <td>{{ $client->kw ?? '-' }}</td>
                                        <td>{{ $client->quotation_amount ?? '-' }}</td>
                                        <td>{{ $client->reference_by ?? '-' }}</td>
                                        <td>{{ $client->email ?? '-' }}</td>
                                        <td>{{ $client->address ?? '-' }}</td>
                                        <td>{{ $client->bill_amount ?? '-' }}</td>
                                        <td>{{ $client->structure_length ?? '-' }}</td>
                                        <td>{{ $client->structure_width ?? '-' }}</td>
                                        <td>{{ $client->structure_height ?? '-' }}</td>
                                        @if ($client->structure_image)
                                            <td>
                                                <img class="client_img"
                                                    src="{{ URL::to('/') }}/images/{{ $client->structure_image  }} "
                                                    width="70" height="70"
                                                    data-image="{{ $client->structure_image }}">
                                                {{-- <a href="{{ asset('images/' . $client->structure_image) }}" download><img src="{{ URL::to('/') }}/images/{{$client->structure_image}}" width="70" height="70"></a> --}}
                                            </td>
                                        @else
                                            <td><img class="client_img"
                                                src="{{ URL::to('/') }}/images/default.jpg"
                                                width="70" height="70"
                                                data-image="/default.jpg"></td>
                                        @endif

                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($client->process_of_client == 'Yes')
                                                    <input type="checkbox" class="toggle-status-permision" checked
                                                        data-toggle="toggle" data-onlabel="Yes"
                                                        data-user-permision-id="{{ $client->id }}" data-offlabel="No"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status-permision"
                                                        data-toggle="toggle" data-onlabel="No"
                                                        data-user-permision-id="{{ $client->id }}" data-offlabel="No"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($client->status == 'active')
                                                    <input type="checkbox" class="toggle-status" checked
                                                        data-toggle="toggle" data-onlabel="Active"
                                                        data-user-id="{{ $client->id }}" data-offlabel="Inactive"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status" data-toggle="toggle"
                                                        data-onlabel="Active" data-user-id="{{ $client->id }}"
                                                        data-offlabel="Inactive" data-onstyle="success"
                                                        data-offstyle="danger" data-size="sm">
                                                @endif
                                            </div>
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
    </div>
@endsection


@section('footer')
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
    <script>
        $(document).ready(function() {
            $('#clientTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#clientTable thead');

            var table = $('#clientTable').DataTable({
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
                            if (colIdx == 0 || colIdx == 13 || colIdx == 14 || colIdx == 15) {
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
                    url: '{{ route('employee.update_client_status', ['id' => ':id', 'status' => ':status']) }}'
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
                    url: '{{ route('employee.update_client_permision', ['id' => ':id', 'permision' => ':status']) }}'
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
