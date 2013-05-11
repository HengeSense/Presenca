<?php

class Core {

	// Date
    public $now;
    public $monday;
    public $weekFromNow = 0;
    
    // Tables
	public $tableEnterprise = "enterprise";    

    public $tableShift = "plantao";
	public $tableGroup = "groups";

	public $tableExplanationsDefault = "explanationsDefault";
    public $tableExplanationsPenalty = "explanationsPenalty";
	public $tableExplanationsUsers = "explanationsMembers";
	
	public $tableProject = "projects";
	public $tableProjectHistory = "projectsHistory";
	public $tableProjectStatus = "projectsStatus";
	public $tableProjectMembers = "projectsMembers";
	public $tableProjectClients = "projectsClients";
	public $tableProjectConsultants = "projectsConsultants";
	
	public $tableUser = "members";
	public $tableUserHistory = "membersHistory";
	
	public $tableNotificationCount = "notificationCount";
	public $tableNotificationGeneral = "notificationGeneral";
	public $tableNotificationMember = "notificationMember";
	
	public $tableClient = "clients";
	
	public $tableConsultant = "consultants";
	
	public $tablesPublic;

	// User settings
    public $logado = false;
    public $enterpriseID = 0;
    public $userID = 0;
    public $user = "";
    public $level = 0;
	public $group = 0;
    
    public $authenticatedMAC = false;
    private $allowedMAC = array("f4:6d:4:d6:7f:f");
    
    public function __construct() {
    	$this->now = getdate();
    	$this->monday = date("c", mktime(8, 0, 0, $this->now["mon"], $this->now["mday"] - $this->now["wday"] + 1, $this->now["year"]));
    	
    	
    	$this->tablesPublic = array($this->tableShift, $this->tableGroup, $this->tableExplanationsDefault, $this->tableExplanationsPenalty, $this->tableExplanationsUsers, $this->tableProject, $this->tableProjectHistory, $this->tableProjectStatus, $this->tableProjectMembers, $this->tableProjectClients, $this->tableProjectConsultants, $this->tableUser, $this->tableUserHistory, $this->tableNotificationCount, $this->tableNotificationGeneral, $this->tableNotificationMember, $this->tableClient, $this->tableConsultant);
    }
    
    public function getMac(){

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $macAddress = "33";
        
        if ($ipAddress == "::1") { // This is the localhost
        	return true;
        }
        
        #run the external command, break output into lines
        $arp = exec("arp $ipAddress");
        $lines = explode("\n", $arp);
        
        #look for the output line describing our IP address
        foreach($lines as $line) {
           $cols = preg_split('/\s+/', trim($line));
           $macAddress = $cols[3];	           
        }
        
     	return (in_array($macAddress, $this->allowedMAC));
    }

    /**
     * Wrapper to run a query, process any erros
     * @param  string 	$query 	Query
     * @return object 		query resource or boolean
     */
    public function resourceForQuery($query) {
    	$result = mysql_query($query) or trigger_error(mysql_error() . " " . $query);

    	return $result;
    }
    
    /**
     * Return the username for the given unique id
     * @param  integer $id unique id
     * @return string     username
     */
    public function userForId($id) {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `id`='$id'");

    	if (mysql_num_rows($result) != 0) {
    		return mysql_result($result, 0, "user");
    	}
    }
    
    /**
     * Return the unique id for a given username
     * @param  string $user username
     * @return integer       unique id
     */
    public function idForUser($user) {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `user`='$user'");

    	if (mysql_num_rows($result) != 0) {
    		return mysql_result($result, 0, "id");
    	}
    }

    /**
     * Truncate name of something if it is bigger than maxSize
     * @param  [string] $name    	Name to truncate
     * @param  [int] 	$maxSize 	Max size of the name
     * @return [string] 			Truncated name
     */
    public function truncateName($name, $maxSize, $delimiter = " ") {
		// If the name is too big, we gotta truncate it
		if (strlen(html_entity_decode($name)) > $maxSize) {
			$truncatedName = "";
			$nomes = explode($delimiter, $name);
			// We will truncate everything that comes after the given name
			for ($i = 0; $i < count($nomes); $i++) {
				if ($i == 0) {
					$truncatedName .= $nomes[$i] . " ";
				} else {
					$truncatedName .= substr($nomes[$i], 0, 1) . ". "; 
				}
			}

			// We now check it again
			if (strlen(html_entity_decode($truncatedName)) > $maxSize) {
				// If not, we truncate it right at the max size
				return substr($truncatedName, 0, $maxSize - 1) . ".";
			} else {
				return $truncatedName;
			}

		} else {
			return $name;
		}
    }
    
// ---------------------------------------- API -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //

