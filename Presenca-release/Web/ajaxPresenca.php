<?php include_once("includes/loginCheck.php"); ?>
<?php

	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
	
	// Lembre-se de fazer decode do array recebido pelo jquery

	// Default message
	$mensagem = "<h1 style='color:red'>Ops, algum erro ocorreu. Tente novamente!</h1>";
	
// -------------------------------------- GENERAL -------------------------------------- //
	
	if ((isset ($_POST['cellText'])) && (isset ($_POST['date']))) {
	 	$mensagem = $core->printTextForDate(htmlentities($_POST['date']));
	} else

	//	TOKENID	STATE //
	if (isset ($_POST['computerState']) && isset ($_POST['tokenID'])) {
		
		$computerState = getAttribute($_POST['computerState']);
		$tokenID = getAttribute($_POST['tokenID']);

		// Verify if the given string is valid
		if (strlen($tokenID) == 60) {
			$result = $core->resourceForQuery("SELECT `tokenID` FROM `plantaoToken` WHERE `enterpriseID`=$core->enterpriseID AND `tokenID`='$tokenID'");

			if (mysql_num_rows($result) == 1) {
				$mensagem = "true";
			}
		}
	
	} else 
	
// ----------------------------------------------------------------------------------- //

// -------------------------------------- MENU --------------------------------------- //
	
	//	COPYING A TABLE ---- REQUEST	//
	if ((isset ($_POST['copyButton']))) {
		?>Copiar tabela de <input type="text" id="numberWeeks" value="1" /> semanas atrás
		<input type="button" id="copyTableButton" value="Copiar!" /><?php
		
		$mensagem = '';
	} else 
	
	//	COPYING A TABLE ---- CONFIRM	//
	if ((isset ($_POST['copyTable'])) && (isset ($_POST['fromShift']))) {
		$weeks = intval(htmlentities(utf8_decode($_POST['fromShift'])));
		$core->weekFromNow = htmlentities(utf8_decode($_POST['copyTable']));

		// We need to check both for security and for reliability
		if ($core->group == 3 || $core->level >= 10) {
		
			$numDays = ($core->weekFromNow - $weeks)*7;

			$result = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE DATE(date) = DATE(DATE_ADD('$core->monday', INTERVAL '$numDays' DAY)) AND `enterpriseID`=$core->enterpriseID");
			
			// We gotta see if we have the selected week, otherwise we cannot copy it!
			if (mysql_num_rows($result) != 0) {
				// We delete all the rows of the previous week
				$core->resourceForQuery("DELETE FROM $core->tableShift WHERE DATE(date) >= DATE(DATE_ADD('$core->monday', INTERVAL '".($core->weekFromNow*7)."' DAY)) AND DATE(date) <= DATE(DATE_ADD('$core->monday', INTERVAL '".(6 + $core->weekFromNow*7)."' DAY)) AND `enterpriseID`=$core->enterpriseID");
			
			    for ($j = 0; $j < 5; $j++) {
			        for ($i = 0; $i < 10; $i++) {
			            if ($i != 4) {
			            	// We select the previous data
			            	$result = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `date` = DATE_ADD(DATE_ADD('$core->monday', INTERVAL '".($j + $numDays)."' DAY), INTERVAL '$i' HOUR) AND `enterpriseID`=$core->enterpriseID");
			            	
			            	for ($k = 0; $k < mysql_num_rows($result); $k++) {
				            	$userBD = mysql_result($result, $k, "user");
				                $core->resourceForQuery("INSERT INTO $core->tableShift (`enterpriseID`, `date`, `user`) VALUES ($core->enterpriseID, DATE_ADD(DATE_ADD('$core->monday', INTERVAL '".($j + $core->weekFromNow*7)."' DAY), INTERVAL '$i' HOUR), '$userBD')");
				             	
				                $core->notificationSave(array($userBD), "<b>$core->user</b> lhe adicionou no plantão.", "presenca.php");
			            	}
			            }
			        }
			    }
			    
			    $mensagem = "<img src='images/48-check.png'>";
			}
		}

	} else 
	
	//	REVIEW EXPLANATIONS ---- REQUEST	//
	if ((isset ($_POST['reviewButton']))) {
		
		// We select all entries that still haven't been evaluated
		$result = $core->resourceForQuery("SELECT * FROM $core->tableExplanationsUsers ORDER BY id DESC");
		
		for ($k = 0; $k < mysql_num_rows($result); $k++) {
			$dateID = mysql_result($result, $k, "dateID");
			$justificationID = mysql_result($result, $k, "justificationID");
			$penalty = mysql_result($result, $k, "penalty");
			$justificationText = "";
			
			if ($justificationID == 0) {
				$justificationText = mysql_result($result, $k, "justificationText");
			} else {
				$resultJustification = $core->resourceForQuery("SELECT * FROM $core->tableExplanationsDefault WHERE `id`=$justificationID");
				$justificationText = utf8_encode(mysql_result($resultJustification, 0, "explanation"));
			}
			
			$resultDate = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `id`=$dateID AND `enterpriseID`=$core->enterpriseID");
			
			// Date gotta still be present there and must belong to the right enterprise
			if (mysql_num_rows($resultDate) != 0) {
				$userID = mysql_result($resultDate, 0, "user");
				$date = mysql_result($resultDate, 0, "date");
				$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `id`=$userID");
				$user = mysql_result($resultUser, 0, "user");
				
				?><div id="reviewBox">
					<div id="handBox" class="floatRight pointer">
						<img src="images/48-hand-contra.png" <?php if ($penalty == 2) echo "class='handSelected'" ?> alt="Contra" id="handContraButton"/>
						<img src="images/48-hand-pro.png" <?php if ($penalty == 1) echo "class='handSelected'" ?> alt="Pro" id="handProButton"/>
					</div>
					<?php echo $user ?> enviou a seguinte justificativa<br />
					<span id="justificationTextPresentation"><?php echo $justificationText ?></span><br />
					por não estar presente em <?php echo date("j/n/y G:i", strtotime($date)) ?>.
					<input type='hidden' id='dateID' value='<?php echo $dateID ?>' />
				</div><?php
			}
			
		}
		
		$mensagem = '';
	} else 
	
	//	REVIEW EXPLANATIONS ---- CONFIRM	//
	if ((isset ($_POST['confirmReview'])) && (isset ($_POST['decision']))) {
		
		
		if ($core->group == 3 || $core->level >= 10) {
			$dateID = htmlentities($_POST['confirmReview']);
			$decision = htmlentities($_POST['decision']);
			
			$decision = ($decision == 1) ? 1 : 2;
			
			$insert = $core->resourceForQuery("UPDATE $core->tableExplanationsUsers SET `status`=1, `penalty`=$decision, `reviewedDate` = NOW() WHERE `dateID`=$dateID");
	
			if ($insert) {
			
				$newUserID = $core->getUserIDForDateID($dateID);
				$core->notificationSave(array($newUserID), "<b>$core->user</b> avaliou sua justificativa.", "presenca.php");
				
				?><img src="images/48-hand-contra.png" <?php if ($decision == 2) echo "class='handSelected'" ?> alt="Contra" id="handContraButton"/>
						<img src="images/48-hand-pro.png" <?php if ($decision == 1) echo "class='handSelected'" ?> alt="Pro" id="handProButton"/><?php
				$mensagem = "";
			} else {
				$mensagem = "<img src='images/48-cross.png'>";
			}
		}

	} else 
	
	//	CHANGING WEEKS	//
	if (isset ($_POST['shiftWeek'])) {
		
		// Get the week
		$core->weekFromNow = htmlentities(utf8_decode($_POST['shiftWeek']));

		// Print it
		$core->printTable();
		
		$mensagem = '';
	} else 
	
	//	TOOGLE THE TOKENID	//
	if (isset ($_POST['toggleToken']) && isset ($_POST['tokenID'])) {
		
		$toggleToken = getAttribute($_POST['toggleToken']);
		$tokenID = getAttribute($_POST['tokenID']);

		if ($core->level >= 10) {

			if (strlen($tokenID) != 60) {
				// We need to generate a new tokenID
				do {
					$sessionKey = Bcrypt::hash(mt_rand(1, mt_getrandmax()));
					$resultSession = $core->resourceForQuery("SELECT * FROM `plantaoToken` WHERE `tokenID`='$sessionKey'");
				} while (mysql_num_rows($resultSession) != 0);

				// When we find the id, we store it on our database
				$insert = $core->resourceForQuery("INSERT INTO  `plantaoToken` (`enterpriseID`, `tokenID`) VALUES ($core->enterpriseID, '$sessionKey')");

				echo $sessionKey;
			} else {
				// Just delete if from our database
				$remove = $core->resourceForQuery("DELETE FROM  `plantaoToken` WHERE `enterpriseID`=$core->enterpriseID AND `tokenID`='$tokenID'");

				if ($remove) {
					echo "true";
				}
			}
		}
		
		$mensagem = '';
	} else 

