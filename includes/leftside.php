<div class="sidenav col-md-2 navbar-light navbar-expand-md">
	<p><a class="nav-link btn btn-light" href="/unit35/index">Homepage</a></p>
	<p><a class="nav-link btn btn-light" href="/unit35/aboutus">About us</a></p>
	<p><a class="nav-link btn btn-light" href="/unit35/researchers">Researchers</a></p>
	<p><a class="nav-link btn btn-light" href="/unit35/journal">Journal</a></p>
	<p><a class="nav-link btn btn-light" href="/unit35/events">Events</a></p>
	<p><a class="nav-link btn btn-light" href="//contactus">Contact us</a></p>
	
	<?php  // Don't show register button if the user is logged in
	if 		(isset($_SESSION['logged_in']) == true)				{		}
		else {
	?>
	<p><a class="nav-link btn btn-light" href="register.php">Register</a></p>
	<?php } ?>

	<?php // Don't show Member Page page button if the user is logged in
	if 		(isset($_SESSION['logged_in']) == false)				{		}
		else {
	?>
	<p><a class="nav-link btn btn-light" href="members.php">Member Page</a></p>
	<?php } ?>


	<?php 
	if 		($_SESSION['Page_Purpose'] == "members" || $_SESSION['Page_Purpose'] == "register" || isset($_SESSION['logged_in']) == true)				{		}
		else {
	?>
	<center><div class="btn fakebutton">
		<form action="/unit35/members.php" method="post">
		  <div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="text" class="form-control" name="username" placeholder="Enter Username">
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password">
		  </div>
		  <button type="submit" class="btn btn-primary">Sign In</button>
		</form>
	</div></center>
	<br><br>
		<?php
	} 
	if (isset($_SESSION['logged_in']) == true) {
		?>
		<center><div class="btn fakebutton"><form action="/unit35/logout.php" method="post"><button type="submit" class="btn btn-primary">Logout</button></form></div></center>
		<?php
	}
	?>
</div>
