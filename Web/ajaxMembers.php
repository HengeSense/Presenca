<?php include_once("includes/check/login.php"); ?>
<?php

	if (!$core->auth) logout();

// -------------------------------------- MENU --------------------------------------- //
	
	if ((isset($_POST['searchQuery']))) {
		$searchText = getAttribute($_POST['searchText']);
		
		printMemberForSearch($core->companyID, $searchText);
		
	} else 

// -------------------------------------- MEMBERS --------------------------------------- //

	/**
	 * Extra container, usually for details
	 */
	if (isset($_POST['infoContainerExtra']) && isset($_POST['memberID'])) {
		
		$memberID = getAttribute($_POST['memberID']);

    	$result = resourceForQuery(
    		"SELECT
    			`member`.`birthday`,
    			`member`.`telephone`,
    			`member`.`email`,
    			`member`.`active`,
    			`group`.`name` AS `group`
    		FROM
    			`member`
    		LEFT JOIN
    			`group` ON `group`.`id` = `member`.`groupID`
    		WHERE 1
    			AND `member`.`id` = $memberID
    			AND `member`.`companyID` = $core->companyID
    	");

    	if (mysql_num_rows($result) > 0) {
		
			$birthday = mysql_result($result, 0, "birthday");
			$telephone = mysql_result($result, 0, "telephone");
			$email = mysql_result($result, 0, "email");
			$active = mysql_result($result, 0, "active");
			$group = mysql_result($result, 0, "group");
			
			?>
			
<!-- 			<p class="general">
				<span class="bold">Grupo:</span>
				<span class="infoContainerSelectContent" data-placeholder="Grupo" title="groupID"><?php echo $group ?></span>
			</p> -->
			<p class="general">
				<span class="bold">Aniversário:</span>
				<span class="infoContainerInputContent" data-placeholder="Aniversário" title="birthday"><?php echo date("j/n/Y", strtotime($birthday)) ?></span>
			</p>
			<p class="general">
				<span class="bold">Telefone:</span>
				<span class="infoContainerInputContent" data-placeholder="Telefone" title="telephone"><?php echo $telephone ?></span>
			</p>
			<p class="general">
				<span class="bold">Email:</span>
				<span class="infoContainerInputContent" data-placeholder="Email" title="email"><?php echo $email ?></span>
			</p>
			
			<div class="badgeHistory">
			
				<?php
					$result = resourceForQuery(
						"SELECT
							`memberHistory`.`historyDate`,
							`memberHistory`.`historyText`
						FROM
							`memberHistory`
						WHERE 1
							AND `memberHistory`.`memberID` = $memberID
					");
					
					for ($i = 0; $i < mysql_num_rows($result); $i++) {
						$historyDate = mysql_result($result, $i, "historyDate");
						$historyText = mysql_result($result, $i, "historyText");
						?>
						
						<p class="date"><?php echo date("j/n/Y", strtotime($historyDate)) ?></p>
						<p class="text"><?php echo $historyText ?></p>
						
						<?php
					} 
				?>
				<?php if ($core->groupID == 3 /* RH */ || $core->permission >= 10) { ?>
					<div class="badgeNewEvent saveButton">Adicionar novo evento</div>
				<?php } ?>
			
			</div>
			
			<div class="infoContainerSave badgeSave saveButton">Salvar!</div>
			<div class="saveButtonError"></div>
			
			<?php if ($core->groupID == 3 /* RH */ || $core->permission >= 10) { ?>
				<div class="badgeActive">
					<ul><li><?php if ($active == 0) { echo("Ativar membro"); } else { echo("Arquivar membro"); } ?></li></ul>
				</div>
			<?php } ?>
			
			<?php if ($core->permission >= 10) { ?>
				<div class="badgeChangePassword">
					<ul><li>Trocar senha</li></ul>
				</div>
			<?php } ?>	

		<?php
		} else {
			http_status_code(400);
		}

	} else 
	
	/**
	 * 	Saving a badge (insertion and update)
	 */
	if (isset($_POST['saveForm']) && isset($_POST['memberID'])) {
		
		// We receive ther data
		$data = getAttribute($_POST['data']);
		$memberID = getAttribute($_POST['memberID']);
		
		if ($core->groupID == 3 /* RH */ || $core->permission >= 10 /* SUPER USER */ || $core->memberID == $memberID) {
			// Update card
			if ($memberID != "0") {

				// Array for name check (we don't include historyDate because we only save it if we have the text counterpart)
				$possibleNames = array("name", "position", "groupID", "photo", "birthday", "telephone", "email", "historyText");
				
				// Loop through it
				for ($i = 0; $i < count($data); $i++) {
					$object = $data[$i];
					// Retrieve the values of each one
					$name = $object['name'];
					$value = $object['value'];
					
					// Make the name check (for security)
					if (in_array($name, $possibleNames) == TRUE) {
					
						// We process the exceptions
						if ($name == "birthday") {
							$insert = resourceForQuery(
								"UPDATE
									`member`
								SET 
									`$name` = STR_TO_DATE('$value','%d/%m/%Y')
								WHERE 1
									AND `member`.`id` = $memberID
									AND `member`.`companyID` = $core->companyID
							");

							if (!$insert) http_status_code(500);
							
						} elseif ($name == "historyText" && $value != "") {
							// If we receive the text, we must be sure that the data has come too, so we search for it
							for ($j = 0; $j < count($data); $j++) {
								if ($data[$j]["name"] == "historyDate") {
									$valueDate = $data[$j]["value"];
									$insert = resourceForQuery(
										"INSERT INTO 
											`memberHistory` (
												`memberID`,
												`historyDate`,
												`historyText`
											) 
											VALUES (
												$memberID,
												STR_TO_DATE('$valueDate','%d/%m/%Y'),
												'$value'
											)
									");

									if (!$insert) http_status_code(500);
								}
							}
						} else {
							if ($name == "group") {
								$result = resourceForQuery(
									"SELECT
										`group`.`id`
									FROM
										`group`
									WHERE 1
										AND `group`.`name` = '$value'
										AND `group`.`companyID` = $core->companyID
								");
								$value = mysql_result($result, 0, "id");
							}
						
							// And then insert it on the server
							$insert = resourceForQuery(
								"UPDATE
									`member`
								SET
									`$name` = '$value'
								WHERE 1
									AND `member`.`id` = $memberID
									AND `member`.`companyID` = $core->companyID
							");

							if (!$insert) http_status_code(500);
						}
					} else {
						http_status_code(411);
					}
				}
				
				// And now we can save the notification
				notificationSave(array($memberID), "<b>$core->name</b> alterou seus dados.", "members.php");

			// New card			
			} else {
				// Array that will hold data as we want
				$parsedData = array();
				
				// Loop through it
				for ($i = 0; $i < count($data); $i++) {
					$object = $data[$i];
					// Retrieve the values of each one
					$name = $object['name'];
					$value = $object['value'];
					
					$parsedData[$name] = $value;
				}

				$result = resourceForQuery(
					"SELECT
						`member`.`id`,
					FROM
						`member`
					WHERE 1
						AND BINARY `member`.`name` = '" . $parsedData["name"] . "'
				");

				// See if there is any person with the same name
				if (mysql_num_rows($result) == 0) {

					$insert = resourceForQuery(
						"INSERT INTO
							`member`(
								`companyID`, 
								`name`, 
								`password`, 
								`position`, 
								`groupID`, 
								`permission`, 
								`photo`, 
								`birthday`, 
								`telephone`, 
								`email`, 
								`active`
							) VALUES (
								$core->companyID, 
								'" . $parsedData["name"] . "', 
								'" . Bcrypt::hash($parsedData["password"]) . "', 
								'" . $parsedData["position"] . "',
								1,
								1, 
								'" . $parsedData["photo"] . "',
								STR_TO_DATE('" . $parsedData["birthday"] . "','%d/%m/%Y'), 
								'" . $parsedData["telephone"] . "', 
								'" . $parsedData["email"] . "', 
								1
							)
					");

					if (!$insert) http_status_code(500);

					// And now we can save the notification
					notificationSave(array(), "<b>" . $parsedData["name"] . "</b> foi adicionado no sistema.", "members.php");
				} else {
					http_status_code(412);
				}
			}
		} else {
			http_status_code(406);
		}
		
	} else 
	
	/**
	 * Get all groups as a select element
	 */
	if (isset($_POST['groupAsSelect'])) {		
		printGroupAsSelect();
	} else
	
	/**
	 * Update group member
	 */
	if (isset($_POST['updateMemberActive'])) {
		
		$memberID = getAttribute($_POST['memberID']);
		
		if ($core->group == 3 || $core->permission >= 10) {
			
			$result = resourceForQuery(
				"SELECT
					`member`.`active`
				FROM
					`member`
				WHERE
					`member`.`id` = $memberID
			");

			if (mysql_num_rows($result) == 1) {
				$active = mysql_result($result, 0, "active");
				
				if ($active == 0) {
					$active = 1;
					$activeMessage = "ativo";
				} else {
					$active = 0;
					$activeMessage = "inativo";
				}
			
				$update = resourceForQuery(
					"UPDATE
						`member`
					SET
						`member`.`active` = $active
					WHERE
						`member`.`id` = $memberID
				");
			
				notificationSave(array($memberID), "<b>$core->name</b> lhe tornou $activeMessage.", "groups.php");	
			
				// And we confirm the insertion
				if (!$update) http_status_code(500);

			} else {
				http_status_code(404);
			}
		} else {
			http_status_code(406);
		}

	} else
	
	/**
	 * Changing a member's password
	 */
	if (isset($_POST['changeMemberPassword']) && isset($_POST['memberID']) && isset($_POST['newPassword'])) {

		$memberID = getAttribute($_POST['memberID']);
		$newPassword = getAttribute($_POST['newPassword']);

		/* ONLY SUPER USERS */
		if ($core->permission >= 10) {
			// Update the password on the database
			$update = resourceForQuery(
				"UPDATE
					`member`
				SET
					`member`.`password` = '" . Bcrypt::hash($newPassword) . "'
				WHERE
					`member`.`id` = $memberID
			");

			if (!$update) http_status_code(500);

		} else {
			http_status_code(406);
		}

	} else

// ----------------------------------------------------------------------------------- //	

	{ http_status_code(501); }

?>