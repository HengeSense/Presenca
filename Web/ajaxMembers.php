<?php include_once("includes/loginCheck.php"); ?>
<?php

	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
	
	// Lembre-se de fazer decode do array recebido pelo jquery

// -------------------------------------- MENU --------------------------------------- //
	
	if ((isset ($_POST['searchQuery']))) {
		$searchText = trim(htmlentities(utf8_decode($_POST['searchText'])));
		
		$core->printBadgeForSearch($searchText);
		
		
	} else 


// -------------------------------------- MEMBERS --------------------------------------- //

	/**
	 * Extra container, usually for details
	 */
	if (isset ($_POST['infoContainerExtra']) && isset ($_POST['memberID'])) {
		
		$id = trim(htmlentities(utf8_decode($_POST['memberID'])));

    	$result = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `id`='$id' AND `enterpriseID`=$core->enterpriseID");

		for ($i = 0; $i < mysql_num_rows($result); $i++) {
		
			$birthday = mysql_result($result, 0, "birthday");
			$telephone = mysql_result($result, 0, "telephone");
			$email = mysql_result($result, 0, "email");
			$active = mysql_result($result, 0, "active");
			$groupID = mysql_result($result, 0, "groupID");
			
			$resultGroup = $core->resourceForQuery("SELECT * FROM $core->tableGroup WHERE `id`='$groupID' AND `enterpriseID`=$core->enterpriseID");
			$group = mysql_result($resultGroup, 0, "name");
			
			?>
			
			<p class="general"><span class="bold">Grupo:</span> <span class="infoContainerSelectContent" title="groupID"><?php echo $group ?></span></p>
			<p class="general"><span class="bold">Aniversário:</span> <span class="infoContainerInputContent" title="birthday"><?php echo date("j/n/Y", strtotime($birthday)) ?></span></p>
			<p class="general"><span class="bold">Telefone:</span> <span class="infoContainerInputContent" title="telephone"><?php echo $telephone ?></span></p>
			<p class="general"><span class="bold">Email:</span> <span class="infoContainerInputContent" title="email"><?php echo $email ?></span></p>
			
			<div class="badgeHistory">
			
				<?php
					$result = $core->resourceForQuery("SELECT * FROM $core->tableUserHistory WHERE memberID='$id'");
					
					for ($i = 0; $i < mysql_num_rows($result); $i++) {
						$historyDate = mysql_result($result, $i, "historyDate");
						$historyText = mysql_result($result, $i, "historyText");
				?>
						<p class="date"><?php echo date("j/n/Y", strtotime($historyDate)) ?></p>
						<p class="text"><?php echo $historyText ?></p>

				<?php
					} 
				?>
				<?php if ($core->group == 3 /* RH */ || $core->level >= 10) { ?>
					<div class="badgeNewEvent saveButton">Adicionar novo evento</div>
				<?php } ?>
			
			</div>
			
			<div class="infoContainerSave badgeSave saveButton">Salvar!</div>
			<div class="saveButtonError"></div>
			
			<?php if ($core->group == 3 /* RH */ || $core->level >= 10) { ?>
				<div class="badgeActive">
					<ul><li><?php if ($active == 0) { echo("Ativar membro"); } else { echo("Arquivar membro"); } ?></li></ul>
				</div>
			<?php } ?>
			
			<?php if ($core->level >= 10) { ?>
				<div class="badgeChangePassword">
					<ul><li>Trocar senha</li></ul>
				</div>
			<?php } ?>	

		<?php
		}

	} else 
	
	/**
	 * 	Saving a badge (insertion and update)
	 */
	if (isset ($_POST['saveForm']) && isset ($_POST['memberID'])) {
		
		// We receive ther data
		$data = $_POST['data']; // We still gotta filter it
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		//var_dump($data);
		
		$insert = false;
		
		if ($core->group == 3 /* RH */ || $core->level >= 10 /* SUPER USER */ || $core->userID == $memberID) {
			// Update card
			if ($memberID != "0") {

				// Array for name check (we don't include historyDate because we only save it if we have the text counterpart)
				$possibleNames = array("user", "position", "groupID", "photo", "birthday", "telephone", "email", "historyText");
				
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
							$insert = $core->resourceForQuery("UPDATE $core->tableUser SET $name = STR_TO_DATE('$value','%d/%m/%Y') WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
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
								$resultGroup = $core->resourceForQuery("SELECT * FROM $core->tableGroup WHERE `name`='$value' AND `enterpriseID`=$core->enterpriseID");
								$value = mysql_result($resultGroup, 0, "id");
							}
						
							// And then insert it on the server
							$insert = $core->resourceForQuery("UPDATE $core->tableUser SET $name = '$value' WHERE `id`='$memberID' AND `enterpriseID`=$core->enterpriseID");
						}
					}
				}
				
				// And now we can save the notification
				$core->notificationSave(array($memberID), "<b>$core->user</b> alterou seus dados.", "members.php");

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

				// BUG  BUG   BUG   BUG
				// For a while, we'll select the default group on the enterprise
				
				$resultGroup = $core->resourceForQuery("SELECT * FROM $core->tableGroup WHERE `enterpriseID`=$core->enterpriseID");
				$defaultGroupID = mysql_result($resultGroup, 0, "id");

				$query = ("INSERT INTO $core->tableUser (`enterpriseID`, `user`, `password`, `position`, `groupID`, `level`, `photo`, `birthday`, `telephone`, `email`, `active`) VALUES ($core->enterpriseID, '" . $dataArray["user"] . "', '" . Bcrypt::hash($dataArray["password"]) . "', '" . $dataArray["position"] . "', $defaultGroupID, 1, '" . $dataArray["photo"] . "', STR_TO_DATE('" . $dataArray["birthday"] . "','%d/%m/%Y'), '" . $dataArray["telephone"] . "', '" . $dataArray["email"] . "', 1)");

				$insert = $core->resourceForQuery($query);
				// And now we can save the notification
				$core->notificationSave(array(), "<b>".$dataArray["user"]."</b> foi adicionado no sistema.", "members.php");
			}
		}
		
		// And we confirm the insertion
		if ($insert) {
			echo "true";
		}
		
	} else 
	
	/**
	 * Get all groups as a select element
	 */
	if (isset ($_POST['groupAsSelect'])) {		
		$core->printGroupAsSelect();
	
	} else
	
	/**
	 * Update group member
	 */
	if (isset ($_POST['updateMemberActive'])) {
		
		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		
		if ($core->group == 3 || $core->level >= 10) {
			
			$result = $core->resourceForQuery("SELECT `active` FROM $core->tableUser WHERE `id`=$memberID");
			$active = mysql_result($result, 0, "active");
			
			if ($active == 0) {
				$active = 1;
				$activeMessage = "ativo";
			} else {
				$active = 0;
				$activeMessage = "inativo";
			}
		
			$update = $core->resourceForQuery("UPDATE $core->tableUser SET `active`=$active WHERE `id`=$memberID");
			
			$core->notificationSave(array($memberID), "<b>$core->user</b> lhe tornou $activeMessage.", "groups.php");	
			
			// And we confirm the insertion
			if ($update) {
				echo "true";
			}
		}

	} else
	
	/**
	 * Changing a member's password
	 */
	if (isset ($_POST['changeMemberPassword']) && isset ($_POST['memberID']) && isset ($_POST['newPassword'])) {

		$memberID = trim(htmlentities(utf8_decode($_POST['memberID'])));
		$newPassword = trim(htmlentities(utf8_decode($_POST['newPassword'])));

		/* ONLY SUPER USERS */
		if ($core->level >= 10) {
			// Update the password on the database
			$query = "UPDATE $core->tableUser SET `password` = '" . Bcrypt::hash($newPassword) . "' WHERE `id`=$memberID";
			$update = $core->resourceForQuery($query);
		}

		if ($update) {
			echo "true";
		}

	} else

// ----------------------------------------------------------------------------------- //	
	{}


?>