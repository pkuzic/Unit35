<?php
	global $title;
	global $lang;
	require_once("system/functions.php");
	require_once("system/config.php");
?>

<footer class="container-fluid text-center">
    <div class="footer-copyright text-center py-3">© 2018
      <a href="/"><?php echo $title; ?></a>
    </div>
    <a href="?lang=ru">Russian</a> \ <a href="?lang=en">English</a><br>
<?php echo $lang['conditions'] ?> ፠ <?php echo $lang['contact'] ?>

</footer>