    /**
     * Print the query result in a given output format
     * @param  string 	$table  table name
     * @param  resource $result query result
     * @param  boolean 	$data   enable data output
     * @param  string 	$format output format
     * @return object 			encoded data
     */
	public function printInformation($table, $result, $data, $format = "json") {
		$notificationText["count"] = mysql_num_rows($result);
		
		$secretFields = array("password", "level");

		if ($data == true) {
			$notificationText["data"] = array();
			
			for ($i = 0; $i < mysql_num_rows($result); $i++) {
			
				$row = mysql_fetch_row($result);
				// And then creating bindings by their variable name
				for ($j = 0; $j < mysql_num_fields($result); $j++) {
					$field = mysql_field_name($result, $j);
					
					if (in_array($field, $secretFields) == FALSE) {
						$notificationText["data"][$i][$field] = utf8_encode($row[$j]);
					}
				}
				
				// if ($table == $this->tableUser) {
				// 	$groupID = mysql_result($result, $i, "groupID");
				// 	$resultGroup = $this->resourceForQuery("SELECT * FROM $this->tableGroup WHERE id='$groupID'");
				// 	$notificationText["data"][$i]["group"] = array();

				// 	for ($k = 0; $k < mysql_num_rows($resultGroup); $j++) {
				// 		$notificationText["data"][$i]["group"][$k] = mysql_result($resultGroup, 0, "acronym");
				// 	}
				// }
				
			}
		}
		
		// We check the format and return the requested information
		if ($format == "json") {
			return json_encode($notificationText);
		} else 

		if ($format == "object") {
			return $notificationText;
		}
	}

	/**
	 * Query the given table and select the output format
	 * @param  string $table    table name
	 * @param  string $extraSql aditional sql parameters
	 * @param  string $format   output format
	 * @return object           encoded data
	 */
	public function informationForTable($table, $extraSql = '', $format) {

        $result = $this->resourceForQuery("SELECT * FROM $table $extraSql");

        return $this->printInformation($table, $result, true, $format);
    }
	
	/**
	 * Count the query result inside the given table inside a given enterprise and select the output format
	 * @param  string $table    			table name
	 * @param  integer $enterpriseID    enterprise id
	 * @param  string $extraSql 			aditional sql parameters
	 * @param  string $format   		output format
	 * @return object           		encoded data
	 */
	public function informationCountForEnterpriseID($table, $enterpriseID, $extraSql = '', $format) {
		
		$result = $this->resourceForQuery("SELECT * FROM $table WHERE `enterpriseID`=$enterpriseID $extraSql");
		
		return $this->printInformation($table, $result, false, $format);
	}
	
	/**
	 * Query the given table inside a given enterprise and select the output format
	 * @param  string $table    			table name
	 * @param  integer $enterpriseID    enterprise id
	 * @param  string $extraSql 			aditional sql parameters
	 * @param  string $format   		output format
	 * @return object           		encoded data
	 */
	public function informationForEnterpriseID($table, $enterpriseID, $extraSql = '', $format) {
		
		$result = $this->resourceForQuery("SELECT * FROM $table WHERE `enterpriseID`=$enterpriseID $extraSql");

		return $this->printInformation($table, $result, true, $format);
	}
	
	/**
	 * Query the given table inside a given enterprise using a unique id and select the output format
	 * @param  string $table    			table name
	 * @param  integer $enterpriseID    enterprise id
	 * @param  integer $uniqueID 		unique id
	 * @param  string $extraSql 			aditional sql parameters
	 * @param  string $format   		output format
	 * @return object           		encoded data
	 */
	public function informationForEnterpriseIDForUniqueID($table, $enterpriseID, $uniqueID, $extraSql = '', $format) {
		
		$result = $this->resourceForQuery("SELECT * FROM $table WHERE `enterpriseID`=$enterpriseID AND `id`=$uniqueID $extraSql");

		return $this->printInformation($table, $result, true, $format);
	}


    
// ------------------------------------ NOTIFICATION ------------------------------------ //

// -------------------------------------- -------- -------------------------------------- //

// -------------------------------------- -------- -------------------------------------- //

	/**
	 * Generic method for generating all notifications as JSON objects
	 * @param  [object] $result MySQL resource
	 * @return [object] JSON
	 */
	public function printNotifications($result) {
		$notificationText["count"] = 0;
		$notificationText["data"] = array();
		
		$statusCount = 0;
		
		for ($i = 0; $i < mysql_num_rows($result); $i++) {
			$notificationText["data"][$i] = array(
				"id" => mysql_result($result, $i, "id"), 
				"action" => mysql_result($result, $i, "action"),
				"url" => mysql_result($result, $i, "url"),
				"status" => mysql_result($result, $i, "status")
			);
			
			// And we count how many notifications have not been seen yet
			if (mysql_result($result, $i, "status") == 0) {
				$statusCount++;
			}
		}
		
		$notificationText["count"] = $statusCount;
		
		return json_encode($notificationText);
	}

	/**
	 * Number of notifications
	 * @param  [int] 	$id 	userID
	 * @return [int] 			number
	 */
	public function notificationCountForID($id) {

		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationCount WHERE `memberID`='$id'");
		
		// If the user still doesn't exists, we create it
		if (mysql_num_rows($result) == 0) {
			$this->resourceForQuery("INSERT INTO $this->tableNotificationCount (`memberID`, `count`) VALUES ($id, 0)");
			return 0;
		} else {
		 	// Otherwise we just return the result
			return mysql_result($result, 0, "count");
		}
	}

