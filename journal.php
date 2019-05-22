
<?php
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}

/*	
	Include the Php libraries
	article.php		- contains all of the classes that are used throughout the solution
	connection.php	- connects to the DB
 */

	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');

	$article = new Article;
	$articles = $article->fetch_all();					// load all articles into memory
	
	$journal = new Journal;
	$journals = $journal->fetch_journal_details();		// load all journals into memory
	$journalcount=0;
	
	foreach ($journals as $journal)						
	{
		$journalcount++; //Counts the amount of journals in the database, used for JournalCount
	}
	
	$_SESSION['minnumberofjournals'] = 1;
	$_SESSION['maxnumberofjournals'] = $journalcount;

	$user_array_title = array();
	$user_array_first_name = array();
	$user_array_last_name = array();
	
	$usercount = 0;
	$user = new Users;
	$users = $user->fetch_researcher_details();			// load all users (staff) into memory
		
	foreach ($users as $user)							// cycle through the data (from the DB table) and put it into the appropriate arrays
	{
		$user_array_title[$usercount] = $user['user_name_title'];
		$user_array_first_name[$usercount] = $user['user_name_first'];
		$user_array_last_name[$usercount] = $user['user_name_last'];
		$usercount++;
	}




if(isset($_GET['id']))  //Checks to see if ID is set, prevents undefined Index
{
	$_SESSION['big_journal_number'] =$_GET['id'];
}

?>	
	
	<html>
		<head>
			<?php 
				include_once 'includes/head.php'
			?>
			
			<?php	
				include_once('./SetupCKEditorScript1.php');	// this include allows us to use the CKEditor for displaying the text (abstract) - not sure why
			?>		
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "journal";

			include_once("includes/header.php");
			include_once("includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
			include_once("includes/variables.php"); //new pagepurpose.php to identify the purpose
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
?>													
			<div class="Container">		
			<!-- header -->	
					<div class="container-fluid">
						<div class="row">
							<?php 
								include_once 'includes/leftside.php'
							?>

							<div id="wrapper" class="col-md-8 text-left">
	
								<div class="PagePurpose">			
								
									<table border="0" width="100%">
										<tr>										
											<td align="left">
												<div class="alert alert-info" role="alert">											
													<?php echo $Title_Text;	?> 	
												</div>
											</td>	
										</tr>
									</table>
								</div>
								<div class="StyledTable1 alert"> <?php // Main block inside of wrap. Duplicate if required ?>
												<div class="Container">
		
			
			<div class="section-box2">	&nbsp; &nbsp; </div>
				
<?php	
	/*	-------------------------------------------------------------------------------------------------------------------------------------------------
		This table outputs the specific journals down the right-hand-side of the page - There are three parts to the loop
			(1)......The head part of the table. Rounded at the top corners (contains the title of the journal, volume & issue and date published)
			(2)......The image (large image)
			(3)......blank
	-------------------------------------------------------------------------------------------------------------------------------------------------	*/
?>				

				<div class="d-flex flex-wrap">
		<?php	foreach ($journals as $journal)	{	?>
							<div class="journal_display">
								<?php 	$imagestring = $journal['journal_image'];
										$journalid = $journal['journal_id'];
									 ?>
									 <a href="article.php?id=<?php echo $journalid ?>">
								<img border="0" class="journal_img" width="300" <?php echo "src = $imagestring";  ?> ></a>
								<center>
								<?php 	$name_string = "<h12>" . 	"Vol: " . $journal['journal_volume'] . " " . 
																					"Iss: " . $journal['journal_issue'] . " " .
																					$journal['journal_name'] . "<br>" .
																					date('l jS F Y', $journal['journal_published_date']) . 
																		"</h12>";
														echo "&nbsp;<br>" . $name_string . "<br> &nbsp;";
												?></center>
							</div>
									<?php	
					}
			?>
		</div>
				
														
				<br style="clear: left;" />
			</div>

								</div>

							</div>
							<div class="sidenav col-md-2 sidenav navbar-light">
								 Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies vestibulum luctus. Aenean tincidunt eget felis vel maximus. Nunc id sapien elementum, sagittis quam luctus, dictum nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas, augue non cursus sodales, felis tortor dictum elit, fringilla rutrum turpis ex ac libero. Nullam at ipsum laoreet dui blandit finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent auctor iaculis elit eu interdum. Maecenas at libero id ante placerat imperdiet. Quisque vitae cursus ligula. Cras ac scelerisque dui.
							</div>
													
							<br style="clear: left;" />
						</div>
					</div>
				</div>
			</div>


<!-- END of MAIN BODY div -->								

<!-- END of PAGE CONTAINER div -->								

		</body>

	</html>