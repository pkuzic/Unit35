<?php
	global $title;
	global $lang;
	require_once("system/functions.php");
	require_once("system/config.php");
	require_once("register.php");
?>
			<head>
				<title><?php echo $title; ?></title>
				<link href="styles/home.css" rel="stylesheet" type="text/css">
			</head>

			<body>
				<div id="page">
										<?php
						getNavBar();
					?>

					<div class="container-fluid text-center">
						<div class="row">
							<?php
								getLeftSide();
							?>>
							<div id="wrapper" class="col-md-8 text-left">
								<h1><?php echo $lang['index_welcome'] ?></h1>

								<div id="homepics">
									<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="images\homepics\1.png">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="images\homepics\2.png">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="images\homepics\3.png">
											</div>
										</div>
									</div>
								</div>

								<center>
									<div class="loginform">
										<form action="/system/accounts/login.php" method="post">				
											<div class="form-group">
												<input type="login" placeholder="<?php echo $lang['loginform_login'] ?>" class="form-control" id="login" name="login" required>
											</div>
											<div class="form-group">
												<input type="password" placeholder="<?php echo $lang['loginform_pass'] ?>" class="form-control" id="password" name="password" required>
											</div>
											<button type="submit" class="btn btn-primary"><?php echo $lang['submit'] ?></button>
										</form>
										<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#reg"><?php echo $lang['index_reg'] ?></button>
										<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#resetpass"><?php echo $lang['index_reset'] ?></button>
									</div>
								</center>

								<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at lectus et odio elementum iaculis in id ante. Cras et bibendum neque. Etiam placerat faucibus gravida. Maecenas vitae lacus aliquam, blandit erat nec, pretium mi. Maecenas tincidunt sed nibh at iaculis. Nulla nec sollicitudin neque. Cras magna urna, ullamcorper sed tincidunt at, viverra vel massa. Ut iaculis volutpat lectus, eget mollis arcu tincidunt non. Phasellus id porttitor nisi. Mauris tempus sodales tempus. Morbi convallis volutpat libero vitae placerat.

								Integer pretium, ipsum vitae porttitor imperdiet, est erat imperdiet augue, ac aliquet tellus neque eu eros. Nunc sit amet massa massa. Vestibulum tincidunt blandit quam vel imperdiet. Sed eros neque, mattis quis felis sit amet, dapibus blandit lacus. Sed nec nibh efficitur, accumsan justo in, fringilla nibh. Suspendisse potenti. Aenean tempor facilisis commodo. Morbi congue nisl nulla, at mollis lectus mollis in. Fusce ac augue et magna luctus ullamcorper. Duis nec leo ante. Mauris imperdiet quam sit amet neque luctus volutpat. In sit amet bibendum sem.

								Cras metus ante, tristique eget purus sit amet, rutrum dictum lorem. Donec sed imperdiet justo. Nam fringilla mauris in gravida euismod. Nullam laoreet, massa cursus mollis pulvinar, justo dolor blandit nisi, ut pretium orci urna quis quam. Nulla aliquam quam ut urna ornare, sit amet vehicula neque pharetra. Aliquam gravida ex ac hendrerit commodo. Phasellus sodales risus dictum ipsum tincidunt volutpat. Aliquam mollis lectus sit amet auctor venenatis. Etiam eu porttitor mauris. Etiam pellentesque eget arcu in convallis. Donec vestibulum iaculis pharetra. Ut non mauris sit amet turpis commodo iaculis et vitae ex. Curabitur magna tellus, pharetra non auctor venenatis, porta id erat. Aliquam pellentesque pretium enim, sollicitudin auctor est aliquam at. Aenean a mi a erat tincidunt fermentum.

								Quisque eu ligula sed risus bibendum volutpat sed eget nulla. In dictum sollicitudin est sit amet eleifend. Suspendisse potenti. Duis eget orci fermentum, tincidunt ex et, suscipit nisi. Suspendisse semper, magna sed blandit pulvinar, urna dui facilisis justo, quis rutrum velit leo commodo leo. Donec ac dolor volutpat, sollicitudin ligula luctus, euismod velit. Nulla in ante eget nibh sagittis dapibus. Vivamus aliquet rhoncus nisi, ac faucibus nibh. Suspendisse non congue lacus, ut facilisis ante. Proin vulputate nulla ut nunc malesuada, id tempus erat tempor. Maecenas lectus ipsum, hendrerit sit amet consequat sit amet, molestie in mauris.

								Duis a ultrices dui, sed tincidunt felis. Morbi non justo quis dolor tempor condimentum. Phasellus posuere aliquet sodales. Nam non nibh dignissim, rutrum dui nec, feugiat tellus. Ut vel tellus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pellentesque mi sit amet est finibus, id vulputate enim sollicitudin. Fusce congue, nunc eget finibus sodales, mi elit tincidunt elit, vitae facilisis erat massa eu augue. Nullam rutrum, sem ut aliquet bibendum, lacus risus fermentum erat, quis tincidunt felis lorem et lectus. Fusce rutrum dolor vehicula elementum iaculis.

								Curabitur feugiat pharetra venenatis. Cras at posuere nisi, sed pulvinar enim. Nunc eleifend, enim nec cursus pulvinar, tortor dolor ultricies lacus, ac sagittis dui nulla in nunc. Nam hendrerit efficitur ipsum at aliquam. Nullam vel eleifend erat, sed sodales leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus tristique mattis massa et condimentum. Duis vitae massa massa. Vivamus scelerisque pulvinar eros.

								Donec blandit tortor nulla, id porta lorem sodales ac. Ut ac lacinia mauris. Nullam venenatis hendrerit augue, sit amet imperdiet eros luctus nec. Vestibulum porttitor semper dignissim. Suspendisse auctor ullamcorper lorem, ac lobortis nulla tincidunt at. Fusce vel vehicula enim. Aliquam sagittis, ipsum venenatis dapibus interdum, magna tortor feugiat quam, non fermentum ipsum eros et lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus lobortis felis ac facilisis venenatis. Morbi dapibus mauris at pretium euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean at ipsum congue odio euismod tempor.

								Nunc a nisi euismod, imperdiet urna vel, porttitor sapien. Duis libero quam, condimentum non lorem a, porta interdum ligula. Phasellus blandit eros eu sem ultricies, in consectetur odio porta. Morbi finibus, justo quis consequat porttitor, quam justo tincidunt nisl, in malesuada leo nulla at tortor. Nullam feugiat, neque sed consectetur tempor, massa eros fermentum sem, sed viverra diam dolor at risus. Vivamus eu justo ornare, gravida mi ac, luctus mauris. Morbi quis metus ultricies, fermentum nunc ac, rutrum magna. Pellentesque interdum id massa vitae interdum. Nam et dolor tempus lorem blandit porttitor. Nam congue lacus ligula, vitae mattis ex maximus eget. Duis feugiat neque nisi. Etiam lectus lectus, efficitur vitae sem ac, eleifend dignissim est. Vestibulum ut eros vestibulum, accumsan justo eu, venenatis diam. Phasellus lacus dolor, porttitor non nisi vitae, rutrum mattis neque. Nam tincidunt sed tortor a venenatis. Praesent blandit, elit eu euismod sodales, velit massa porttitor enim, id varius lorem orci et metus. </p>
								<hr>
								<h3>Test</h3>
								<p>Lorem ipsum...</p>
							</div>
							<?php
								getRightSide();
							?>
						</div>
					</div>
					<?php
						getFooter();
					?>
				</div>

			</body>