	/**
	 * Get new notifications
	 * @param  [int ] 	$id 	userID
	 * @return [object] JSON
	 */
	public function newNotificationsForUserID($id) {
		// We get all the unseen user notifications
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `memberID`='$id' AND `status` = 0 ORDER BY id DESC");
		
		if (mysql_num_rows($result) != 0) {
			// Return all the notifications (not only the unseen, but all) up to the point where the last unseen notification is
			return $this->notificationsForUserIDSinceNotification($id, mysql_result($result, mysql_num_rows($result) - 1, "id"));
		} else {
			return $this->notificationsForUserIDWithOffset($id, 0);	
		}
	}
	
	/**
	 * Get notifications with delay
	 * @param  [int ] 	$id 		userID
	 * @param  [int ] 	$seconds 	seconds since delay
	 * @return [object] JSON
	 */
	public function notificationsForIDWithDelay($id, $seconds) {
		
		$notificationDate = date(DATE_ATOM);
		
		// So we gotta search for any notifications the user had in the last specified time and still hasn't seen them
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `memberID`='$id' AND `date` >= DATE_ADD('$notificationDate', INTERVAL -'".($seconds)."' SECOND)");

		return $this->printNotifications($result);
	}

	/**
	 * Get new notifications with delay
	 * @param  [int ] 	$id 		userID
	 * @param  [int ] 	$seconds 	seconds since delay
	 * @return [object] JSON
	 */
	public function newNotificationsForIDWithDelay($id, $seconds) {
		
		$notificationDate = date(DATE_ATOM);
		
		// So we gotta search for any notifications the user had in the last specified time and still hasn't seen them
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `memberID`='$id' AND `date` >= DATE_ADD('$notificationDate', INTERVAL -'".($seconds)."' SECOND) AND `status` = 0");
		
		$sucess = $this->resourceForQuery("UPDATE $this->tableNotificationCount SET `count`=0 WHERE `memberID`=$id");
//		$sucess = $this->resourceForQuery("UPDATE $this->tableNotificationMember SET status = 1 WHERE memberID='$id' AND date >= DATE_ADD('$notificationDate', INTERVAL -'".($seconds)."' SECOND)");
		
		return $this->printNotifications($result);
	}
	
	/**
	 * Get notifications since another notification
	 * @param  [int ] 	$id 				userID
	 * @param  [int ] 	$notificationID 	another notification id
	 * @return [object] JSON
	 */
	public function notificationsForUserIDSinceNotification($id, $notificationID) {
		// Secondly we get the last 10 results from the database and append to the tail
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `id` >= '$notificationID' AND `memberID`='$id' ORDER BY id DESC");

		return $this->printNotifications($result);
	}
	
	/**
	 * Get notifications with offset
	 * @param  [int ] 	$id 		userID
	 * @param  [int ] 	$offset 	number of notifications to jump
	 * @return [object] JSON
	 */
	public function notificationsForUserIDWithOffset($id, $offset = 0) {
		// Secondly we get the last 10 results from the database and append to the tail
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `memberID`='$id' ORDER BY `id` DESC LIMIT " .$offset. "," .($offset + 9). "");

		return $this->printNotifications($result);
	}
	
	/**
	 * Get single notification
	 * @param  [int ] 	$id 				userID
	 * @param  [int ] 	$notificationID 	single notification
	 * @return [object] JSON
	 */
	public function notificationsForNotificationID($id, $notificationID) {
		$result = $this->resourceForQuery("SELECT * FROM $this->tableNotificationMember WHERE `id`='$notificationID' AND `memberID`='$id'");

		return $this->printNotifications($result);
	}
	
	/**
	 * Save a brand new notification
	 * @param  [int, array, string] $notifyMember        	Members that will be notified
	 * @param  [string] 			$notificationMessage 	Notification message
	 * @param  [string] 			$notificationUrl     	Notification url, destiny
	 * @return [null]                     
	 */
	public function notificationSave($notifyMember, $notificationMessage, $notificationUrl) {
		// We get the date
		$notificationDate = date(DATE_ATOM);
		
		// See if the notification has a destination (user or group) or if it is a general one (must be sent to everyone)
		
		// For groups
		if (is_int($notifyMember)) {
		
			// Get the user information from the database
			$resultUser = $this->resourceForQuery("SELECT `id` FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `groupID`=$notifyMember ORDER BY `user`");
			
			for ($i = 0; $i < mysql_num_rows($resultUser); $i++) {
				$userID = mysql_result($resultUser, $i, "id");
				
				// Add the notification
				$this->resourceForQuery("INSERT INTO $this->tableNotificationMember (`memberID`, `action`, `url`, `date`, `status`) VALUES ('$userID', '$notificationMessage', '$notificationUrl', '$notificationDate', 0)");
				
				// And update the count
				$this->resourceForQuery("UPDATE $this->tableNotificationCount SET count=count+1 WHERE `memberID`=$userID");
			}
			
		// For member
		} elseif (count($notifyMember) > 0) {
			// And just write the data into the database
			for ($i = 0; $i < count($notifyMember); $i++) {

				// Add the notification
				$this->resourceForQuery("INSERT INTO $this->tableNotificationMember (`memberID`, `action`, `url`, `date`, `status`) VALUES ('$notifyMember[$i]', '$notificationMessage', '$notificationUrl', '$notificationDate', 0)");
				
				// And update the count
				$this->resourceForQuery("UPDATE $this->tableNotificationCount SET count=count+1 WHERE `memberID`=$notifyMember[$i]");
			}
		// For everyone else
		} else {
			
			$resultUser = $this->resourceForQuery("SELECT `id` FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID ORDER BY `user`");
			
			for ($i = 0; $i < mysql_num_rows($resultUser); $i++) {
				$userID = mysql_result($resultUser, $i, "id");
				
				// Add the notification
				$this->resourceForQuery("INSERT INTO $this->tableNotificationMember (`memberID`, `action`, `url`, `date`, `status`) VALUES ('$userID', '$notificationMessage', '$notificationUrl', '$notificationDate', 0)");

				// And update the count
				$this->resourceForQuery("UPDATE $this->tableNotificationCount SET count=count+1 WHERE `memberID`=$userID");
			}
		}
	}

