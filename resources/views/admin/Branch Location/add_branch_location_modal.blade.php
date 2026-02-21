            {{-- ADD MODAL --}}
            <div class="modal fade" id="BranchLocationModal" tabindex="-1" role="dialog"
                aria-labelledby="BranchLocationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="BranchLocationModalLabel">Add Branch</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="AddBranchLocationForm" method="POST"
                            action="{{ route('admin.insert_branch_location') }}">
                            @csrf
                            {{-- <div class="modal-body">
                                <div class="form-group">
                                    <div class="row my-2">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="branch_location_name" class="col-form-label required_input">
                                                Branch Name</label>
                                            <input type="text" class="form-control" id="branch_location_name"
                                                placeholder="Enter Branch Name" name="branch_location_name" required>
                                            <p></p>
                                            <label for="address" class="col-form-label required_input">
                                                Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Enter Address" name="address" required>
                                            <p></p>
                                        </div>
                                        <label for="email" class="col-form-label required_input">
                                            Email</label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Enter Email" name="email" required>
                                        <p></p>
                                        <label for="mobile_number" class="col-form-label required_input">
                                            Mobile Number</label>
                                        <input type="text" class="form-control" id="mobile_number"
                                            placeholder="Enter Mobile Number" name="mobile_number" required>
                                        <p></p>
                                        <label for="location_link" class="col-form-label required_input">
                                            Location Link</label>
                                        <input type="text" class="form-control" id="location_link"
                                            placeholder="Enter Location Link" name="location_link" required>
                                        <p></p>
                                        <label for="working_time" class="col-form-label required_input">
                                            Working Time</label>
                                        <input type="text" class="form-control" id="working_time"
                                            placeholder="Enter Working Time" name="working_time" required>
                                        <p></p>
                                        <label for="is_head_branch" class="col-form-label required_input">
                                            Head Office</label>
                                        <input type="text" class="form-control" id="is_head_branch"
                                            placeholder="Enter Head Office" name="is_head_branch" required>

                                    </div>
                                </div>
                            </div> --}}


                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row my-2">
                                        <!-- Left Column -->
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="branch_location_name"
                                                class="col-form-label required_input">Branch Name</label>
                                            <input type="text" class="form-control" id="branch_location_name"
                                                placeholder="Enter Branch Name" name="branch_location_name" required>
                                            <p></p>

                                            <label for="address" class="col-form-label required_input">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Enter Address" name="address" required>
                                            <p></p>

                                            <label for="email" class="col-form-label required_input">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Email" name="email" required>
                                            <p></p>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="mobile_number" class="col-form-label required_input">Mobile
                                                Number</label>
                                            <input type="text" class="form-control" id="mobile_number"
                                                placeholder="Enter Mobile Number" name="mobile_number" required>
                                            <p></p>

                                            <label for="location_link" class="col-form-label">Location
                                                Link</label>
                                            <input type="text" class="form-control" id="location_link"
                                                placeholder="Enter Location Link" name="location_link">
                                            <p></p>

                                            <label for="working_time" class="col-form-label required_input">Working
                                                Time</label>
                                            <input type="text" class="form-control" id="working_time"
                                                value="Mon-Sat: 09:00 AM - 07:00 PM" placeholder="Enter Working Time"
                                                readonly>
                                            <p></p>


                                        </div>

                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="is_head_branch1" class="col-form-label required_input">Is
                                            Head</label>
                                        <select class="form-control select2" id="is_head_branch1" name="is_head_branch"
                                            style="width: 100%">
                                            <option value="1" @if (old('is_head_branch') == '1') selected @endif>Yes
                                            </option>
                                            <option value="2" @if (old('is_head_branch') == '2') selected @endif>No
                                            </option>
                                        </select>
                                    </div> --}}

                                    <div class="mb-3" id="head_branch_field">
                                        <label for="is_head_branch1" class="col-form-label required_input">Is
                                            Head</label>
                                        <select class="form-control select2" id="is_head_branch1" name="is_head_branch"
                                            style="width: 100%">
                                            <option value="" disabled selected>Select</option> <!-- ✅ fixed -->
                                            <option value="1" @if (old('is_head_branch') == '1') selected @endif>Yes
                                            </option>
                                            <option value="2" @if (old('is_head_branch') == '2') selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    var addForm = $("#AddBranchLocationForm");
                    addForm.validate({
                        errorElement: 'span',
                        errorClass: 'error-message',
                        submitHandler: function(form) {
                            $(form).submit();
                        }
                    });

                    $('#BranchLocationModal').on('shown.bs.modal', function() {
                        $.ajax({
                            url: '{{ route('admin.manage_branch_location') }}',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                let head_branch_count = response.head_branch_count ?? 0;

                                if (head_branch_count > 0) {
                                    $('#head_branch_field').hide();
                                } else {
                                    $('#head_branch_field').show();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching branch info:', error);
                            }
                        });
                    });


                });
            </script>