// ----------------------------------------------------------------------------------- //

// -------------------------------------- TABLE -------------------------------------- //
	
	//  START AND FINISH SHIFT //
	if ((isset ($_POST['confirm']))) {
	
		$mensagem = "<img src='images/48-cross.png'>";

		$tokenID = getAttribute($_POST['tokenID']);

		// Verify if the given string is valid
		if (strlen($tokenID) == 60) {
			$result = $core->resourceForQuery("SELECT `tokenID` FROM `plantaoToken` WHERE `enterpriseID`=$core->enterpriseID AND `tokenID`='$tokenID'");

			if (mysql_num_rows($result) == 1) {

				$today = getdate();
				$now = date("c");
				$hourNow = date("c", mktime($today["hours"], 0, 0, $today["mon"], $today["mday"], $today["year"]));
			
				// If the user is going to login 5 minutes before the hour starts, we have to alter the hourNow to the next hour, since his shift begins on the next hour 
				if ($today["minutes"] >= 55) {
					$hourNow = date("c", mktime($today["hours"] + 1, 0, 0, $today["mon"], $today["mday"], $today["year"]));
				}

				// Get his id
				$userID = $core->idForUser($core->user);
				$insert = false;
				
				// Search for the shift
		        $resultStatus = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `date`='$hourNow' AND user='$userID' AND status='0' AND `enterpriseID`=$core->enterpriseID");

		        // If there is only one
				if (mysql_num_rows($resultStatus) == 1) {
					// We write it to 1 (logged in)
					$insert = $core->resourceForQuery("UPDATE $core->tableShift SET status=status+1 WHERE `date`='$hourNow' AND `user`='$userID' AND `enterpriseID`=$core->enterpriseID");
				} else {
					// Otherwise we look to the end of the shift
		        	$hourLast = date("c", mktime($today["hours"] - 1, 0, 0, $today["mon"], $today["mday"], $today["year"]));

		        	// Searching for it
			        $resultStatus = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `date`='$hourLast' AND `user`='$userID' AND `status`='1'");
					
					// If there is only one
			        if (mysql_num_rows($resultStatus) == 1) {
			        	// We write it to 2 (logged in and logged out)
			            $insert = $core->resourceForQuery("UPDATE $core->tableShift SET status=status+1 WHERE `date`='$hourLast' AND `user`='$userID' AND `enterpriseID`=$core->enterpriseID");
			        }
			    }

				if ($insert) {
					$mensagem = "<img src='images/48-check.png'>";
				}
			}
		}
		
	} else
	
	// CHANGING AN USER SHIFT ---- REQUEST	//
	if ((isset ($_POST['usersList'])) && (isset ($_POST['date']))) {
	
		// Get the data		
		$dateID = htmlentities($_POST['date']);

		// Select the given data on the database
		$result = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE id='$dateID' AND `enterpriseID`=$core->enterpriseID");
		
		// Get the first result		
		if (mysql_num_rows($result) > 0) {
			$date = mysql_result($result, 0, "date");
			$userCell = $core->userForId(mysql_result($result, 0, "user")); // That is a name
			
			$mensagem = "<select id='confirmSelect'>";
			
			// Select all the users from the enterprise
			$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `enterpriseID`=$core->enterpriseID ORDER BY `user`");
			
			// Loop through them and append to the select element
			for ($i = 0; $i < mysql_num_rows($resultUser); $i++) {
				$userDB = mysql_result($resultUser, $i, "user");
				$userID = mysql_result($resultUser, $i, "id");
				$mensagem .= "<option ";
				if ($userDB == $userCell) { $mensagem .= "selected "; }
				$mensagem .= "value='$userID'>$userDB</option>";
			}
			
			// Create the control buttons
			$mensagem .= "</select><br><input type='hidden' id='dateID' value='$dateID' /><input type='button' id='confirmButton' value='Confirmar' /><br><br>";
			$mensagem .= "<img class='imgCellControl' id='addUserToCell' src='images/48-sq-plus.png'>";
			
			// And check if there is more than one user, so we can offer the delete button
			$resultDelete = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `date`='$date' AND `enterpriseID`=$core->enterpriseID");
			if (mysql_num_rows($resultDelete) > 1) {
				$mensagem .= "<img class='imgCellControl' id='removeUserFromCell' src='images/48-sq-minus.png'>";
			}
		}
	} else 
		
	//	CHANGING AN USER SHIFT ---- CONFIRM	//
	if ((isset ($_POST['changeUser'])) && (isset ($_POST['date']))) {
	
		if ($core->group == 3 || $core->level >= 10) {
		
			$userID = htmlentities(utf8_decode($_POST['changeUser']));
			$dateID = htmlentities($_POST['date']);
			
			$check = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `id`='$userID' AND `enterpriseID`=$core->enterpriseID");
			
			if (mysql_num_rows($check) == 1) {
				
				// Notify the user that will be removed
				$oldUserID = $core->getUserIDForDateID($dateID);
				$core->notificationSave(array($oldUserID), "<b>$core->user</b> lhe removeu do plantão.", "presenca.php");
			
				// Make the update
				$insert = $core->resourceForQuery("UPDATE $core->tableShift SET `user`='$userID' WHERE `id`='$dateID' AND `enterpriseID`=$core->enterpriseID");
				
				// And notify the user that was added
				$newUserID = $core->getUserIDForDateID($dateID);
				$core->notificationSave(array($newUserID), "<b>$core->user</b> lhe adicionou no plantão.", "presenca.php");
			}
	
			$mensagem = $core->printTextForDate(htmlentities($_POST['date']));
		}
		
	} else 
	
	//	ADDING AND REMOVING USER FROM SHIFT	//
	if ((isset ($_POST['addRemoveUserToCell'])) && (isset ($_POST['date']))) {
	
		if ($core->group == 3 || $core->level >= 10) {
	
			$type = htmlentities($_POST['addRemoveUserToCell']);
			$dateID = htmlentities($_POST['date']);
			$result = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `id`='$dateID' AND `enterpriseID`=$core->enterpriseID");
			$date = mysql_result($result, 0, "date");		

			// DELETE MODE
			if ($type == 0) {
				// We already make a query that will not select the deletable element, so we can recover any of its siblings really easy
				$result = $core->resourceForQuery("SELECT * FROM $core->tableShift WHERE `date`='$date' AND `id` != '$dateID' AND `enterpriseID`=$core->enterpriseID");
				
				if (mysql_num_rows($result) > 0) {
					// Notify the user about the fact
					$newUserID = $core->getUserIDForDateID($dateID);
					$core->notificationSave(array($newUserID), "<b>$core->user</b> lhe removeu do plantão.", "presenca.php");
					
					// We delete the selected element
					$core->resourceForQuery("DELETE FROM $core->tableShift WHERE `id`='$dateID' AND `enterpriseID`=$core->enterpriseID");
					
					// and then we choose another sibling to redraw the cell
					$dateID = mysql_result($result, 0, "id");

				}
			// INSERT MODE
			} elseif ($type == 1) {			
				$core->resourceForQuery("INSERT INTO $core->tableShift (`enterpriseID`, `date`, `user`) VALUES ($core->enterpriseID, '$date', 1)");
			}
			
			$mensagem = $core->printTextForDate($dateID);
		}
		
		
	} else
	
	//	ADD EXPLANATION ---- REQUEST	//
	if ((isset ($_POST['paperAirplane']))) {
		
		$dateID = htmlentities($_POST['paperAirplane']);
		
		?>
		
		<div id="justificationBox">
			No dia selecionado, não pude cumprir meu horário de plantão pois<br />
			<select id="justificationID">
				<?php
				$result = $core->resourceForQuery("SELECT * FROM $core->tableExplanationsDefault ORDER BY id");

				for ($i = 0; $i < mysql_num_rows($result); $i++) {
					$explanation = mysql_result($result, $i, "explanation");
					// We need because the data was written directly in the database (which is in Portuguese), so we need to encode it to UFT8
					echo utf8_encode("<option value='".($i+1)."'>$explanation</option>");
				}					
				?>
				<option value='0'>Outros</option>
			</select><br />
			<div id="justificationTextBox">
				<input type="text" id="justificationText" placeholder="Escreva aqui sua justificativa!" /><br />
			</div>
			<input type="button" id="addExplanationButton" value="Confirmar!" />
			<input type='hidden' id='dateID' value='<?php echo $dateID ?>' />
		</div><?php
		
		$mensagem = '';
	} else 
	
	//	ADD EXPLANATION ---- CONFIRM	//
	if ((isset ($_POST['addExplanationButton'])) && (isset ($_POST['justificationID'])) && (isset ($_POST['justificationText']))) {
		
		$justificationID = htmlentities($_POST['justificationID']);
		$dateID = htmlentities($_POST['addExplanationButton']);
		$justificationText = "";
		
		if ($justificationID == 0) {
			$justificationText = htmlentities(utf8_decode($_POST['justificationText']));
		}
		
		$insert = false;
		
		$insert = $core->resourceForQuery("INSERT INTO $core->tableExplanationsUsers (`dateID`, `justificationID`, `justificationText`, `status`, `penalty`) VALUES ('$dateID', '$justificationID', '$justificationText', 0, 0)");
		
		
		if ($insert) {
			$mensagem = "<img src='images/48-check.png'>";
		} else {
			$mensagem = "<img src='images/48-cross.png'>";
		}
	} else
	
// ----------------------------------------------------------------------------------- //	

	{}
	
	
	

	echo $mensagem;

?>