	/**
	 * Update notification status (seen or unseen) on the given notification id
	 * @param  [string] $id user ID
	 * @return [null] 
	 */
	public function notificationUpdateStatusForID($id) {
		$sucess = $this->resourceForQuery("UPDATE $this->tableNotificationMember SET status = 1 WHERE id='$id'");
	}

	/**
	 * Update notification status (seen or unseen) since the given notification id
	 * @param  [string] $id user ID
	 * @return [null] 
	 */
	public function notificationUpdateStatusSinceID($id) {
		$sucess = $this->resourceForQuery("UPDATE $this->tableNotificationMember SET status = 1 WHERE id <= '$id'");
	}

// ------------------------------------ USER SETTINGS ----------------------------------- //

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //



    
// -------------------------------------- COLLECTION ------------------------------------ //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	


	public function printCollectionForSearch($searchText, $searchType) {
		$result = $this->resourceForQuery("SELECT * FROM $searchType WHERE `enterpriseID`=$this->enterpriseID AND MATCH(user) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");
		    
		if (mysql_num_rows($result) > 0) {
			for ($i = 0; $i < mysql_num_rows($result); $i++) {
				?>
				<li value="<?php echo $position = mysql_result($result, $i, "id") ?>"><?php echo $position = mysql_result($result, $i, "user") ?></li>
				<?php
			}
		} else {
			?><li value="0">0 resultados</li><?php
		}
	}

    
// -------------------------------------- PRESENCA -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //

	public function getUserIDForDateID($dateID) {
		$result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `id`=$dateID AND `enterpriseID`=$this->enterpriseID");

    	if (mysql_num_rows($result) != 0) {
    		return mysql_result($result, 0, "user");
    	}
	}	
	
    public function printTable() {
    	
    	// See if we already have the table of the selected week
    	$this->writeTable();
    
    	?><table class="master" rules="groups">
    			<thead>
    				<tr>
    					<th>
    						<?php echo date("j/n/y", strtotime($this->monday) + $this->weekFromNow*3600*24*7) ?><br />
    						<?php echo date("j/n/y", strtotime($this->monday) + (4 + $this->weekFromNow*7)*3600*24) ?>
    					</th>
    					<th>8:00</th>
    					<th>9:00</th>
    					<th>10:00</th>
    					<th>11:00</th>
    					<th>13:00</th>
    					<th>14:00</th>
    					<th>15:00</th>
    					<th>16:00</th>
    					<th>17:00</th>
    				</tr>
    			</thead>
    			
    			
    			<tbody>
    	                <?php
    	                
    	                $hourNow = date("c");
    	                //$hourNow = date("c", mktime(15, 8, $today["seconds"], $today["mon"], 18, $today["year"]));
    	
    	                $daysOfWeek = array("Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira");
    	
    	                for ($j = 0; $j < 5; $j++) {
    	                	echo "<tr>";
    	                	echo "<th>$daysOfWeek[$j]</th>";
    	                	
    	                	for ($i = 0; $i < 10; $i++) {
    	                	
    	                		// We automatically choose which hour and day we'll be dealing with
        	                    $result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `enterpriseID`=$this->enterpriseID AND `date` = DATE_ADD(DATE_ADD('$this->monday', INTERVAL '".($j + $this->weekFromNow*7)."' DAY), INTERVAL '$i' HOUR)");

        	                    if (mysql_num_rows($result) > 0) {
        	                    	// Select any of the id's on this date and call the print function
        	                    	$id = mysql_result($result, 0, "id");
        	                    	$this->printTextForDate($id);
        	                    }
    	                	}
    	                    
    	                    echo "<tr>";
    	                }
    	
    	                ?>
    			</tbody>
    		</table><?php
    	
    }
    
    /**
     * Print text for a single shift slot, where multiple people can appear
     * @param  integer $dateID
     * @return
     */
    public function printTextForDate($dateID) {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `id`='$dateID' AND `enterpriseID`=$this->enterpriseID");
        $date = mysql_result($result, 0, "date");
        $result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `date`='$date' AND `enterpriseID`=$this->enterpriseID");
        
        // We need to know how many cells this table willl have
        $lines = mysql_num_rows($result);
        
        if ($lines > 1) {
        	echo "<td><table rules='groups' class='multipleUsers'>";
        }
        
        for ($k = 0; $k < mysql_num_rows($result); $k++) {
        	$id = mysql_result($result, $k, "id");
        	
        	if ($lines > 1) { echo "<tr>"; }
        	$this->printTextForDateID($id);
        	if ($lines > 1) { echo "<input type='hidden' id='multipleUserCell' value='YES' /><tr>"; }
        }
        
        if ($lines > 1) {
        	echo "</table></td>";
        }
    }
    
