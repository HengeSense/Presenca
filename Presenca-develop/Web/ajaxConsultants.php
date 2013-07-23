<?php include_once("includes/check/login.php"); ?>
<?php

		if (!$core->auth) logout();
	
	// Lembre-se de fazer decode do array recebido pelo jquery
	
// -------------------------------------- MENU --------------------------------------- //
	
	/**
	 * Search consultant
	 */
	if ((isset ($_POST['searchQuery']))) {
		$searchText = trim(htmlentities(utf8_decode($_POST['searchText'])));
		
		$core->printConsultantForSearch($searchText);
	} else 


// -------------------------------------- CONSULTANTS --------------------------------------- //

	/**
	 * Extra container, usually for details
	 */
	if (isset ($_POST['infoContainerExtra'])) {
		
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		
		$core->printCardExtraForID($memberID, $core->tableProjectConsultants);
		
	} else 
	
	/**
	 * Saving the card (insertion and update)
	 */
	if (isset ($_POST['saveForm']) && isset ($_POST['memberID'])) {
		
		// We receive ther data
		$data = $_POST['data']; // We still gotta filter it
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		//var_dump($data);
		
		$insert = false;
		
		if ($core->group == 1 || $core->group == 3 || $core->level >= 10) {
			
			// Update card
			if ($memberID != "0") {

				// Array for name check (we don't include historyDate because we only save it if we have the text counterpart)
				$possibleNames = array("user", "position", "telephone", "email", "course");

				// Loop through it
				for ($i = 0; $i < count($data); $i++) {
					$object = $data[$i];
					// Retrieve the values of each one
					$name = htmlentities(utf8_decode($object['name']));
					$value = trim(htmlentities(utf8_decode($object['value'])));

					
					// Make the name check (for security)
					if (in_array($name, $possibleNames) == TRUE) {
					
						// We process the exceptions
						if ($name == "birthday") {
							$insert = $core->resourceForQuery("UPDATE $core->tableConsultant SET $name = STR_TO_DATE('$value','%d/%m/%Y') WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
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
							$insert = $core->resourceForQuery("UPDATE $core->tableConsultant SET $name = '$value' WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
						}
					}
				}	

			// New card
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
				
				$query = ("INSERT INTO $core->tableConsultant (`enterpriseID`, `user`, `position`, `course`, `telephone`, `email`) VALUES ($core->enterpriseID, '" . $dataArray["user"] . "', '" . $dataArray["position"] . "', '" . $dataArray["course"] . "', '" . $dataArray["telephone"] . "', '" . $dataArray["email"] . "')");

				$insert = $core->resourceForQuery($query);
				// And now we can save the notification
				notificationSave(array(), "<b>".$dataArray["user"]."</b> (consultor) foi adicionado no sistema.", "consultants.php");	
			}	
		}
		
		// And we confirm the insertion
		if ($insert) {
			echo "true";
		}
		
	} else 

// ----------------------------------------------------------------------------------- //	
	{}


?>