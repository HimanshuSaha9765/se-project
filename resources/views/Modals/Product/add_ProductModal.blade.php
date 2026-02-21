<div class="modal fade" id="ItemModal" tabindex="-1" role="dialog" aria-labelledby="ItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ItemTableModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ValidationForm" action="{{ route('admin.insert_product') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id" class="col-form-label ">Product Number</label>
                        <input type="text" class="form-control" name="product_id" id="product_id1"
                            value="{{ $product_code }}" readonly>
                        <span id="arr_msg_product_id" style="color:red">
                            @error('product_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="product" class="col-form-label required_input">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="product_name1"
                            placeholder="Enter product Name" required>
                        <span id="arr_msg_product_name" style="color:red">
                            @error('product_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="col-form-label">Unit</label>
                        <input type="text" class="form-control" name="unit" id="unit1"
                            placeholder="Enter Unit">
                        <span id="crr_msg_unit" style="color:red">
                            @error('unit')
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
<script>
    //* Info 
    $(document).ready(function() {

        $(".close, [data-dismiss='modal']").click(function() {
            addForm.validate().resetForm();
        });

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
