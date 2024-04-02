<?php include 'db_connect.php' ?>

<?php
if(isset($_GET['id'])){
$booking = $conn->query("SELECT * from venue_booking where id = ".$_GET['id']);
foreach($booking->fetch_array() as $k => $v){
    $$k = $v;
}
}
?>
<style>
    .truncate{
        border: 2px solid var(--primary);
        padding: 20px;
        font-size: 1rem;
        border-radius: 8px;
    }
    .venueSelected{
        border: 2px solid var(--primary);
        padding: 12px 30px;
        font-size: 1rem;
        border-radius: 8px;
    }
</style>
<div class="container-fluid">
    <form action="" id="manage-book">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        <div class="form-group">
            <label for="" class="control-label">Venue</label>
            <select name="venue_id" id="" class="custom-select select2" readonly>
                <option></option>
                <?php 
                $venue = $conn->query("SELECT * FROM venue order by venue asc");
                while($row=$venue->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($venue_id) && $venue_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['venue']) ?></option>
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
            <label for="" class="control-label">Duration</label>
            <input type="text" class="form-control" name="duration" value="<?php echo isset($duration) ? $duration :'' ?>" readonly required>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Desired Event Schedule</label>
            <input type="text" class="form-control datetimepicker" name="schedule" value="<?php echo isset($datetime) ? date("Y-m-d H:i",strtotime($datetime)) :'' ?>" readonly required>
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
        // Toggle readonly attribute for all form elements except status
        $('#manage-book :input:not([name="status"])').prop('readonly', function(i, readonly) {
            return !readonly;
        });
    });

    $('#manage-book').submit(function(e){
        if ($('#manage-book :input:not([name="status"])').prop('readonly')) {
            // Form is in readonly mode, prevent submission
            e.preventDefault();
            alert('Form is in readonly mode. Cannot submit.');
        } else {
            // Form is editable, proceed with submission
            start_load();
            $.ajax({
                url:'ajax.php?action=save_book',
                method:"POST",
                data:$(this).serialize(),
                success:function(resp){
                    if(resp == 1){
                        alert_toast("Book successfully updated","success")
                        setTimeout(function(){
                            location.reload()
                        },1500)
                    }
                }
            });
        }
    });
</script>