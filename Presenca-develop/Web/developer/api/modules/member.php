<?php
// -------------------------------------- MEMBER --------------------------------------- //

	if ($method === "signIn") {
	
		if (isset ($_GET['name']) && isset ($_GET['password'])) {
			$name = getAttribute($_GET['name']);
			$password = getAttribute($_GET['password']);

			$remote = $_SERVER['REMOTE_ADDR'];

			$result = resourceForQuery(
				"SELECT
					`member`.`id`,
					`member`.`name`,
					`member`.`password`,
					`member`.`sessionKey`,
					`member`.`sessionAmount`
				FROM
					`member`
				WHERE
					BINARY `member`.`name` = '$name'
			");

			if (mysql_num_rows($result) == 1) {

				$hash = mysql_result($result, 0, "password");

				if (Bcrypt::check($password, $hash)) {
					$core->auth = true;
					$core->name = mysql_result($result, 0, "name");
					$core->memberID = mysql_result($result, 0, "id");

					// Allow to log in on up to three places at the same time
					if (mysql_result($result, 0, "sessionAmount") < 2) {
						$sessionKey = mysql_result($result, 0, "sessionKey");

						$insert = resourceForQuery(
							"UPDATE
								`member`
							SET
								`member`.`sessionAmount` = `sessionAmount`+1
							WHERE
								`member`.`id` = $core->memberID
						");
					} else {
						// Create a unique random id for the given session
						do {
							$sessionKey = Bcrypt::hash($hash);
							$resultSession = resourceForQuery(
								"SELECT
									`member`.`id`
								FROM
									`member`
								WHERE
									`member`.`sessionKey` = '$sessionKey'
							");
						} while (mysql_num_rows($resultSession) != 0);

						// When we find the id, we store it on our database
						$insert = resourceForQuery(
							"UPDATE
								`member`
							SET
								`member`.`sessionKey` = '$sessionKey',
								`member`.`sessionAmount` = 0
							WHERE
								`member`.`id` = $core->memberID
						");
					}

					// Only authenticate if the insertion was carried correctly
					if ($insert) {
						// Reset the login count
						$insert = resourceForQuery(
							"UPDATE
								`loginAttempts`
							SET
								`loginAttempts`.`attempts` = 0,
								`loginAttempts`.`date` = NOW()
							WHERE
								`loginAttempts`.`remote` = INET_ATON('$remote')
						");

						// Return some information
						$data["name"] = $name;
						$data["tokenID"] = $sessionKey;
						
						echo json_encode($data);
					} else {
						http_status_code(500);
					}
				} else {
					resourceForQuery(
						"UPDATE
							`loginAttempts`
						SET
							`loginAttempts`.`attempts` = `attempts`+1,
							`loginAttempts`.`date` = NOW()
						WHERE
							`loginAttempts`.`remote` = INET_ATON('$remote')
					");

					http_status_code(401);
				}
			} else {
				resourceForQuery(
					"UPDATE
						`loginAttempts`
					SET
						`loginAttempts`.`attempts` = `attempts`+1,
						`loginAttempts`.`date` = NOW()
					WHERE
						`loginAttempts`.`remote` = INET_ATON('$remote')
				");

				http_status_code(401);
			}
		} else {
			http_status_code(400);
		}
	} else 

	if ($method === "getNumberOfMembers") {

		echo informationCountForEnterpriseID("member", $core->companyID, "&& `name` != '-'", $format);
		
	} else
	
	if ($method === "getMembers") {

		echo informationForEnterpriseID("member", $core->companyID, "&& `name` != '-'", $format);
		
	} else 
	
	if ($method === "getSingleMember") {

		if (isset ($_GET['memberID'])) {
			$memberID = getAttribute($_GET['memberID']);

			echo informationForEnterpriseIDForUniqueID("member", $core->companyID, $memberID, "&& `name` != '-'", $format);
		} else {
			http_status_code(400);
		}

	} else 
	
	if ($method === "createMember") {

		if (isset ($_GET['name']) && isset ($_GET['password'])) {
			$name = getAttribute($_GET['name']);
			$password = getAttribute($_GET['password']);

			if ($core->permission >= 10) {

			} else {
				http_status_code(401);	
			}
			
		} else {
			http_status_code(400);
		}
		
	} else 
	
	if ($method === "updateMember") {
		
		if (isset ($_GET['details'])) {
			$details = getAttribute($_GET['details']);
		
			if ($core->permission >= 10) {

			} else {
				http_status_code(401);	
			}

		} else {
			http_status_code(400);
		}
		
	} else
		
	{ http_status_code(501); }
	
// ------------------------------------------------------------------------------------------- //

?>