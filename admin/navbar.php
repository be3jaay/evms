
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		height: calc(100%);
    position: fixed;
    z-index: 99;
    left: 0;
    width: 250px;
	background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(247,249,3,1) 0%, rgba(0,42,251,1) 0%, rgba(72,47,215,1) 100%, rgba(51,85,212,1) 100%, rgba(63,94,203,1) 100%, rgba(143,159,142,1) 100%);
	}
	a.nav-item {
    position: relative;
    display: block;
    padding: 2.3rem 1.5rem;
    margin-bottom: -1px;
    color: #fff;
	background: transparent;
	border: none;
    font-weight: 600;
}
.sidebar-list span{
	margin-right:20px;
}
</style>

<nav id="sidebar" class='mx-lt-5 bg-primary' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=booking" class="nav-item nav-booking"><span class='icon-field'><i class="fa fa-th-list"></i></span> Venue Book List</a>
				<a href="index.php?page=audience" class="nav-item nav-audience"><span class='icon-field'><i class="fa fa-th-list"></i></span> Event Audience List</a>
				<a href="index.php?page=venue" class="nav-item nav-venue"><span class='icon-field'><i class="fa fa-map-marked-alt"></i></span> Venues</a>
				<a href="index.php?page=events" class="nav-item nav-events"><span class='icon-field'><i class="fa fa-calendar"></i></span> Events</a>
				<a  class="nav-item nav-reports" data-toggle="collapse" href="#reportCollpase" role="button" aria-expanded="false" aria-controls="reportCollpase"><span class='icon-field'><i class="fa fa-file"></i></span> Reports <i class="fa fa-angle-down float-right"></i></a>
				<div class="collapse" id="reportCollpase">
					<a href="index.php?page=audience_report" class="nav-item nav-audience_report"><span class='icon-field'></span> Audience Report</a>
					<a href="index.php?page=venue_report" class="nav-item nav-venue_report"><span class='icon-field'></span> Venue Report</a>
				</div>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
