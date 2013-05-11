<?php include_once("includes/loginCheck.php"); ?>
<?php

	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
	
	// Lembre-se de fazer decode do array recebido pelo jquery
	
// -------------------------------------- MENU --------------------------------------- //
	
	/**
	 * Search groups
	 */
	if ((isset ($_POST['searchQuery']))) {
		$searchText = trim(htmlentities(utf8_decode($_POST['searchText'])));
		
		$core->printGroupForSearch($searchText);
	} else 


// -------------------------------------- MEMBERS --------------------------------------- //

	
	/**
	 * Update the group a member belongs to
	 */
	if (isset ($_POST['updateMemberGroup'])) {
		
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		$groupID = trim(htmlentities(utf8_decode($_POST['groupID'])));
		
		if ($core->group == 3 || $core->level >= 10) {
		
			// See if the user new group is not the same as the old one
			$result = $core->resourceForQuery("SELECT `groupID` FROM $core->tableUser WHERE `id`=$memberID AND `enterpriseID`=$core->enterpriseID"); 
			
			$insert = false;
			
			if (mysql_result($result, 0, "groupID") == $groupID ) {
				$insert = true;
			} else {
				$insert = $core->resourceForQuery("UPDATE $core->tableUser SET `groupID`=$groupID WHERE `id`=$memberID AND `enterpriseID`=$core->enterpriseID");
				
				$core->notificationSave(array($memberID), "<b>$core->user</b> alterou seu grupo.", "groups.php");	
			}
			
			// And we confirm the operation
			if ($insert) {
				echo "true";
			}
		}
		
	} else
	
	/**
	 * Saving the card (insertion and update)
	 */
	if (isset ($_POST['saveForm']) && isset ($_POST['memberID'])) {
		
		// We receive ther data
		$data = $_POST['data']; // We still gotta filter it
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		
		$insert = false;
		
		if ($core->group == 1 || $core->group == 3 || $core->level >= 10) {

			// Update post
			if ($memberID != "0") {
				// Array for name check (we don't include historyDate because we only save it if we have the text counterpart)
				$possibleNames = array("name", "acronym", "photo");

				// Loop through it
				for ($i = 0; $i < count($data); $i++) {
					$object = $data[$i];
					// Retrieve the values of each one
					$name = htmlentities(utf8_decode($object['name']));
					$value = htmlentities(utf8_decode($object['value']));
					
					// Make the name check (for security)
					if (in_array($name, $possibleNames) == TRUE) {
					
						// We process the exceptions
						if ($name == "birthday") {
							$insert = $core->resourceForQuery("UPDATE $core->tableUser SET $name = STR_TO_DATE('$value','%m/%d/%Y') WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
						} elseif ($name == "historyText" && $value != "") {
							// If we receive the text, we must be sure that the data has come too, so we search for it
							for ($j = 0; $j < count($data); $j++) {
								if ($data[$j]["name"] == "historyDate") {
									$valueDate = htmlentities(utf8_decode($data[$j]["value"]));
									$insert = $core->resourceForQuery("INSERT INTO $core->tableUserHistory (`memberID`, `historyDate`, `historyText`) VALUES ('$memberID', STR_TO_DATE('$valueDate','%d/%m/%Y'), '$value')");
								}
							}
						} else {
							if ($name == "group") {
								echo($value);
								$resultGroup = $core->resourceForQuery("SELECT * FROM $core->tableGroup WHERE `name`='$value' AND `enterpriseID`=$core->enterpriseID");
								$value = mysql_result($resultGroup, 0, "id");
							}

							// And then insert it on the server
							$insert = $core->resourceForQuery("UPDATE $core->tableGroup SET $name = '$value' WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
						}
					}
				}

			// New post	
			} else {
				// Array that will hold data as we want
				$dataArray = array();
				
				// Loop through it
				for ($i = 0; $i < count($data); $i++) {
					$object = $data[$i];
					// Retrieve the values of each one
					$name = htmlentities(utf8_decode($object['name']));
					$value = htmlentities(utf8_decode($object['value']));
					
					$dataArray[$name] = $value;
				}
				
				$query = ("INSERT INTO $core->tableGroup (`enterpriseID`, `name`, `acronym`, `photo`) VALUES ($core->enterpriseID, '" . $dataArray["name"] . "', '" . $dataArray["acronym"] . "', '" . $dataArray["photo"] . "')");

				$insert = $core->resourceForQuery($query);
				// And now we can save the notification
				$core->notificationSave(array(), "O grupo <b>".$dataArray["name"]."</b> foi criado.", "groups.php");
			}
			
			// And we confirm the insertion
			if ($insert) {
				echo "true";
			}
		}

	} else 
	
// ----------------------------------------------------------------------------------- //	
	{}

?>