    /**
     * Print text for a single date id
     * @param  integer $dateID
     * @return
     */
    public function printTextForDateID($dateID) {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `id`='$dateID' AND `enterpriseID`=$this->enterpriseID");
        $id = mysql_result($result, 0, "id");
        $date = mysql_result($result, 0, "date");
        $userBD = $this->userForId(mysql_result($result, 0, "user"));
        $status = mysql_result($result, 0, "status");
        
        $this->printTextForCell($id, $userBD, $status, $date);
    }
    
    public function printTextForCell($id, $userBD, $status, $date) {
    	
    	$hourNow = date("c");
    	
    	echo "<td class='";
    	
    	// Check for permissions
    	if ($userBD == $this->user || $this->group == 3 /* RH */ || $this->level >= 10) {
    		// User has not logged in yet
    		if ($status == 0) {
    			// Special user "-" is always present
    			if (strtotime($date) + 10*60 < strtotime($hourNow) && $userBD == "-") {
    				echo "red";
    			// User is late
    			} elseif (strtotime($date) + 10*60 < strtotime($hourNow)) {
    				echo "red";
    			// User is within the time boundaries
    			} elseif (strtotime($date) + 10*60 >= strtotime($hourNow) && strtotime($date) - 5*60 <= strtotime($hourNow)) {
    				echo "white";
    			// Still to early
    			} else {
    				echo "silver";
    			}
    		// User has logged in
    		} elseif ($status == 1) {
    			// User was too late to log out
    			if (strtotime($date) + 90*60 < strtotime($hourNow)) {
    				echo "red";
    			// User is within the time boundaries
    			} elseif (strtotime($date) + 90*60 >= strtotime($hourNow) && strtotime($date) - 5*60 <= strtotime($hourNow)) {
    				echo "yellow";
    			// Still to early
    			} else {
    				echo "silver";
    			}
    		// User has logged out
    		} elseif ($status == 2) {
    			// Validate his presence
    			if (strtotime($date) <= strtotime($hourNow)) {
    				echo "green";
    			// Still to early
    			} else {
    				echo "silver";
    			}
    		}
    	// Permision has been denied
    	} else {
    		echo "silver";
    	}

		$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `id`=$this->userID AND `enterpriseID`=$this->enterpriseID");
		$photo = mysql_result($result, 0, "photo");

		if (strpos($photo, "caricatura") === false) {
			// If the cell allows any interation
	    	if (strtotime($date) + 90*60 >= strtotime($hourNow) && strtotime($date) - 5*60 <= strtotime($hourNow)) {
	    		echo " star";
	    	}
		}
		
    	echo "'><div class='relative'>";
		
		// Only allows justification if the condition below is verified
		if ($userBD == $this->user && $status == 0 && strtotime($date) < strtotime($hourNow) - 10*60) {
			$resultExplanation = $this->resourceForQuery("SELECT * FROM $this->tableExplanationsUsers WHERE `dateID`='$id'");
			
			if (mysql_num_rows($resultExplanation) > 0) {
				
				if (mysql_result($resultExplanation, 0, "status") == 1) {
					// We have an entry that has been evaluated
					$penaltyID = mysql_result($resultExplanation, 0, "penalty");
					
					$resultPenalty = $this->resourceForQuery("SELECT * FROM $this->tableExplanationsPenalty WHERE `id`='$penaltyID'");
					$penalty = mysql_result($resultPenalty, 0, "value");
					?><div id="penaltyHint"><?php echo $penalty ?></div><?php
				} else {
					?><div id="penaltyHint"><img src="images/48-sand.png" alt="Wait for evaluation"></div><?php
				}
			} else {
				?><div id="penaltyHint"><img src="images/48-paper-airplane.png" id="paperAirplane" alt="Send Explanation"></div><?php
			}
		}
    	echo "<br>$userBD<br><br><input type='hidden' id='dateID' value='$id' /></div></td>";
    }
    
    
    public function writeTable() {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableShift WHERE `enterpriseID`=$this->enterpriseID AND `date` = DATE_ADD('$this->monday', INTERVAL '".($this->weekFromNow*7)."' DAY)");
		
		//  LET'S see if the table for this week does not exist, so we can create it!
    	if (mysql_num_rows($result) == 0) {
    	    for ($j = 0; $j < 5; $j++) {
    	        for ($i = 0; $i < 10; $i++) {
    	            if ($i != 4) {
    	                $this->resourceForQuery("INSERT INTO $this->tableShift (`enterpriseID`, `date`, `user`) VALUES ($this->enterpriseID, DATE_ADD(DATE_ADD('$this->monday', INTERVAL '".($j + $this->weekFromNow*7)."' DAY), INTERVAL '$i' HOUR), '1')");
    	            }
    	        }
    	    }
    	}
    	
    }
	
// -------------------------------------- PROJECTS -------------------------------------- //

// -------------------------------------- -------- -------------------------------------- //

// -------------------------------------- -------- -------------------------------------- //

