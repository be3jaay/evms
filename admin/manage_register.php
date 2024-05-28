<?php include 'db_connect.php' ?>

<?php
if(isset($_GET['id'])){
    $booking = $conn->query("SELECT * from audience where id = ".$_GET['id']);
    foreach($booking->fetch_array() as $k => $v){
        $$k = $v;
    }
}
?>

<div class="container-fluid">
    <form action="" id="manage-register">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        <div class="form-group">
            <label for="" class="control-label">Event</label>
            <select name="event_id" id="" class="custom-select select2" readonly>
                <option></option>
                <?php 
                $event = $conn->query("SELECT * FROM events order by event asc");
                while($row=$event->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($event_id) && $event_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['event']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Full Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name :'' ?>" readonly required>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="2" required="" name="address" class="form-control" readonly><?php echo isset($address) ? $address :'' ?></textarea>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email :'' ?>" readonly required>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Contact #</label>
            <input type="text" class="form-control" name="contact" value="<?php echo isset($contact) ? $contact :'' ?>" readonly required>
        </div>
        
        <div class="form-group">
            <label for="" class="control-label">Status</label>
            <select name="status" id="" class="custom-select">
                <option value="0" <?php echo isset($status) && $status == 0 ? "selected" : '' ?>>For Verification</option>
                <option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ?>>Confirmed</option>
                <option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ?>>Cancelled</option>
            </select>
        </div>
        <!-- Add a button to toggle between editable and readonly modes -->
       
    </form>
</div>

<script>
    $('#toggle-editable').on('click', function(){
        // Toggle readonly attribute for all form elements except payment_status and status
        $('#manage-register :input:not([name="payment_status"], [name="status"])').prop('readonly', function(i, readonly) {
            return !readonly;
        });
    });

    $('#manage-register').submit(function(e){
        if ($('#manage-register :input:not([name="payment_status"], [name="status"])').prop('readonly')) {
            // Form is in readonly mode, prevent submission
            e.preventDefault();
            alert('Form is in readonly mode. Cannot submit.');
        } else {
            // Form is editable, proceed with submission
            start_load();
            $.ajax({
                url:'ajax.php?action=save_register',
                method:"POST",
                data:$(this).serialize(),
                success:function(resp){
                    if(resp == 1){
                        alert_toast("Audience Registration successfully updated","success")
                        setTimeout(function(){
                            location.reload()
                        },1500)
                    }
                }
            });
        }
    });
</script>
