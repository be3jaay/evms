<?php include 'db_connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}
h1, h4{
    color: #000;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
</style>
    <title>Document</title>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
<script type="text/javascript">
   (function(){
      emailjs.init("n3-7PxCJlKZogpzPN");
   })();
</script>
    </script>
</head>
<body>
    
</body>
</html>

<div class="containe-fluid ">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body ">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>	
                    <div class="container-fluid border  my-3 bg-white">
                    <div class="row">
                        <div class="col-md-6 p-5 text-white">
                        <h1><strong>Barangay Mayondon</strong></h1>
                        <h4>
                            A contact form for residents in our barangay.
                        </h4>
                        </div>
                        <div class="col-md-6 border-left py-3 text-black">
                        <h1>A Contact Form For Residence</h1>
                        <div class="form-group">
                            <h5 for="name">Name</h5>
                            <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Enter name"
                            />
                        </div>
                        <div class="form-group">
                            <h5 for="email">Email</h5>
                            <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Resident's Email"
                            />
                        </div>
                        <div class="form-group">
                            <h5 for="message">Message</h5>
                            <textarea class="form-control" id="message" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary" onclick="sendMail()">Submit</button>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>      			
        </div>
    </div>
</div>
<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }

    function sendMail() {
    var params = {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      message: document.getElementById("message").value,
    };
  
    const serviceID = "service_595tzxk";
    const templateID = "template_j8k4l0x";
  
      emailjs.send(serviceID, templateID, params)
      .then(res=>{
          document.getElementById("name").value = "";
          document.getElementById("email").value = "";
          document.getElementById("message").value = "";
          console.log(res);
          alert("Your message sent successfully!!")
  
      })
      .catch(err=>console.log(err));
  
  }
</script>
