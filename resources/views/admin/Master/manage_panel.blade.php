@extends('master_layout.layout')

@section('page-title')
    Panel
@endsection

@section('title')
    Panel
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">
            <div style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#PanelModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add
                </button>
            </div>

            <div class="modal fade" id="PanelModal" tabindex="-1" role="dialog" aria-labelledby="PanelModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="panelTableModalLabel">Add Panel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="AddPanelForm" action="{{ route('admin.insert_panel') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="panel" class="col-form-label required_input">Panel Name</label>
                                    <input type="text" class="form-control" name="panel_name" id="panel1"
                                        placeholder="Enter panel Name" required>
                                    <span id="arr_msg_panel" style="color:red">
                                        @error('panel_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="col-form-label">Category</label>
                                    <input type="text" class="form-control" name="category" id="category1"
                                        placeholder="Enter Category">
                                    <span id="crr_msg_category" style="color:red">
                                        @error('category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="panelEditModal" tabindex="-1" role="dialog" aria-labelledby="panelModalEditLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="panelTableModalLabel">Edit panel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="EditPanelForm" method="POST" action="{{ route('admin.update_panel') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group" style="display: none">
                                    <input type="text" class="form-control" id="id" placeholder="Enter id"
                                        name="id" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="accessories-name" class="col-form-label required_input">Panel Name</label>
                                    <input type="text" class="form-control" name="panel_name_edit" id="panel-name-edit"
                                        placeholder="Enter panel Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Unit" class="col-form-label">Category</label>
                                    <input type="text" class="form-control" id="category-edit" name="category_edit"
                                        placeholder="Enter Category">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- INFO MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="panelInfoModal" tabindex="-1" role="dialog"
                aria-hidden="true">
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="panelTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead style="background: white;text-align: center; align-items: center;">
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Panel Name</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Panels as $panel)
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
                                                    <button class="dropdown-item edit-btn" type="button"
                                                        data-id="{{ $panel->id }}"> <i class="fa fa-edit mx-2"></i>
                                                        Edit</button>
                                                    <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $panel->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button>
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $panel->info_id }}" data-toggle="modal"
                                                        data-target="#panelInfoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $panel->panel_name ?? '-' }}</td>
                                        <td>{{ $panel->category ?? '-' }}</td>
                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($panel->status == 'active')
                                                    <input type="checkbox" class="toggle-status" checked
                                                        data-toggle="toggle" data-onlabel="Active"
                                                        data-panel-id="{{ $panel->id }}" data-offlabel="Inactive"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status" data-toggle="toggle"
                                                        data-onlabel="Active" data-panel-id="{{ $panel->id }}"
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
            $('#panelTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#panelTable thead');

            var table = $('#panelTable').DataTable({
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
                            if (colIdx == 0 || colIdx == 3) {
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

            var addForm = $("#AddPanelForm");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });

            $(".close, [data-dismiss='modal']").click(function() {
                addForm.validate().resetForm();
            });

            $('.table').on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.edit_panel', ['id' => ':id']) }}'
                        .replace(':id', id),
                    type: "GET",
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#panel-name-edit').val(data.panel_name);
                        $('#category-edit').val(data.category);
                        $('#panelEditModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            var editForm = $("#EditPanelForm");

            editForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });

            $(".close, [data-dismiss='modal']").click(function() {
                editForm.validate().resetForm();
            });

            $(document).on('change', '.toggle-status', function() {
                var panelId = $(this).data("panel-id");
                var status = $(this).prop('checked') ? 'active' : 'inactive';
                var toggleElement = $(this);

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.update_panel_status', ['id' => ':id', 'status' => ':status']) }}'
                        .replace(':id', panelId)
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
                var panelId = $(this).data("id");
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
                            url: '{{ route('admin.delete_panel', ['id' => ':id']) }}'
                                .replace(':id', panelId),
                            type: 'GET',
                            success: function(response) {
                                // Swal.fire({
                                //     title: "Deleted!",
                                //     text: "Your file has been deleted.",
                                //     icon: "success"
                                // });
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
