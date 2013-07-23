<?php include_once("includes/loginCheck.php"); ?>
<?php

	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
	
	// Lembre-se de fazer decode do array recebido pelo jquery
	
// -------------------------------------- MENU --------------------------------------- //
	/**
	 * Print the project form
	 */
	if ((isset ($_POST['addProjectButton']))) {
		$core->printProjectForm();
	} else 
	
	/**
	 * Search through the project
	 */
	if ((isset ($_POST['searchQuery']))) {
		$searchText = trim(htmlentities(utf8_decode($_POST['searchText'])));
		
		$core->printProjectForSearch($searchText);
	} else 


// -------------------------------------- PROJECTS --------------------------------------- //

	/**
	 * Complete box with all the details
	 */
	if (isset ($_POST['projectComplete'])) {
		
		$id = trim(htmlentities(utf8_decode($_POST['projectComplete'])));
		$core->printProjectCompleteForID($id);

	} else 
	
	/**
	 * Saving the project (insertion and update)
	 */
	if (isset ($_POST['projectSubmitButton'])) {
		
		if ($core->group == 1 || $core->level >= 10) {
			$id = trim(htmlentities(utf8_decode($_POST['id'])));
			$image = trim(htmlentities(utf8_decode($_POST['image'])));
			$date = trim(htmlentities(utf8_decode($_POST['date'])));
			$price = trim(htmlentities(utf8_decode($_POST['price'])));
			$name = trim(htmlentities(utf8_decode($_POST['name'])));
			$members = array_map('htmlentities', (isset($_POST['members']) ? $_POST['members'] : array()));
			$clients = array_map('htmlentities', (isset($_POST['clients']) ? $_POST['clients'] : array()));
			$consultants = array_map('htmlentities', (isset($_POST['consultants']) ? $_POST['consultants'] : array())); // Check if the received var is a consistent structure
			$headline = trim(htmlentities(utf8_decode($_POST['headline'])));
			$description = trim(htmlentities(utf8_decode($_POST['description'])));
			
			// Insert project
			if ($id == "0") {
			
				$insert = mysql_query("INSERT INTO $core->tableProject (`enterpriseID`, `image`, `name`, `headline`, `description`, `price`, `statusID`) VALUES ('1', '$image', '$name', '$headline', '$description', '$price', 1)");
				$id = mysql_insert_id();
				
				if ($insert) {
					$insert = mysql_query("INSERT INTO $core->tableProjectHistory (`projectID`, `date`, `description`, `memberID`, `statusID`) VALUES ('$id', STR_TO_DATE('$date','%d/%m/%Y'), 'Projeto iniciado!', $core->userID, 1)");
				}
		
				if ($insert) {
					for ($i = 0; $i < count($members); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectMembers (`projectID`, `personID`) VALUES ('$id', '$members[$i]')");
					}
					for ($i = 0; $i < count($clients); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectClients (`projectID`, `personID`) VALUES ('$id', '$clients[$i]')");
					}
					for ($i = 0; $i < count($consultants); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectConsultants (`projectID`, `personID`) VALUES ('$id', '$consultants[$i]')");
					}
				}
			
				if ($insert) {
					// And now we can save the notification
					$core->notificationSave(array(), "<b>$core->user</b> criou o projeto <b>$name</b>.", "projects.php");	
				
					echo "<img src='images/48-check.png'>";
				} else {
					echo "<img src='images/48-cross.png'>";
				}

			// Update project
			} else {
				$update = mysql_query("UPDATE $core->tableProject SET `image`='$image', `name`='$name', `headline`='$headline', `description`='$description', `price`='$price' WHERE `id`=$id");
				
				if ($update) {
					// We get the first event of this project (probably the one establishing its creation) 
					$resultDate = mysql_query("SELECT id FROM $core->tableProjectHistory WHERE `projectID`=$id ORDER BY id ASC");
					$idDate = mysql_result($resultDate, 0, "id");
					
					$query = "UPDATE $core->tableProjectHistory SET `date`=STR_TO_DATE('$date','%d/%m/%Y') WHERE `id`=$idDate";
					$update = mysql_query($query) or trigger_error(mysql_error() . " " . $query);
				}
		
				if ($update) {
					// We gotta delete before we re-insert the data
					// This is the information regarding members, clients and consultants on this projects
					mysql_query("DELETE FROM $core->tableProjectMembers WHERE `projectID`='$id'");
					for ($i = 0; $i < count($members); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectMembers (`projectID`, `personID`) VALUES ('$id', '$members[$i]')");
					}
					
					mysql_query("DELETE FROM $core->tableProjectClients WHERE `projectID`='$id'");
					for ($i = 0; $i < count($clients); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectClients (`projectID`, `personID`) VALUES ('$id', '$clients[$i]')");
					}
					
					mysql_query("DELETE FROM $core->tableProjectConsultants WHERE `projectID`='$id'");
					for ($i = 0; $i < count($consultants); $i++) {
						$insert = mysql_query("INSERT INTO $core->tableProjectConsultants (`projectID`, `personID`) VALUES ('$id', '$consultants[$i]')");
					}
					
					// Let's see if the user opted to add news to this project
					
					$updateText = trim(htmlentities(utf8_decode($_POST['updateText'])));
					$updateStatus = trim(htmlentities(utf8_decode($_POST['updateStatus'])));
					
					// If he has selected anything, we just write it to the database
					if ($updateText != "" || $updateStatus != 0) {
						$insert = mysql_query("INSERT INTO $core->tableProjectHistory (`projectID`, `date`, `description`, `memberID`, `statusID`) VALUES ('$id', NOW(), '$updateText', $core->userID, $updateStatus)");
					}
					
					// And if the status was updated, me must update the project status too
					if ($updateStatus != 0) {
						$update = mysql_query("UPDATE $core->tableProject SET `statusID`=$updateStatus WHERE `id`=$id");
					}

					// And now we can save the notification
					$core->notificationSave(array(), "<b>$core->user</b> atualizou o projeto <b>$name</b>.", "projects.php");	
				
					echo "<img src='images/48-check.png'>";
				} else {
					echo "<img src='images/48-cross.png'>";
				}
			}
		} else {
			echo "<img src='images/48-cross.png'>";
		}
		
	} else 
	
	/**
	 * Print all the projects
	 */
	if (isset ($_POST['printProjects'])) {

		$core->printAllProjects();
	} else 
	
// ----------------------------------------------------------------------------------- //	
	{}
	

?>