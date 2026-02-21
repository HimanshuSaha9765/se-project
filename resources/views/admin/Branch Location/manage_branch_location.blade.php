@extends('master_layout.layout')

@section('page-title')
    Branch Location
@endsection


@section('title')
    Branch Location
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">
            <div style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#BranchLocationModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add
                </button>
            </div>

            {{-- * Add And Update Modal --}}
            @include('admin.Branch Location.add_branch_location_modal')
            @include('admin.Branch Location.edit_branch_location_modal')

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
                                    <th class="text-center">Branch Name</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Timing</th>
                                    <th class="text-center">Location URL</th>
                                    <th class="text-center">Branch Type</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Branch_datas as $Branch_data)
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
                                                        data-id="{{ $Branch_data->id }}"> <i class="fa fa-edit mx-2"></i>
                                                        Edit</button>
                                                    <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $Branch_data->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button>
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $Branch_data->info_id }}" data-toggle="modal"
                                                        data-target="#infoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $Branch_data->branch_location_name ?? '-' }}</td>
                                        <td>{{ $Branch_data->address ?? '-' }}</td>
                                        <td>{{ $Branch_data->mobile_number ?? '-' }}</td>
                                        <td>{{ $Branch_data->email ?? '-' }}</td>
                                        <td>{{ $Branch_data->working_time ?? '-' }}</td>
                                        <td>{{ $Branch_data->location_link ?? '-' }}</td>
                                        <td>{{ $Branch_data->is_head_branch ?? '-' }}</td>
                                        <td>
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                @if ($Branch_data->status == 'active')
                                                    <input type="checkbox" class="toggle-status" checked
                                                        data-toggle="toggle" data-onlabel="Active"
                                                        data-branchlocation-id="{{ $Branch_data->id }}" data-offlabel="Inactive"
                                                        data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                @else
                                                    <input type="checkbox" class="toggle-status" data-toggle="toggle"
                                                        data-onlabel="Active" data-branchlocation-id="{{ $Branch_data->id }}"
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

            $(document).on('change', '.toggle-status', function() {
                var branchLocationId = $(this).data("branchlocation-id");
                var status = $(this).prop('checked') ? 'active' : 'inactive';
                var toggleElement = $(this);

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.update_branch_location_status', ['id' => ':id', 'status' => ':status']) }}'
                        .replace(':id', branchLocationId)
                        .replace(':status', status),
                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 160);
                        // console.log(response);
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
                            url: '{{ route('admin.delete_branch_location', ['id' => ':id']) }}'
                                .replace(':id', referencesId),
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

        });
    </script>
@endsection
