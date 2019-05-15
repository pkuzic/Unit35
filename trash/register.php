<?php
	global $title;
	global $lang;
	require_once("system/functions.php");
	require_once("system/config.php");
?>

<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['reg_title'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<center>
			<div class="loginform">
				<form action="/system/accounts/register.php" method="post">				
					<div class="form-group">
						<input type="login" placeholder="<?php echo $lang['loginform_login'] ?>" class="form-control" id="login" name="login" required>
					</div>
					<div class="form-group">
						<input type="password" placeholder="<?php echo $lang['loginform_pass'] ?>" class="form-control" id="password" name="password" required>
					</div>
					<div class="form-group">
						<input type="password" placeholder="<?php echo $lang['loginform_pass_check'] ?>" class="form-control" id="password_2" required>
					</div>
					<div class="form-group">
						<input type="email" placeholder="<?php echo $lang['loginform_email'] ?>" class="form-control" id="email" name="email" required>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" required> <?php echo $lang['loginform_conditions'] ?></label>
					</div>
					<div class="modal-footer">
						<button type="submit" name="do_register" class="btn btn-primary"><?php echo $lang['reg_ready'] ?></button>
					</div>
				</form> 
			</div>
		</center>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="resetpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['resetpass_title'] ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
	        </button>
		</div>
		<div class="modal-body">
			<center>
				<div class="loginform">
					<form action="/system/accounts/resetpass.php" method="post">				
						<div class="form-group">
							<input type="email" placeholder="<?php echo $lang['loginform_email'] ?>" class="form-control" id="email" name="email" required>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><?php echo $lang['submit'] ?></button>
						</div>
					</form> 
				</div>
			</center>
		</div>
    </div>
  </div>
</div>