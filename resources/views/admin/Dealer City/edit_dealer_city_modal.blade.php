            {{-- ADD MODAL --}}
            <div class="modal fade" id="EditDealerCityModal" tabindex="-1" role="dialog" aria-labelledby="EditDealerCityModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DealerCityTableModalLabel">Update City</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <form id="AddDealerCityForm" method="POST" action="{{ route('admin.edit_dealer_city') }}"> --}}
                        <form id="EditDealerCityForm" method="POST" action="{{ route('admin.update_dealer_city') }}">
                            @csrf
                            <input type="text" hidden class="form-control" id="id_fatch" placeholder="Enter City"
                                name="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="city_name" class="col-form-label required_input">
                                        City</label>
                                    <input type="text" class="form-control" id="city_name_fatch" placeholder="Enter City"
                                        name="city_name" required>
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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.table').on('click', '.edit-btn', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        console.log(id);
                        $.ajax({
                            url: '{{ route('admin.edit_dealer_city', ['id' => ':id']) }}'
                                .replace(':id', id),
                            type: "GET",
                            success: function(data) {
                                console.log(data.status);
                                $('#id_fatch').val(data.id);
                                $('#city_name_fatch').val(data.city_name);
                                $('#EditDealerCityModal').modal('show');
                            },
                            error: function(xhr, status, error) {
                                // console.log(xhr.responseText);
                            }
                        });
                    });

                    $(".close, [data-dismiss='modal']").click(function() {
                        editForm.validate().resetForm();
                    });

                    var addForm = $("#EditDealerCityForm");
                    addForm.validate({
                        errorElement: 'span',
                        errorClass: 'error-message',
                        submitHandler: function(form) {
                            $(form).submit();
                        }
                    });
                });
            </script>
