<?php
	global $title;
	global $lang;
	require_once("system/functions.php");
	require_once("system/config.php");

?>
<head>
	<title><?php echo $title; ?> - <?php echo $lang['maint_status'] ?></title>
</head>

<div class="container">
	<div class="alert alert-warning">
		<h4 class="alert-heading"><?php echo $lang['maint_oops'] ?></h4>
		<?php echo $lang['maint_notif'] ?>
		<hr>
		<?php echo $lang['maint_sorry'] ?>
	</div>
</div>
