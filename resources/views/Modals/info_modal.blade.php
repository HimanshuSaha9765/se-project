            {{-- INFO MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="structureTableModalLabel">Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row table-responsive">

                                <table class="table table-bordered  table-hover text-nowrap text-center">
                                    <thead
                                        style="background: white;text-align: center; align-items: center;text-transform: capitalize;">
                                        <tr>
                                            <th>Log info</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Ip Address</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr rowspan="2">
                                            <th>Created Log</th>
                                            <th id="info-email"></th>
                                            <th id="info-name"></th>
                                            <th id="info-ip"></th>
                                            <th id="info-date"></th>
                                            <th id="info-time"></th>
                                        </tr>

                                        <tr rowspan="2">
                                            <th>Updated Log</th>
                                            <th id="info-email-update"></th>
                                            <th id="info-name-update"></th>
                                            <th id="info-ip-update"></th>
                                            <th id="info-date-update"></th>
                                            <th id="info-time-update"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-outline-secondary cl" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button id="info" class="dropdown-item" type="button" data-id="{{ $payments->info_id }}"
                data-toggle="modal" data-target="#infoModal">
                <i class="glyphicon glyphicon-info-sign mx-2"></i>
                Info
            </button> --}}

            <!--* jQuery -->
            <script src="{{ URL::to('/') }}/vendors/jquery/dist/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $(document).on('click', '#info', function() {
                        var id = $(this).data('id');
                        // console.log(id);
                        $.ajax({
                            url: "{{ route('admin.info_data') }}",
                            type: "POST",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                // console.log(response.created_log);
                                var createdLog = response.created_log;
                                var updatedLog = response.updated_log;

                                if (createdLog) {
                                    var created_date = new Date(createdLog.created_date);

                                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                    ];

                                    var date = created_date.getDate() + '-' + monthNames[created_date
                                            .getMonth()] +
                                        '-' + created_date.getFullYear();

                                    var time = created_date.toLocaleTimeString('en-US', {
                                        hour12: true,
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit'
                                    });

                                    $('#info-email').text(createdLog.created_email ?? '-');
                                    $('#info-name').text(createdLog.created_name ?? '-');
                                    $('#info-ip').text(createdLog.created_ip ?? '-');
                                    $('#info-date').text(date ?? '-');
                                    $('#info-time').text(time ?? '-');
                                } else {
                                    $('#info-email').text('-');
                                    $('#info-name').text('-');
                                    $('#info-ip').text('-');
                                    $('#info-date').text('-');
                                    $('#info-time').text('-');
                                }

                                if (updatedLog) {
                                    var updated_date = new Date(updatedLog.updated_date);

                                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                    ];

                                    var date1 = updated_date.getDate() + '-' + monthNames[updated_date
                                            .getMonth()] +
                                        '-' + updated_date.getFullYear();

                                    var time1 = updated_date.toLocaleTimeString('en-US', {
                                        hour12: true,
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit'
                                    });

                                    $('#info-email-update').text(updatedLog.updated_email ?? '-');
                                    $('#info-name-update').text(updatedLog.updated_name ?? '-');
                                    $('#info-ip-update').text(updatedLog.updated_ip ?? '-');


                                    if (date1 === "1-Jan-1970" && time1 === "05:30:00 AM") {
                                        $('#info-date-update').text('-');
                                        $('#info-time-update').text('-');
                                    } else {
                                        $('#info-date-update').text(date1 || '-');
                                        $('#info-time-update').text(time1 || '-');
                                    }
                                } else {
                                    $('#email1').text('-');
                                    $('#name1').text('-');
                                    $('#ip1').text('-');
                                    if (date1 === "1-Jan-1970" && time1 === "05:30:00 AM") {
                                        $('#info-date-update').text('-');
                                        $('#info-time-update').text('-');
                                    } else {
                                        $('#date1').text(date1 || '-');
                                        $('#info-time-update').text(time1 || '-');
                                    }
                                }

                                $('#modal-info').modal('show');
                            },
                            error: function(error) {
                                alert(`Please try again, There's a server error !!`);
                                location.reload()
                            }
                        });
                    });
                });
            </script>
