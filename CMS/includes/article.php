<?php

	class Article
	{
	
		public static $loggedin_as_member;
		public static $logeedin_as_user;
	
		public function fetch_all()
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable");
			$query->execute();
			
			return $query->fetchAll();			
		}
		
		public function fetch_all_date_descending()
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable ORDER BY article_published_date DESC");
			$query->execute();
			
			return $query->fetchAll();			
		}
		
		public function fetch_data($article_id)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable WHERE article_id = ?");
			$query->bindValue(1, $article_id);
			$query->execute();
			
			return $query->fetch();			
		}
		
		public function fetch_range($fromdate, $todate)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable WHERE article_published_date >= ? AND article_published_date <= ?"); 
			$query->bindValue(1, $fromdate);
			$query->bindValue(2, $todate);
			$query->execute();
			
			return $query->fetchAll();			
		}
		
		public function fetch_all_articles_for_a_particular_journal($journal_number)
		{
		
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable");
			$query->bindValue(1, $journal_number);
			$query->execute();
			
			return $query->fetchAll();
		}
		
		public function fetch_all_particular_journal($journal_ref)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable WHERE journal_reference = ?");
			$query->bindValue(1, $journal_ref);
			$query->execute();
			
			return $query->fetchAll();
		}
		
		public function fetch_all_particular_researcher($researcher_ref)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journaltable WHERE article_author = ?");
			$query->bindValue(1, $researcher_ref);
			$query->execute();
			
			return $query->fetchAll();
		}
		
		public function store_record_on_DB($articletext, $journalnumber, $abstracttext, $filenameandpath, $authornumber, $datenumber)
		{
				
				global $pdo;
				$sql = "INSERT INTO journaltable (journal_reference, article_title, article_abstract, article_reference, article_author, article_published_date) VALUES (?,?,?,?,?,?)";
										
				$q = $pdo->prepare($sql);
				$q->bindValue(1, $journalnumber);
				$q->bindValue(2, $articletext);
				$q->bindValue(3, $abstracttext);
				$q->bindValue(4, $filenameandpath);
				$q->bindValue(5, $authornumber);
				$q->bindValue(6, $datenumber);
				$q->execute(); 									 				
		}
		
		
		public function delete_record_on_DB($id)
		{
			
			global $pdo;	
			
			$query = $pdo->prepare('DELETE FROM journaltable WHERE article_id = ?');
			$query->bindValue(1, $id);
			$query->execute();
		}
		
		
		
	}
		
	class Journal
	{
		public function fetch_journal_details()
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journal_details");
			$query->execute();
			
			return $query->fetchAll();			
		}
		
		public function fetch_journal_title()
		{
		
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM journal_details");
			$query->execute();
			
			return $query->fetch();			
		}

	}	
		
	class Users
	{
		
		public function fetch_researcher_details()
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users");
			$query->execute();
			
			return $query->fetchAll();			
		}
		
		public function find_user_exist($username, $password)
		{
			global $pdo;
			
			$query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			
			$query->execute();
								
			$num = $query->rowCount();
			
			return $num;			
		}
		
		public function fetch_data($username)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
			$query->bindValue(1, $username);
			$query->execute();
			return $query->fetch();			
		}
		
		public function fetch_data_on_user_ID($userID)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
			$query->bindValue(1, $userID);
			$query->execute();
			return $query->fetch();			
		}
	}
	
	class Member
	{
		// 	need to pass ID to this function and do the following statement
		// 	http://runnable.com/UoIWFPVoG0geAACm/how-to-create-insert-update-delete-prepared-statements-with-pdo-for-php
		
			//	$sqlInsert = 'UPDATE test set name=:name where id=:id';
			//	$preparedStatement = $conn->prepare($sqlInsert);
			//	$preparedStatement->execute(array(':name' => 'MICHAEL', ':id' => 1));
		
		
		
		
		public function update_member($memberid, $title, $firstname, $lastname, $username, $password, $datenow, $date1year, $email, $newsletterYN)
		{
			global $pdo;
			
			$sql = "UPDATE members SET 	
						member_name_title 		= 	:title, 
						member_name_first 		= 	:firstname, 
						member_name_last 		= 	:lastname, 
						username 				=	:username, 		
						password 				= 	:password, 			
						date_joined 			= 	:datenow, 
						date_end 				= 	:date1year, 		
						email 					= 	:email, 				
						newsletterYN 			= 	:newsletterYN";
								
						// where id = :id 

			$query = $pdo->prepare($sql);                                 
			$query->bindParam(':title', 	$title);			$query->bindParam(':firstname', 	$firstname);
			$query->bindParam(':lastname', 	$lastname);			$query->bindParam(':username', 		$username);
			$query->bindParam(':password', 	$password);			$query->bindParam(':datenow', 		$datenow);
			$query->bindParam(':date1year', $date1year);		$query->bindParam(':email', 		$email);
			$query->bindParam(':newsletterYN', 	$newsletterYN);
		
			$query->execute(); 
		}

		//public function find_member($title, $firstname, $lastname, $username, $password, $datenow, $date1year, $email, $newsletter)
		
		public function find_member($member_username)
		{
			global $pdo;
			
			$query = $pdo->prepare("SELECT * FROM members WHERE username = ?");
			$query->bindValue(1, $member_username);
			$query->execute();
								
			$num = $query->rowCount();
			
			return $num;			
		}
		
		public function find_member_exist($username, $password)
		{
			global $pdo;
			
			$query = $pdo->prepare("SELECT * FROM members WHERE username = ? AND password = ?");
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			$query->execute();
								
			$num = $query->rowCount();
			
			return $num;			
		}
		
		public function fetch_data($username)
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM members WHERE username = ?");
			$query->bindValue(1, $username);
			$query->execute();
			return $query->fetch();			
		}
					
		public function store_member_data($title, $firstname, $lastname, $username, $password, $datenow, $date1year, $email, $newsletter)
		{
			global $pdo;
			
			if(	strtolower($title) == "mr" 		or strtolower($title) == "ms" 			or strtolower($title) == "mrs" or 
				strtolower($title) == "miss" 	or strtolower($title) == "dr" 			or strtolower($title) == "prof" or
				strtolower($title) == "doctor" 	or strtolower($title) == "professor" 	or	strtolower($title) == "mr." or 
				strtolower($title) == "ms." or 	strtolower($title) == "mrs." 			or 	strtolower($title) == "dr." or
				strtolower($title) == "prof.")	{	$titleOK = 1;			}
			else								{	$titleOK = 0;			}
				
			if (strlen($username) >= 8)			{	$usernameOK = 1;		}
			else								{	$usernameOK = 0;		}

			if (strlen($password) >= 8)			{	$passwordOK = 1;		}
			else								{	$passwordOK = 0;		}
			
			$domain = strstr($email, '@');			
			if ($domain == FALSE)				{	$emailOK = 0;			}
			else								{	$emailOK = 1;			}
						
			if (isset($newsletter))
			{
				if ($newsletter == "Y")			{	$newsletterrequired = 1;	}
				else							{	$newsletterrequired = 0;	}				
			}
			
			if ($titleOK == 1 && $usernameOK == 1 && $passwordOK == 1 && $emailOK == 1)
			{
				$query = $pdo->prepare("INSERT INTO members (member_name_title, member_name_first, member_name_last, username, password, date_joined, date_end, email, newsletterYN) 
										VALUES (:title, :firstname, :lastname, :username, :password, :datenow, :date1year, :email, :newsletter)");
			
				// insert one row				
				$query->bindParam(':title', 	$title);			$query->bindParam(':firstname', 	$firstname);
				$query->bindParam(':lastname', 	$lastname);			$query->bindParam(':username', 		$username);
				$query->bindParam(':password', 	$password);			$query->bindParam(':datenow', 		$datenow);
				$query->bindParam(':date1year', $date1year);		$query->bindParam(':email', 		$email);
				
				if ($newsletterrequired == 1)			$YN = "YES";
					else								$YN = "NO";
				
				$query->bindParam(':newsletter', $YN);					
													
				$datetoday = date('l jS F Y', $datenow);
				$dateinayear = date('l jS F Y', $date1year);
				
				$member_name_title = $title;	$member_name_first = $firstname;	$member_name_last = $lastname;
				$time_now = $datenow;			$time_next_year = $date1year;
				$member_username = $username;	$member_password = $password;
				
				echo "<h9>Congratulations, registration successful...</h9>";
				echo "<h11><br><br>"
					?>&emsp;&emsp;&emsp;<?php echo "Thank you " . $member_name_title . " " . $member_name_first . " " . $member_name_last . " for registering with us."; 	
					?><br><br>&emsp;&emsp;&emsp;<?php echo "You may now fully access articles and other contents. ";
					?><br><br>&emsp;&emsp;&emsp;<?php echo "Your subscription is valid for 365 days, " . date('l jS F Y', $time_now) . " to " . date('l jS F Y', $time_next_year) . "<small> (note! Re-registration is FREE)</small>\r\n\n";
					?><br><br>&emsp;&emsp;&emsp;<?php echo "Please ensure that you login using the following details: "; 
					?><br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo "Username - " . $member_username; 
					?><br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo "Password - " . $member_password;
				echo "</h11>";
				
				if ($newsletterrequired == 1)
				{
					?><p><h11>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo "You have also opted for our FREE newsletter ";
				}
				else	
				{
					?><p><h11>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo "You have also opted out of our FREE newsletter ";
				}
											
				?><br><br> <h11>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href = "members.php" class="loginink">Click here to login</a>	</h11>
				<?php
								
				$query->execute();
								
				return 1;
			}
			
			else
			{
				return 0;
			}
		}
	}	
		
	class News
	{
		
		public function fetch_news_stories_decending()
		{
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM news ORDER BY news_posted_date DESC");
			$query->execute();
			
			return $query->fetchAll();						
		}

	}
	
?>