	public function printGroupMembersForID($id) {
		$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `groupID` = $id");
		
		for ($i = 0; $i < mysql_num_rows($result); $i++) {
			$id = mysql_result($result, $i, "id");
			$user = mysql_result($result, $i, "user");
			echo "<li value='$id'>$user</li>";	
		}
	}
	
	public function printAllProjects() {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableProject WHERE `enterpriseID`=$this->enterpriseID");

		$this->printProjectCell($result);
    }

	
	public function printProjectCell($result) {
		
		for ($i = 0; $i < mysql_num_rows($result); $i++) {
			$id = mysql_result($result, $i, "id");
			$name = mysql_result($result, $i, "name");
			$headline = mysql_result($result, $i, "headline");
			$statusID = mysql_result($result, $i, "statusID");
			
			$resultStatus = $this->resourceForQuery("SELECT * FROM $this->tableProjectStatus WHERE `id`='$statusID'");
			$statusName = mysql_result($resultStatus, 0, "name");
			$statusColor = mysql_result($resultStatus, 0, "color");

		?>
		<div class="projectBox">
			<input type="hidden" name="projectID" id="projectID" value="<?php echo $id ?>" />
			<div onclick="" class="projectCell reducedInfo" style="background-color: <?php echo $statusColor ?>">
				<div class="projectInfo">
					<p class="projectName"><?php echo $name ?></p>
					<p class="projectHeadline"><?php echo $headline ?></p>
				</div>
				<div class="projectStatus">
					<p><?php echo $statusName ?></p>
				</div>
			</div>
			<div onclick="" class="projectCell completeInfo none"></div>
		</div>
		<?php
		}
	}
	
	public function printProjectForSearch($searchText) {

		$result = $this->resourceForQuery("SELECT * FROM $this->tableProject WHERE `enterpriseID`=$this->enterpriseID AND MATCH(name, headline, description) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");
    	
    	if (mysql_num_rows($result) > 0) {
			$this->printProjectCell($result);
    	} else {
    		?><p class="searchEmptyResult">0 resultados</p><?php
    	}
    	
    }

// -------------------------------------- MEMBERS -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //			

	
	public function printAllUsers() {
		// '-' is the special user for the Presenca tool
        $result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `user`!='-' AND `enterpriseID`=$this->enterpriseID ORDER BY user");
        
        echo "<ul class='badgeListSortable'>";
        
      	$this->printBadge($result);
		
		echo "</ul>";
    }
    
    public function printUsersForGroupID($groupID, $infoContainer = true) {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `groupID`=$groupID AND `user`!='-' ORDER BY user");
    	
    	$this->printBadge($result, $infoContainer);
    }
    
    public function printUserSettingsForID($id) {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `id`=$id AND `enterpriseID`=$this->enterpriseID");
    	
    	if (mysql_num_rows($result) == 1) {
    		$this->printBadge($result);
    	}
    }
    
    public function printPowerUsers() {
    	$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND `level`>=10 AND `user`!='-' ORDER BY user");
    	    
    	if (mysql_num_rows($result) > 0) {
    		for ($i = 0; $i < mysql_num_rows($result); $i++) {
    			?>
    			<li value="<?php echo $position = mysql_result($result, $i, "id") ?>"><?php echo $position = mysql_result($result, $i, "user") ?></li>
    			<?php
    		}
    	} else {
    		?><li>0 usuários</li><?php
    	}
    }
    
    public function printBadge($result, $infoContainer = true) {
    	
    	for ($i = 0; $i < mysql_num_rows($result); $i++) {
    	
    		$id = mysql_result($result, $i, "id");
    		$user = mysql_result($result, $i, "user");
    		$position = mysql_result($result, $i, "position");
    		$photo = mysql_result($result, $i, "photo");

    		$this->printSingleBadge($id, $user, $position, $photo, "", $infoContainer);

    	}

    	// One element for the form
    	// $this->printSingleBadge(0, "Nome", "Cargo", "images/128-man.png", "newBadge defaultInfoContainer", true);
    }
    	
    public function printSingleBadge($id, $user, $position, $photo, $className, $infoContainer) {
    
    ?>
    	
    	<li class="badge <?php if ($infoContainer) { ?> infoContainer <?php } ?><?php echo $className ?>">
    		<form method="post" action="#">
    			<input type="hidden" id="memberID" value="<?php echo $id ?>" />
    			<div class="badgeHolder"></div>
    			<div class="badgeTurner">
    				<img <?php if (($this->group == 3 /* RH */ || $this->level >= 10 || $this->userID == $id ) && $infoContainer == true) { ?>class="editButton" style="opacity: 1;" <?php } ?>src="images/50-pen.png" alt="Turn the badge around" />
    			</div>
    			<div class="badgeImage <?php if ($infoContainer) { ?> infoContainerImage <?php } ?>">
    				<div id="file-uploader">
    					<noscript>
    						<p>Please enable JavaScript to use file uploader.</p>
    						<!-- or put a simple form for upload here -->
    					</noscript>
    				</div>
   					<img src="<?php echo $photo ?>" alt="Imagem do membro" id="imagePhoto" />
    			</div>
    			<div class="badgeName"><p class="<?php if ($infoContainer) { ?> infoContainerInputContent <?php } else { ?> infoContainerTextContent <?php } ?>" title="user"><?php echo $this->truncateName($user, 17) ?></p></div>
    			<div class="badgePosition"><p class="<?php if ($infoContainer) { ?> infoContainerInputContent <?php } else { ?> infoContainerTextContent <?php } ?>" title="position"><?php echo $this->truncateName($position, 15) ?></p></div>
    			<div class="badgeExtra <?php if ($infoContainer) { ?> infoContainerExtra <?php } ?>"></div>
    		</form>
    	</li>
	
    	<?php
    	
    }
    
