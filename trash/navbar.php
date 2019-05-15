<?php
	global $title;
	global $lang;
	require_once("system/functions.php");
	require_once("system/config.php");
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-md">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">&#x2630;</button> <a class="navbar-brand" href="/"><?php echo $title; ?></a>
    <div class="collapse navbar-collapse"
    id="myNavbar">
        <ul class="nav navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="index.php?page=home"><i class="fas fa-home"></i> <?php echo $lang['home'] ?></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="index.php?page=map"><i class="fas fa-map"></i> <?php echo $lang['map'] ?></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="index.php?page=dynasty"><i class="fas fa-users"></i> <?php echo $lang['dynasty'] ?></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="index.php?page=stats"><i class="fas fa-chart-line"></i> <?php echo $lang['statistics'] ?></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="index.php?page=msg"><i class="fas fa-envelope"></i> <?php echo $lang['messages'] ?></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="index.php?page=forum"><i class="fas fa-comments"></i> <?php echo $lang['forum'] ?> </a>
		</li>
        </ul>
    </div>
</nav>