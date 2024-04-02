

<div class="container-fluid">
	<form action="" id="manage-book">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<input type="hidden" name="venue_id" value="<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] :'' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" class="form-control" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Duration</label>
			<input type="text" class="form-control" name="duration"  value="<?php echo isset($duration) ? $duration :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Desired Event Schedule</label>
			<input type="text" class="form-control datetimepicker" name="schedule"  value="<?php echo isset($schedule) ? $schedule :'' ?>" required>
		</div>
	</form>
</div>
<script>
$('.datetimepicker').datetimepicker({
    format: 'Y/m/d H:i',
    startDate: '+3d'
});

$('#manage-book').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    start_load();
    $('#msg').html('');

    $.ajax({
        url: 'admin/ajax.php?action=save_book',
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            try {
                resp = JSON.parse(resp); // Parse the JSON response
                if (resp.error) {
    // Display the error message
					$('#msg').html('<div class="alert alert-danger">' + resp.error + '</div>');
				} else if (resp.response == 1) {
					alert('We will contact you soon for the verification of your book request. Thank you')
					
				} else if (resp.response === 'already_booked') {
					// Handle the case where the schedule is already booked
					alert('The schedule has already been booked.');
				} else {
					// Handle other types of responses or errors
					$('#msg').html('<div class="alert alert-danger">An error occurred: ' + resp.response + '</div>');
					
}
            } catch (e) {
                // Handle parsing error
                $('#msg').html('<div class="alert alert-danger">An error occurred: ' + e.message + '</div>');
            } finally {
                end_load(); // Ensure that the loading indicator is always stopped
            }
        },
        error: function (xhr, status, error) {
            // Display an error message in case of an AJAX error
            $('#msg').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
            end_load(); // Ensure that the loading indicator is stopped in case of an error
        }
    });
});




</script>

