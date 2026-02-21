<div class="modal fade" id="ProductEditModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalEditLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ItemTableModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ValidationForm" action="{{ route('admin.update_product') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="product_id" class="col-form-label ">Product Number</label>
                        <input type="text" class="form-control" name="product_id" id="product-id1" readonly>
                        <span id="arr_msg_product_id" style="color:red">
                            @error('product_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="product" class="col-form-label required_input">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="product-name1"
                            placeholder="Enter product Name" required>
                        <span id="arr_msg_product_name" style="color:red">
                            @error('product_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="col-form-label">Unit</label>
                        <input type="text" class="form-control" name="unit" id="unit"
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
            $.ajax({
                url: '{{ route('admin.edit_product', ['id' => ':id']) }}'
                    .replace(':id', id),
                type: "GET",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#product-id1').val(data.product_id);
                    $('#product-name1').val(data.product_name);
                    $('#unit').val(data.unit);
                    $('#ProductEditModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
