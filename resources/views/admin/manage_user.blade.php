@extends('master_layout.layout')

@section('title')
    User
@endsection


@section('page-title')
    User
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">


            {{--* INFO MODAL --}}
            @include('Modals.info_modal')

            <div style="display: flex; justify-content: flex-end;">
                <a href="{{ route('admin.add_user') }}">
                    <button type="button" class="btn btn-outline-dark">
                        <i class="fa fa-plus mx-1"></i>
                        Add User
                    </button>
                </a>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="userTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead
                                style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">name</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">mobile number</th>
                                    <th class="text-center">role</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
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
                                                        href="{{ URL::to('admin/') }}/edit_user/{{ $user->id }}"
                                                        type="button"><i class="fa fa-edit mx-2"></i>Edit</a>

                                                    <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $user->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button>
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $user->info_id }}" data-toggle="modal"
                                                        data-target="#infoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->name ?? '-' }}</td>
                                        <td>{{ $user->email ?? '-' }}</td>
                                        <td>{{ $user->mobile_number ?? '-' }}</td>
                                        <td>{{ $user->role ?? '-' }}</td>
                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($user->status == 'active')
                                                    <input type="checkbox" class="toggle-status" checked
                                                        data-toggle="toggle" data-onlabel="Active"
                                                        data-user-id="{{ $user->id }}" data-offlabel="Inactive"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status" data-toggle="toggle"
                                                        data-onlabel="Active" data-user-id="{{ $user->id }}"
                                                        data-offlabel="Inactive" data-onstyle="success"
                                                        data-offstyle="danger" data-size="sm">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            {{-- <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <a style="text-decoration: none" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-three-dots-vertical"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                </svg><i class="bi bi-three-dots"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <a href="#"><button class="dropdown-item" type="button"> <i
                                                            class="fa fa-edit mx-2"></i> Edit</button></a>
                                                <a href="#"><button class="dropdown-item" type="button"><i
                                                            class="glyphicon glyphicon-trash mx-2"></i> Delete</button></a>
                                                <a href="#">
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-toggle="modal" data-target="#modal-info">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i> Info</button>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Dhruv</td>
                                    <td>dhruv@mail.com</td>
                                    <td>1234567890</td>
                                    <td>Employee</td>
                                    <td>
                                        <div style="display: flex;align-items: center;justify-content: center;">
                                            <input type="checkbox" checked data-toggle="toggle" data-onlabel="Acitve"
                                                data-offlabel="Inactive" data-onstyle="success" data-offstyle="danger"
                                                data-size="sm">
                                        </div>
                                    </td>
                                </tr>
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
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

    <script>
        $(document).ready(function() {
            $('#userTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#userTable thead');

            var table = $('#userTable').DataTable({
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
                            if (colIdx == 0 || colIdx == 5) {
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
                    url: '{{ route('admin.update_user_status', ['id' => ':id', 'status' => ':status']) }}'
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
                            url: '{{ route('admin.delete_user', ['id' => ':id']) }}'
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
        });
    </script>
@endsection
