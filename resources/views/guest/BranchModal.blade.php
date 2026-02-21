<!-- Branch Details Modal -->
<div class="modal fade" id="branchModal" tabindex="-1" aria-labelledby="branchModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="branchModalLabel">Branch Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modal-name"></span></p>
                <p><strong>Address:</strong> <span id="modal-address"></span></p>
                <p><strong>Email:</strong> <span id="modal-email"></span></p>
                <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                <p><strong>Timing:</strong> <span id="modal-timing"></span></p>
                <p><strong>Closed:</strong> <span id="modal-phone">Sunday</span></p>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // 🔹 When "View details" button is clicked
        $('.view-branch-btn').click(function() {
            var branchId = $(this).data('id');

            $.ajax({
                url: '{{ route('guest.branch.data', ':id') }}'.replace(':id', branchId),
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    // Fill modal fields
                    $('#modal-name').text(data.branch_location_name);
                    $('#modal-address').text(data.address);
                    $('#modal-email').text(data.email ?? 'N/A');
                    $('#modal-phone').text(data.mobile_number ?? 'N/A');
                    $('#modal-timing').text(data.working_time ?? 'N/A');

                    // ✅ Bootstrap handles aria-hidden automatically
                    $('#branchModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Failed to fetch branch data.');
                }
            });
        });

        // 🔹 Optional: Reset modal content on close
        $('#branchModal').on('hidden.bs.modal', function() {
            $('#modal-name, #modal-address, #modal-email, #modal-phone, #modal-timing').text('');
        });
    });
</script>
