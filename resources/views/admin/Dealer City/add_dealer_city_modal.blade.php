            {{-- ADD MODAL --}}
            <div class="modal fade" id="DealerCityModal" tabindex="-1" role="dialog" aria-labelledby="DealerCityModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DealerCityTableModalLabel">Add City</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="AddDealerCityForm" method="POST" action="{{ route('admin.insert_dealer_city') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="city_name" class="col-form-label required_input">
                                        City</label>
                                    <input type="text" class="form-control" id="city_name" placeholder="Enter City"
                                        name="city_name" required>
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
                    var addForm = $("#AddDealerCityForm");
                    addForm.validate({
                        errorElement: 'span',
                        errorClass: 'error-message',
                        submitHandler: function(form) {
                            $(form).submit();
                        }
                    });
                });
            </script>
