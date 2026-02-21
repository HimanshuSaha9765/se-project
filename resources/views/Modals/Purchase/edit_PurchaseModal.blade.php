<div class="modal fade" id="EditPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="PurchaseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PurchaseTableModalLabel">Add Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ValidationForm" action="{{ route('admin.update_purchase_producs') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="product-id" name="product_id">

                    {{-- <div class="form-group">
                        <label for="inverter-name" class="col-form-label required_input">Product Name</label>
                        <select class="form-control select2" name="product_id" id="product-id" style="width: 100%"
                            required>
                            @foreach ($produc_data as $produc_datas)
                                <option value="{{ $produc_datas->product_id }}"
                                    @if (old('product_id') == '{{ $produc_datas->product_name }}')  @endif>
                                    {{ $produc_datas->product_name }} {{ $produc_datas->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label for="product" class="col-form-label required_input">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="product-name"
                            placeholder="Enter product quantity" readonly>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="product" class="col-form-label required_input">Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity" id="product-quantity1"
                            placeholder="Enter product quantity" required>
                        <span id="arr_msg_product_quantity" style="color:red">
                            @error('product_quantity')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="col-form-label required_input">Date</label>
                        <input type="date" class="form-control" name="date" id="date-1"
                            placeholder="Enter date" required>
                        <span id="crr_msg_date" style="color:red">
                            @error('date')
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

<!-- jQuery -->
<script src="{{ URL::to('/') }}/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    //* Info 
    $(document).ready(function() {
        var validation = $("#ValidationForm");
        validation.validate({
            errorElement: 'span',
            errorClass: 'error-message',
            submitHandler: function(form) {
                $(form).submit();
            }
        });

        
        
        $('.table').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var product_data = {!! $produc_data !!};
            
            $.ajax({
                url: '{{ route('admin.edit_purchase_producs', ['id' => ':id']) }}'
                    .replace(':id', id),
                type: "GET",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#product-id').val(data.product_id);

                    // var option =
                    //     `<option value="${data.product_id}">${data.product_name}</option>`;

                    // // Loop through the product_data array and add options
                    // for (var index = 0; index < product_data.length; index++) {
                    //     if (product_data[index].product_id !== data.product_id) {
                    //         option +=
                    //             `<option value="${product_data[index].product_id}">${product_data[index].product_name}</option>`;
                    //     }
                    // }

                    // Update the dropdown with the generated options
                    // $('#product-id').html(option);
                    $('#product-name').val(data.product_name);
                    $('#product-quantity1').val(data.product_quantity);
                    $('#date-1').val(data.date);
                    $('#EditPurchaseModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
