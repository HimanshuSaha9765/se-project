@extends('master_layout.layout')

@section('page-title')
    Reference
@endsection


@section('title')
    Reference
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">
            <div style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#referencesModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add
                </button>
            </div>

            {{-- ADD MODAL --}}
            <div class="modal fade" id="referencesModal" tabindex="-1" role="dialog" aria-labelledby="referencesModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referencesTableModalLabel">Add References</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="AddreferencesForm" method="POST" action="{{ route('admin.insert_reference') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="city_name1" class="required_input">Reference By</label>
                                    <select class="form-control select2" id="city_name1" name="city_name"
                                        style="width: 100%" required>
                                        <option value="" disabled selected></option>
                                        @foreach ($dealer_city_data as $dealer_city_name)
                                            <option value="{{ $dealer_city_name->city_name }}"
                                                @if (old('city_name') == '{{ $dealer_city_name->city_name }}') selected @endif>
                                                {{ $dealer_city_name->city_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="name" class="col-form-label required_input">
                                        Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_assign" class="col-form-label required_input">
                                        Email Assign</label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email_assign"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- EDIT MODAL --}}
            <div class="modal fade" id="referencesEditModal" tabindex="-1" role="dialog"
                aria-labelledby="referencesModalEditLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referencesTableModalLabel">Edit References</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="EditreferencesForm" method="POST" action="{{ route('admin.update_reference') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group" style="display: none">
                                    <input type="text" class="form-control" id="id" placeholder="Enter id"
                                        name="id" readonly>
                                </div>

                                <label for="city_name_update1" class="required_input">Reference By</label>
                                <select class="form-control select2" id="city_name_update1" name="city_name_update"
                                    style="width: 100%" required>
                                    <option value="" disabled selected></option>
                                    @foreach ($dealer_city_data as $dealer_city_name)
                                        <option value="{{ $dealer_city_name->city_name }}"
                                            @if (old('city_name_update') == '{{ $dealer_city_name->city_name }}') selected @endif>
                                            {{ $dealer_city_name->city_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="name" class="col-form-label required_input">
                                        Name</label>
                                    <input type="text" class="form-control" id="EditreferencesName"
                                        placeholder="Enter Name" name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email_assign" class="col-form-label required_input">
                                        Email Assign</label>
                                    <input type="text" class="form-control" id="email_assign"
                                        placeholder="Enter Email" name="email_assign" required>
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

            {{-- *INFO MODAL --}}
            @include('Modals.info_modal')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="referencesTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead style="background: white;text-align: center; align-items: center;">
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Dealer City</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($referencess as $references)
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
                                                        data-id="{{ $references->id }}"> <i class="fa fa-edit mx-2"></i>
                                                        Edit</button>
                                                    <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $references->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button>
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $references->info_id }}" data-toggle="modal"
                                                        data-target="#infoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $references->city_name ?? '-' }}</td>
                                        <td>{{ $references->name ?? '-' }}</td>
                                        <td>{{ $references->email_assign ?? '-' }}</td>
                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($references->status == 'active')
                                                    <input type="checkbox" class="toggle-status" checked
                                                        data-toggle="toggle" data-onlabel="Active"
                                                        data-references-id="{{ $references->id }}"
                                                        data-offlabel="Inactive" data-onstyle="success"
                                                        data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status" data-toggle="toggle"
                                                        data-onlabel="Active" data-references-id="{{ $references->id }}"
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
                    title: '{{ session('error') }}',
                })
            });
        </script>
    @endif

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="{{ URL::to('/') }}/js/select2.min.js"></script> --}}
    <!-- Include jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        $(document).ready(function() {

            $('#referencesTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#referencesTable thead');

            var table = $('#referencesTable').DataTable({
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
                            if (colIdx == 0 || colIdx == 4) {
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


            var addForm = $("#AddreferencesForm");
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
                    url: '{{ route('admin.edit_reference', ['id' => ':id']) }}'.replace(':id', id),
                    type: "GET",
                    success: function(data) {
                        $('#id').val(data.id);

                        // Fetch the city data via another AJAX call
                        $.ajax({
                            url: '{{ route('admin.getCity') }}', // Update this route if necessary
                            type: "GET",
                            success: function(cities) {
                                var cityOptions =
                                    '<option value="" disabled selected></option>';

                                // Assuming 'cities' is an array of objects with 'city_name'
                                cities.forEach(function(city) {
                                    cityOptions += '<option value="' + city
                                        .city_name + '"' +
                                        (city.city_name === data.city_name ?
                                            ' selected' : '') + '>' +
                                        city.city_name + '</option>';
                                });

                                $('#city_name_update1').html(cityOptions);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });

                        $('#EditreferencesName').val(data.name);
                        $('#email_assign').val(data.email_assign);
                        $('#referencesEditModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // $('.table').on('click', '.edit-btn', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     $.ajax({
            //         url: '{{ route('admin.edit_reference', ['id' => ':id']) }}'
            //             .replace(':id', id),
            //         type: "GET",
            //         success: function(data) {
            //             $('#id').val(data.id);
            //             $('#EditreferencesName').val(data.name);
            //             $('#email_assign').val(data.email_assign);
            //             $('#referencesEditModal').modal('show');
            //         },
            //         error: function(xhr, status, error) {
            //             console.log(xhr.responseText);
            //         }
            //     });
            // });

            var editForm = $("#EditreferencesForm");

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
                var referencesId = $(this).data("references-id");
                console.log(referencesId);
                var status = $(this).prop('checked') ? 'active' : 'inactive';
                var toggleElement = $(this);

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.update_reference_status', ['id' => ':id', 'status' => ':status']) }}'
                        .replace(':id', referencesId)
                        .replace(':status', status),
                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 160);
                        console.log(response);
                        // Remove the line below if you're not using bootstrap toggle
                        toggleElement.bootstrapToggle('destroy').bootstrapToggle();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            //* delete Confirmation
            $(document).on('click', '#delete_btn', function() {
                var referencesId = $(this).data("id");
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
                            url: '{{ route('admin.delete_reference', ['id' => ':id']) }}'
                                .replace(':id', referencesId),
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

            $('.select2').select2();
        });
    </script>
@endsection
