<div class="modal fade" id="PurchaseModal" tabindex="-1" role="dialog" aria-labelledby="PurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PurchaseTableModalLabel">Add Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ValidationForm" action="{{ route('admin.insert_purchase_producs') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product-name" class="col-form-label required_input">Product Name</label>
                        <select class="form-control select2" id="product_id" name="product_id"
                            style="width: 100%" required>
                            @foreach ($produc_data as $produc_datas)
                                <option value="{{ $produc_datas->product_id }}"
                                    @if (old('product_id') == '{{ $produc_datas->product_name }}') selected @endif>
                                    {{ $produc_datas->product_name }}  {{ $produc_datas->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product" class="col-form-label required_input">Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity" id="product_quantity1"
                            placeholder="Enter product quantity" required>
                        <span id="arr_msg_product_quantity" style="color:red">
                            @error('product_quantity')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="col-form-label required_input">Date</label>
                        <input type="date" class="form-control" name="date" id="date1"
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
        $('.select2').select2();

        var validation = $("#ValidationForm");
        validation.validate({
            errorElement: 'span',
            errorClass: 'error-message',
            submitHandler: function(form) {
                $(form).submit();
            }
        });
    });
</script>
