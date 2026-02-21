@extends('master_layout.layout')

@section('title')
    Stock Report
@endsection


@section('page-title')
    Stock Report
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">
            <div style="display: flex; justify-content: flex-end;">

                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#PurchaseModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add Stock
                </button>
                <a href="{{ route('admin.manage_product') }}">
                    <button type="button" class="btn btn-outline-dark">
                        <i class="fa fa-eye mx-1"></i>
                        View Item
                    </button>
                </a>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#ItemModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add Item
                </button>
            </div>

            @include('Modals.info_modal')
            @include('Modals.Product.add_ProductModal')
            @include('Modals.Purchase.add_PurchaseModal')
            @include('Modals.Purchase.edit_PurchaseModal')


            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="userTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead
                                style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Product Code</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Product Quantity</th>
                                    <th class="text-center">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Purchase_produc_data as $Purchase_produc_datas)
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
                                                        data-id="{{ $Purchase_produc_datas->id }}"> <i
                                                            class="fa fa-edit mx-2"></i>
                                                        Edit</button>

                                                    {{-- <button id="delete_btn" class="dropdown-item" type="button"
                                                        data-id="{{ $Purchase_produc_datas->id }}">
                                                        <i class="glyphicon glyphicon-trash mx-2"></i>
                                                        Delete
                                                    </button> --}}
                                                    <button id="info" class="dropdown-item" type="button"
                                                        data-id="{{ $Purchase_produc_datas->info_id }}" data-toggle="modal"
                                                        data-target="#infoModal">
                                                        <i class="glyphicon glyphicon-info-sign mx-2"></i>
                                                        Info
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $Purchase_produc_datas->product_id ?? '-' }}</td>
                                        <td>{{ $Purchase_produc_datas->product_name ?? '-' }}</td>
                                        <td>{{ $Purchase_produc_datas->product_quantity ?? '-' }}</td>
                                        <td>{{ $Purchase_produc_datas->date ?? '-' }}</td>
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

        });
    </script>
@endsection
