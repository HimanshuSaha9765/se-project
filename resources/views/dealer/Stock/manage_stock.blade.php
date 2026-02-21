@extends('dealer.dealer_layout')

@section('title')
    Stock
@endsection


@section('page-title')
    Stock
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_content">
            <div style="display: flex; justify-content: flex-end;">
                <a href="{{ route('employee.employee_manage_purchase_producs') }}">
                    <button type="button" class="btn btn-outline-dark">
                        <i class="fa fa-file mx-1"></i>
                        Stock Report
                    </button>
                </a>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#PurchaseModal"
                    data-whatever="@mdo">
                    <i class="fa fa-plus mx-1"></i>
                    Add Stock
                </button>
            </div>
            @include('Modals.Product.add_ProductModal')
            @include('Modals.Purchase.add_PurchaseModal')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive" style="padding: 1rem;">
                        <table id="userTable" class="table table-bordered  table-hover text-nowrap text-center"
                            style="width:100%">
                            <thead
                                style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                <tr>
                                    <th class="text-center">Product Code</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Total Stock</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Stock_data as $Stock_datas)
                                    <tr>
                                        <td>{{ $Stock_datas->product_id ?? '-' }}</td>
                                        <td>{{ $Stock_datas->product_name ?? '-' }}</td>
                                        @if ($Stock_datas->total_remain_quantity <= 0)
                                            <td>
                                                <button type="button" class="btn"
                                                    style="background-color: rgba(255, 0, 0, 0.54) !important">
                                                    {{ $Stock_datas->total_remain_quantity ?? '-' }}
                                                </button>
                                            </td>
                                        @elseif($Stock_datas->total_remain_quantity <= 5)
                                            <td>
                                                <button type="button" class="btn"
                                                    style="background-color: rgba(255, 249, 0, 0.54) !important">
                                                    {{ $Stock_datas->total_remain_quantity ?? '-' }}
                                                </button>
                                            </td>
                                        @else
                                            <td>{{ $Stock_datas->total_remain_quantity ?? '-' }}</td>
                                        @endif
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
                            if (colIdx == 3) {
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

        });
    </script>
@endsection
