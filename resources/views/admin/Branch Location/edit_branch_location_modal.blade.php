{{-- EDIT BRANCH MODAL --}}
<div class="modal fade" id="EditBranchLocationModal" tabindex="-1" role="dialog"
    aria-labelledby="EditBranchLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditBranchLocationModalLabel">Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="EditBranchLocationForm" method="POST" action="{{ route('admin.update_branch_location') }}">
                @csrf
                <input type="hidden" id="edit_branch_id" name="id">

                <div class="modal-body">
                    <div class="form-group">
                        <div class="row my-2">
                            <!-- Left Column -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="branch_location_name" class="col-form-label required_input">Branch
                                    Name</label>
                                <input type="text" class="form-control" id="edit_branch_location_name"
                                    name="branch_location_name" placeholder="Enter Branch Name" required>
                                <p></p>

                                <label for="edit_address" class="col-form-label required_input">Address</label>
                                <input type="text" class="form-control" id="edit_address" name="address"
                                    placeholder="Enter Address" required>
                                <p></p>

                                <label for="edit_email" class="col-form-label required_input">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email"
                                    placeholder="Enter Email" required>
                                <p></p>
                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="edit_mobile_number" class="col-form-label required_input">Mobile
                                    Number</label>
                                <input type="text" class="form-control" id="edit_mobile_number" name="mobile_number"
                                    placeholder="Enter Mobile Number" required>
                                <p></p>

                                <label for="edit_location_link" class="col-form-label">Location
                                    Link</label>
                                <input type="url" class="form-control" id="edit_location_link" name="location_link"
                                    placeholder="Enter Location Link">
                                <p></p>

                                <label for="edit_working_time" class="col-form-label required_input">Working
                                    Time</label>
                                <input type="text" class="form-control" id="edit_working_time" name="working_time"
                                    value="Mon-Sat: 09:00 AM - 07:00 PM" placeholder="Enter Working Time" readonly>
                                <p></p>
                            </div>
                        </div>

                        <div class="mb-3" id="is_head_branch_wrapper">
                            <label for="edit_is_head_branch" class="col-form-label required_input">Is Head</label>
                            <select class="form-control select2" id="edit_is_head_branch" name="is_head_branch"
                                style="width: 100%">
                                <option value="" disabled selected>Select</option> <!-- ✅ fixed -->
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jQuery Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // 🔹 When Edit Button Clicked
        $('.table').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.edit_branch_location', ['id' => ':id']) }}'.replace(':id',
                    id),
                type: 'GET',
                success: function(response) {
                    let data = response.original.data;
                    let headCount = response.original.head_branch_count;

                    // Fill form fields
                    $('#edit_branch_id').val(data.id);
                    $('#edit_branch_location_name').val(data.branch_location_name);
                    $('#edit_address').val(data.address);
                    $('#edit_email').val(data.email);
                    $('#edit_mobile_number').val(data.mobile_number);
                    $('#edit_location_link').val(data.location_link);
                    $('#edit_working_time').val(data.working_time);
                    $('#edit_is_head_branch').val(data.is_head_branch).trigger('change');

                    // Show or Hide "Is Head Branch" field
                    if (headCount > 0 && data.is_head_branch != 1) {
                        $('#is_head_branch_wrapper')
                            .hide(); // Hide if one head exists and this is not the head branch
                    } else {
                        $('#is_head_branch_wrapper')
                            .show(); // Show if no head exists or this is the head branch
                    }

                    $('#EditBranchLocationModal').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // 🔹 Submit Update Form via AJAX
        // $('#EditBranchLocationForm').on('submit', function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         url: $(this).attr('action'),
        //         method: 'POST',
        //         data: $(this).serialize(),
        //         success: function(response) {
        //             alert(response)
        //             if (response.success) {
        //                 alert(response.message);
        //                 $('#EditBranchLocationModal').modal('hide');
        //                 location.reload();
        //             } else {
        //                 alert(response.message);
        //             }
        //         },
        //         error: function(xhr) {
        //             console.log(xhr.responseText);
        //         }
        //     });
        // });



        // 🔹 Reset Form When Modal Closes
        $(".close, [data-dismiss='modal']").click(function() {
            $('#EditBranchLocationForm')[0].reset();
            $('#is_head_branch_wrapper').show(); // Reset to visible
        });
    });
</script>