    public function printBadgeForSearch($searchText) {

		$result = $this->resourceForQuery("SELECT * FROM $this->tableUser WHERE `enterpriseID`=$this->enterpriseID AND MATCH(user, position, email, telephone) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");
    	
    	if (mysql_num_rows($result) > 0) {
    		$this->printBadge($result);
    	} else {
    		?><p class="searchEmptyResult">0 resultados</p><?php
    	}
    	
    }
   
// -------------------------------------- CLIENTS -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //			
	
	public function printClients() {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableClient WHERE `enterpriseID`=$this->enterpriseID AND `user`!='-' ORDER BY user");
        
        echo "<ul>";
        
        $this->printCard($result);
		
		echo "</ul>";
    }
    
    public function printCard($result, $course = null) {
    	
    	for ($i = 0; $i < mysql_num_rows($result); $i++) {
    	
    		$id = mysql_result($result, $i, "id");
    		$user = mysql_result($result, $i, "user");
    		$position = mysql_result($result, $i, "position");
    		$email = mysql_result($result, $i, "email");
    		$telephone = mysql_result($result, $i, "telephone");
    	
    		if ($course != null) {
    			$course = mysql_result($result, $i, "course");
    		}
    		
    	?>
    	
    	<li class="card infoContainer">
    		<form method="post" action="#">
    			<input type="hidden" id="memberID" value="<?php echo $id ?>" />
    			<?php if ($this->group == 3 /* RH */ || $this->level >= 10) { ?>
    			<div class="cardTurner">
    				<img class="editButton" src="images/50-pen.png" alt="Turn the card around" />
    			</div>
    			<?php } ?>
    			<div class="cardName"><p class="infoContainerInputContent" title="user"><?php echo $this->truncateName($user, 21) ?></p></div>
    			<div class="cardPosition"><p class="infoContainerInputContent" title="position"><?php echo $this->truncateName($position, 15) ?></p></div>
    			
    			<div class="cardBottom">
    				<div class="cardEmail">
    					<p class="general"><span class="bold">Email:</span> <span class="infoContainerInputContent" title="email"><?php echo $email ?></span></p>
    				</div>
    				<div class="cardTelephone">
    					<p class="general"><span class="bold">Telefone:</span> <span class="infoContainerInputContent" title="telephone"><?php echo $telephone ?></span></p>
    				</div>
    			 	
    				<?php if ($course != null) { ?>
    				<div class="cardCourse">
    					<p class="general"><span class="bold">Curso: </span> <span class="infoContainerInputContent" title="course"><?php echo $this->truncateName($user, 22) ?></span></p>
    				</div>
    				<?php } ?>
    				
    				<div class="infoContainerSave saveButton">Salvar!</div>
    				<div class="saveButtonError"></div>
    			</div>
    			
    			<div class="cardExtra infoContainerExtra"></div>
    		</form>
    	</li>
    
    	<?php
    	}
    }
    
    public function printCardExtraForID($id, $table) {
    	$result = $this->resourceForQuery("SELECT * FROM $table WHERE personID='$id'");


		for ($i = 0; $i < mysql_num_rows($result); $i++) {
			
			$projectID = mysql_result($result, $i, "projectID");
			$resultProject = $this->resourceForQuery("SELECT * FROM $this->tableProject WHERE id='$projectID'");
			
			$name = mysql_result($resultProject, 0, "name");
			$headline = mysql_result($resultProject, 0, "headline");
			$statusID = mysql_result($resultProject, 0, "statusID");
			
			$resultStatus = $this->resourceForQuery("SELECT * FROM $this->tableProjectStatus WHERE id='$statusID'");
			$statusName = mysql_result($resultStatus, 0, "name");
			$statusColor = mysql_result($resultStatus, 0, "color");
		?> 
		
		<a href="projects.php">
			<div class="projectBox">
				<div onclick="" class="projectCell reducedInfo" style="background-color: <?php echo $statusColor ?>">
					<div class="projectInfo">
						<p class="projectName"><?php echo $name ?></p>
						<p class="projectHeadline"><?php echo $headline ?></p>
					</div>
					<div class="projectStatus">
						<p><?php echo $statusName ?></p>
					</div>
					<input type='hidden' id='id' value='<?php echo $projectID ?>' />
				</div>
				<div onclick="" class="projectCell completeInfo none"></div>
			</div>
		</a>

	<?php }
	}
    
