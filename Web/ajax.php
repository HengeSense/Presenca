<?php include_once("includes/loginCheck.php"); ?>
<?php

	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
	
	// Lembre-se de fazer decode do array recebido pelo jquery

// -------------------------------------- NOTIFICATION --------------------------------------- //

	/**
	 * Check for notifications
	 */
	if (isset ($_POST['checkNotifications'])) {
				
		$count = $core->notificationCountForID($core->userID);
		
		if ($count > 0) {
			// If we do have some notification, we have to see if any of them was inserted in the last 80 seconds
			echo $core->newNotificationsForIDWithDelay($core->userID, 80);
		} else {
			// This code is doubled, and that is because we have to run it really fast
			echo json_encode(array("data" => array()));
		}

	} else 
	
	/**
	 * Get notification data
	 */
	if (isset ($_POST['userNotifications'])) {
				
		echo $core->newNotificationsForUserID($core->userID);
		
	} else 
	
	/**
	 * Get extra notification data with increments
	 */
	if (isset ($_POST['notificationLoadExtra']) && isset ($_POST['value'])) {
	
		$offset = trim(htmlentities(utf8_decode($_POST['value'])));
				
		echo $core->notificationsForUserIDWithOffset($core->userID, $offset);

	} else 
	
	/**
	 * Set notifications (single or group) as seen
	 * If $clean is true, we will set everything up to the given notification as seen
	 * If $clean is false, only the given notification will be set as seen
	 */
	if (isset ($_POST['updateNotificationStatus']) && isset ($_POST['value']) && isset ($_POST['clean'])) {
				
		$id = trim(htmlentities(utf8_decode($_POST['value'])));
		$clean = (bool) trim(htmlentities(utf8_decode($_POST['clean'])));

		if ($clean) {
			echo $core->notificationUpdateStatusSinceID($id);	
		} else {
			echo $core->notificationUpdateStatusForID($id);
		}

	} else 
	
// ------------------------------------------------------------------------------------------- //

// -------------------------------------- COLLECTION ----------------------------------------- //

	/**
	 * Search for elements inside the given collection
	 */
	if (isset ($_POST['searchQuery'])) {
				
		$searchType = trim(htmlentities(utf8_decode($_POST['searchType'])));
		$searchText = trim(htmlentities(utf8_decode($_POST['searchText'])));

		// Gotta see if the table can be accessed
		if (in_array($searchType, $core->tablesPublic) == TRUE) {
			$core->printCollectionForSearch($searchText, $searchType);
		}

	} else 
	
// ------------------------------------------------------------------------------------------- //

// -------------------------------------- POWER USERS ----------------------------------------- //

	/**
	 * Print all the power users
	 */
	if (isset ($_POST['powerUsers'])) {
					
		$core->printPowerUsers();

	} else 
	
	/**
	 * Add a new power user
	 */
	if (isset ($_POST['addPowerUser'])) {
					
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		
		// A feature only available to power users
		if ($core->level >= 10) {
			// Update the database with the new super user
			$update = mysql_query("UPDATE $core->tableUser SET `level`=10 WHERE `id`=$memberID AND `enterpriseID`=$core->enterpriseID");
			
			// And get his name
			$result = mysql_query("SELECT user FROM $core->tableUser WHERE `id`=$memberID AND `enterpriseID`=$core->enterpriseID");
			$user = mysql_result($result, 0, "user");
			
			// So we can notify the rest of the company
			$core->notificationSave(array(), "<b>$core->user</b> adicionou <b>$user</b> como super usuário.", "members.php");	
			
			// And we confirm the insertion
			if ($update) {
				echo "true";
			}
		}
		
	} else 
	
	/**
	 * Remove a power user
	 */
	if (isset ($_POST['removePowerUser'])) {
					
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		
		// A feature only available to power users
		if ($core->level >= 10) {
			// Update the database with the new super user
			$update = mysql_query("UPDATE $core->tableUser SET `level`=1 WHERE `id`=$memberID AND `enterpriseID`=$core->enterpriseID");
			
			// And we confirm the insertion
			if ($update) {
				echo "true";
			}
		}

	} else 
	
	/**
	 * Search for power users
	 */
	if (isset ($_POST['searchPowerUsers'])) {
					
		$core->printPowerUsersForSearch($searchText);

	} else 

// ------------------------------------------------------------------------------------------- //

// -------------------------------------- USER SETTINGS ----------------------------------------- //
	
	/**
	 * Change a user password
	 */
	if (isset ($_POST['changePassword'])) {
	
		$oldPassword = htmlentities(utf8_decode($_POST["oldPassword"]));
		$newPassword = htmlentities(utf8_decode($_POST["newPassword"]));
	
		// Select the user from the database
		$resultado = mysql_query("SELECT * FROM $core->tableUser WHERE id='$core->userID' AND `enterpriseID`=$core->enterpriseID");
		
		$update = false;
		
		// See if he exists
		if (mysql_num_rows ($resultado) != 0) {
			// Get the hash
			$hash = mysql_result($resultado, 0, "password");
			// Incrypt it and see if the user has sent the right old password
			if (Bcrypt::check($oldPassword, $hash)) {
				// If he has, we can update the database with the new password
				$update = mysql_query("UPDATE $core->tableUser SET `password` = '" . Bcrypt::hash($newPassword) . "' WHERE `id`=$core->userID AND `enterpriseID`=$core->enterpriseID");
			}
		}
		
		// And we confirm the insertion
		if ($update) {
			echo "true";
		}

	} else 

// ------------------------------------------------------------------------------------------- //	

	{}

?>