    public function printClientForSearch($searchText) {
    
		$result = $this->resourceForQuery("SELECT * FROM $this->tableClient WHERE `enterpriseID`=$this->enterpriseID AND MATCH(user, position, email, telephone) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");

    	if (mysql_num_rows($result) > 0) {
    		$this->printCard($result);
    	} else {
    		?><p class="searchEmptyResult">0 resultados</p><?php
    	}
    	
    }
  
// -------------------------------------- CONSULTANTS ----------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //			
	
	public function printConsultants() {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableConsultant WHERE `enterpriseID`=$this->enterpriseID AND `user`!='-' ORDER BY user");
        
        echo "<ul>";
        
         $this->printCard($result, true);
		
		echo "</ul>";
    }
    
    public function printConsultantForSearch($searchText) {
    
		$result = $this->resourceForQuery("SELECT * FROM $this->tableConsultant WHERE `enterpriseID`=$this->enterpriseID AND MATCH(user, position, course, email, telephone) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");
    	
    	if (mysql_num_rows($result) > 0) {
    		$this->printCard($result, true);
    	} else {
    		?><p class="searchEmptyResult">0 resultados</p><?php
    	}
    }
     
    
// -------------------------------------- GROUPS -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //	

// -------------------------------------- -------- -------------------------------------- //			
	
	public function printGroups() {
        $result = $this->resourceForQuery("SELECT * FROM $this->tableGroup WHERE `enterpriseID`=$this->enterpriseID ORDER BY id, name");
        
        echo "<ul>";
        
        $this->printPost($result);
        
        echo "</ul>";
    }
    
    public function printPost($result) {
    	for ($i = 0; $i < mysql_num_rows($result); $i++) {
    	
    		$id = mysql_result($result, $i, "id");
    		$acronym = mysql_result($result, $i, "acronym");
    		$name = mysql_result($result, $i, "name");
    		$color = mysql_result($result, $i, "color");
    		$photo = mysql_result($result, $i, "photo");
    	
    	?>
    	
    	<li value="<?php echo $id ?>" class="post infoContainer" style="background-color: <?php echo $color ?>;">
    		<form method="post" action="#">
    			<input type="hidden" id="memberID" value="<?php echo $id ?>" />
	    		<div class="postHolder"></div>
	    		<?php if ($this->group == 3 /* RH */ || $this->level >= 10) { ?>
	    		<div class="postTurner">
	    			<img class="editButton" src="images/50-pen.png" alt="Turn the card around" />
	    		</div>
	    		<?php } ?>
	    		<div class="postPin">
	    			<img src="images/128-pushpin.png" alt="Group Logo" />
	    		</div>
	    		<div class="postInformationWrapper">
	    		
		    		<div class="postLogo infoContainerImage">
		    			<div id="file-uploader">
		    				<noscript>
		    					<p>Please enable JavaScript to use file uploader.</p>
		    					<!-- or put a simple form for upload here -->
		    				</noscript>
		    			</div>
		    			<img src="<?php echo $photo ?>" alt="Group logo" />
		    		</div>	
	    		
		    		<div class="postInformation">
		    			<span title="name" class="postName infoContainerInputContent"><?php echo $this->truncateName(ucwords(strtolower($name)), 24) ?></span> 
		    			<span class="postParenthesisLeft">(</span><span title="acronym" class="postAcronym infoContainerInputContent"><?php echo strtoupper($acronym) ?></span><span class="postParenthesisRight">)</span>
		    		</div>
		    		<div class="infoContainerSave saveButton">Salvar!</div>
		    		<div class="saveButtonError"></div>
	    		</div>
	    		
	    		<div class="postExtra infoContainerExtra"></div>
	    		
	    		<div class="postBadges">
	    			<ul class="badgeListSortable">
	    				<?php $this->printUsersForGroupID($id, false) ?>
	    			</ul>
	    		</div>
	    	</form>
    	</li>
    
    	<?php
    	}
    }
    
    public function printGroupAsSelect() {
    	?><div class="selectBox">
    		<div class="selectSelected">
    			<ul>
    				<li value="0">Qual?</li>
    			</ul>
    		</div>
    		<div class="selectOptions">
    			<ul>
    			<?php
    				$result = $this->resourceForQuery("SELECT * FROM $this->tableGroup WHERE `enterpriseID`=$this->enterpriseID");
    				
    				for ($i = 0; $i < mysql_num_rows($result); $i++) {
    					$id = mysql_result($result, $i, "id");
    					$name = mysql_result($result, $i, "name");
    			?>
    				<li value="<?php echo $id ?>"><?php echo $name ?></li>
    			<?php
    				}
    			?>
    			</ul>
    		</div>
    	</div>
    	<?php
    }
    
	public function printGroupForSearch($searchText) {
	
		$result = $this->resourceForQuery("SELECT * FROM $this->tableGroup WHERE `enterpriseID`=$this->enterpriseID AND MATCH(acronym, name) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE)");

		if (mysql_num_rows($result) > 0) {
			$this->printPost($result);
		} else {
			?><p class="searchEmptyResult">0 resultados</p><?php
		}
	}
         
	
	
}

// Instantiate the var
$core = new Core();

?>