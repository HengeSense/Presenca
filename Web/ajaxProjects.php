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
		?>
		<div class="projectBox">
			<input type="hidden" name="projectID" id="projectID" value="0" />
			<div onclick="" class="projectCell completeInfo">
				<div onclick="" class="projectCellWrapper">
					<div onclick="" class="projectCellUpperWrapper">
						<div class="projectImage infoContainerImage">
							<div id="file-uploader">
								<noscript>
									<p>Please enable JavaScript to use file uploader.</p>
									<!-- or put a simple form for upload here -->
								</noscript>
							</div>
							<img src="images/128-photo.png" id="imageImg" class="" alt="Logo" id=""/>
						
						</div>
						
						<div class="projectBoxes">
							<div class="projectExtra">
								<div class="projectName projectInfoBox">
									<input placeholder="Qual nome?" id="nameInput" type="text" class="textInput" name="textInput" maxlength="100" autocomplete="off" tabindex="1"/>
									<p class="subtitle">Nome do Projeto</p>
								</div>
								
								<?php //if ($core->group == 2) /* FINANCE */ { ?>
								<div class="projectPrice projectInfoBox">
									<input placeholder="Meu preço" id="priceInput" type="text" class="textInput" name="textInput" maxlength="100" autocomplete="off" tabindex="2" value="R$ 0.00"/>
									<p class="subtitle">Preço do projeto</p>
								</div>
								<?php //} else { ?>
								<div class="projectDate projectInfoBox">
									<input placeholder="Quando nasci?" id="dateInput" type="text" class="textInput" name="textInput" maxlength="100" autocomplete="off" tabindex="2"/>
									<p class="subtitle">Início do projeto</p>
								</div>
								<?php //} ?>
							</div>

							<div class="projectBoxesBottom">

								<div class="projectMembers projectInfoBox">					
									<div class="collectionBox">
										<div class="collectionSelected">
											<ul class="collectionSelectedList"></ul>
											<input type="text" title="<?php echo $core->tableUser ?>" class="collectionSelectedInput" name="collectionSelectedInput" placeholder="Quem?" autocomplete="off" tabindex="3"/>
										</div>
										<div class="collectionOptions">
											<ul></ul>
										</div>
									</div>
									<p class="subtitle">Membros</p>
								</div>
								
								<div class="projectClients projectInfoBox">
									<div class="collectionBox">
										<div class="collectionSelected">
											<ul class="collectionSelectedList"></ul>
											<input type="text" title="<?php echo $core->tableClient ?>" class="collectionSelectedInput" name="collectionSelectedInput" placeholder="Quem?" autocomplete="off" tabindex="4"/>
										</div>
										<div class="collectionOptions">
											<ul></ul>
										</div>
									</div>
									<p class="subtitle">Clientes</p>
								</div>
								
								<div class="projectConsultants projectInfoBox">
									<div class="collectionBox">
										<div class="collectionSelected">
											<ul class="collectionSelectedList"></ul>
											<input type="text" title="<?php echo $core->tableConsultant ?>" class="collectionSelectedInput" name="collectionSelectedInput" placeholder="Quem?" autocomplete="off" tabindex="5"/>
										</div>
										<div class="collectionOptions">
											<ul></ul>
										</div>
									</div>
									<p class="subtitle">Consultores</p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="projectHeadline projectTextBox">
						<p class="header">Manchete</p>
						<p class="content">
							<input placeholder="Que tal resumir seu projeto em um tweet?" id="headlineInput" type="text" class="textInput" name="textInput" maxlength="140" autocomplete="off" tabindex="6"/>
						</p>
					</div>
					
					<div class="projectDescription projectTextBox">
						<p class="header">Descrição</p>
						<p class="content"><textarea placeholder="Descreva seu projeto de maneira clara e eficiente!" id="descriptionTextarea" class="textInput" tabindex="7"></textarea></p>
					</div>
					
					<div class="projectUpdates projectTextBox">
						<p class="header">Atualizações</p>
						<div class="projectUpdatesContent">

							<div class="projectUpdatesContentCell">
								<div class="projectInfo">
									<p class="content"><textarea placeholder="Adicionar informação ao projeto" id="updateTextarea" class="textInput" tabindex="8"></textarea></p>
								</div>
								<div class="projectStatus">

									<div class="selectBox">
										<div class="selectSelected">
											<ul>
												<li value="0">Qual?</li>
											</ul>
										</div>
										<div class="selectOptions">
											<ul>
											<?php
												$resultStatus = $core->resourceForQuery("SELECT * FROM $core->tableProjectStatus");
												
												for ($i = 0; $i < mysql_num_rows($resultStatus); $i++) {
													$statusID = mysql_result($resultStatus, $i, "id");
													$statusName = mysql_result($resultStatus, $i, "name");
													$statusColor = mysql_result($resultStatus, $i, "color");
											?>
												<li value="<?php echo $statusID ?>" style="background-color: <?php echo $statusColor ?>"><?php echo $statusName ?></li>
											<?php
												}
											?>
											</ul>
										</div>
									</div>

								</div>
								
								
							</div>

						
						</div>
					</div>
					
					<div class="projectSubmit">
						<input type="submit" id="projectSubmitButton" class="submitButton" value="Enviar!" tabindex="5" />
					</div>
				</div>
			</div>
		</div>
		<?php
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
		
		$result = $core->resourceForQuery("SELECT * FROM $core->tableProject WHERE id='$id'");
		
		$image = mysql_result($result, 0, "image");
		$name = mysql_result($result, 0, "name");
		$description = mysql_result($result, 0, "description");
		//$userBD = $core->userForId(mysql_result($result, 0, "user"));
		$price = mysql_result($result, 0, "price");
		$date = date(DATE_ATOM);
		$dateText = "";
		
		// For the date, first we must know of the user has already been marked as finished
		$resultDate = $core->resourceForQuery("SELECT date FROM $core->tableProjectHistory WHERE `projectID`=$id AND `statusID`=6 ORDER BY id DESC");
		
		if (mysql_num_rows($resultDate) >= 1) {
			$date = mysql_result($resultDate, 0, "date");
			$dateText = "Fim do projeto";
		} else {
			// If not, we get the first event associated with it
			$resultDate = $core->resourceForQuery("SELECT date FROM $core->tableProjectHistory WHERE `projectID`=$id ORDER BY id ASC");
			$date = mysql_result($resultDate, 0, "date");
			$dateText = "Início do projeto";
		}
		
			
		?>
		
		<?php if ($core->group == 1 /* PROJECTS */  || $core->group == 2 /* FINANCE */ || $core->level >= 10) { ?><img src="images/50-pen.png" class="editButton" alt="Edit"> <?php } ?>
		
		<div onclick="" class="projectCellWrapper">
			<div onclick="" class="projectCellUpperWrapper">
				<div class="projectImage infoContainerImage">
					
					<img src="<?php echo $image ?>" class="" alt="Logo" id=""/>
				
				</div>
				
				<div class="projectBoxes">
					<div class="projectExtra">
						<div class="projectDate projectInfoBox">
							<p class="info"><?php echo date("d/m/Y", strtotime($date)) ?></p>
							<p class="subtitle"><?php echo $dateText ?></p>
						</div>
						
						<div class="projectPrice projectInfoBox">
							<p class="info"><?php echo $price ?></p>
							<p class="subtitle">Última precificação</p>
						</div>
					</div>
					
					<div class="projectBoxesBottom">
						<div class="projectMembers projectInfoBox">
							<?php
								$result = $core->resourceForQuery("SELECT * FROM $core->tableProjectMembers WHERE `projectID`='$id'");
								
								for ($i = 0; $i < mysql_num_rows($result); $i++) {
									$userID = mysql_result($result, $i, "personID");
									
									$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE `id`='$userID'");
									$user = mysql_result($resultUser, 0, "user"); // So we have his name
									$groupID = mysql_result($resultUser, 0, "groupID");
									
									$resultGroup = $core->resourceForQuery("SELECT * FROM $core->tableGroup WHERE `id`='$groupID'");
									$groupAcronym = mysql_result($resultGroup, 0, "acronym");
									
									?>
									
									<ul class="projectPersonCell">
										<li value="<?php echo $userID ?>" class="projectPersonCellName"><?php echo $user ?></li>
										<li class="projectPersonCellAcronym"><?php echo $groupAcronym ?></li>
									</ul>
									<?php
								}
							?>
							<p class="subtitle">Membros</p>
						</div>
							
					
						<div class="projectClients projectInfoBox">
						
							<?php
								$result = $core->resourceForQuery("SELECT * FROM $core->tableProjectClients WHERE `projectID`='$id'");
								
								for ($i = 0; $i < mysql_num_rows($result); $i++) {
									$userID = mysql_result($result, $i, "personID");
									
									$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableClient WHERE `id`='$userID'");
									$user = mysql_result($resultUser, 0, "user"); // So we have his name
									
									?>
									
									<ul class="projectPersonCell">
										<li value="<?php echo $userID ?>" class="projectPersonCellName"><?php echo $user ?></li>
									</ul>
									<?php
								}
							?>
							<p class="subtitle">Clientes</p>
						</div>
						
						<div class="projectConsultants projectInfoBox">
						
						<?php
							$result = $core->resourceForQuery("SELECT * FROM $core->tableProjectConsultants WHERE projectID = '$id'");
							
							for ($i = 0; $i < mysql_num_rows($result); $i++) {
								$userID = mysql_result($result, $i, "personID");
								
								$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableConsultant WHERE id = '$userID'");
								$user = mysql_result($resultUser, 0, "user"); // So we have his name
								
								?>
								
								<ul class="projectPersonCell">
									<li value="<?php echo $userID ?>" class="projectPersonCellName"><?php echo $user ?></li>
								</ul>
								<?php
							}
							?>
							<p class="subtitle">Consultores</p>
		
						</div>

					</div>
				</div>
			</div>
			
			<div class="projectDescription projectTextBox">
				<p class="header">Descrição</p>
				<p class="content"><?php echo $description ?></p>
			</div>

			<div class="projectUpdates projectTextBox">
				<p class="header">Atualizações</p>
				<div class="projectUpdatesContent">
					<?php
						$resultHistory = $core->resourceForQuery("SELECT * FROM $core->tableProjectHistory WHERE projectID = '$id' ORDER BY id DESC");
						
						for ($i = 0; $i < mysql_num_rows($resultHistory); $i++) {
							$userID = mysql_result($resultHistory, $i, "memberID");
							$date = mysql_result($resultHistory, $i, "date");
							$description = mysql_result($resultHistory, $i, "description");
							$statusID = mysql_result($resultHistory, $i, "statusID");
							
							if ($statusID != 0) {
								$resultStatus = $core->resourceForQuery("SELECT * FROM $core->tableProjectStatus WHERE id='$statusID'");
								$statusName = mysql_result($resultStatus, 0, "name");
								$statusColor = mysql_result($resultStatus, 0, "color");
							}
							
							$resultUser = $core->resourceForQuery("SELECT * FROM $core->tableUser WHERE id = '$userID'");
							$user = mysql_result($resultUser, 0, "user"); // So we have his name
							
							?>
							<div class="projectUpdatesContentCell" <?php if ($statusID != 0) { ?> style="background-color: <?php echo $statusColor ?>" <?php } ?>>
								<div class="projectInfo">
									<p class="projectDate"><?php echo date("j/n/y", strtotime($date)) ?></p>
									<p class="projectDescription"><?php echo $description ?> - <b>por <?php echo $user ?></b></p>
								</div>
								<div class="projectStatus">
									<p><?php if ($statusID != 0) { ?><?php echo $statusName ?><?php } ?></p>
								</div>
							</div>
							<?php
						}
					?>
				
				</div>
			</div>
		</div>
		<?php
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
			
				$insert = $core->resourceForQuery("INSERT INTO $core->tableProject (`enterpriseID`, `image`, `name`, `headline`, `description`, `price`, `statusID`) VALUES ($core->enterpriseID, '$image', '$name', '$headline', '$description', '$price', 1)");
				$id = mysql_insert_id();
				
				if ($insert) {
					$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectHistory (`projectID`, `date`, `description`, `memberID`, `statusID`) VALUES ('$id', STR_TO_DATE('$date','%d/%m/%Y'), 'Projeto iniciado!', $core->userID, 1)");
				}
		
				if ($insert) {
					for ($i = 0; $i < count($members); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectMembers (`projectID`, `personID`) VALUES ('$id', '$members[$i]')");
					}
					for ($i = 0; $i < count($clients); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectClients (`projectID`, `personID`) VALUES ('$id', '$clients[$i]')");
					}
					for ($i = 0; $i < count($consultants); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectConsultants (`projectID`, `personID`) VALUES ('$id', '$consultants[$i]')");
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
				$update = $core->resourceForQuery("UPDATE $core->tableProject SET `image`='$image', `name`='$name', `headline`='$headline', `description`='$description', `price`='$price' WHERE `id`=$id");
				
				if ($update) {
					// We get the first event of this project (probably the one establishing its creation) 
					$resultDate = $core->resourceForQuery("SELECT id FROM $core->tableProjectHistory WHERE `projectID`=$id ORDER BY id ASC");
					$idDate = mysql_result($resultDate, 0, "id");
					
					$query = "UPDATE $core->tableProjectHistory SET `date`=STR_TO_DATE('$date','%d/%m/%Y') WHERE `id`=$idDate";
					$update = $core->resourceForQuery($query) or trigger_error(mysql_error() . " " . $query);
				}
		
				if ($update) {
					// We gotta delete before we re-insert the data
					// This is the information regarding members, clients and consultants on this projects
					$core->resourceForQuery("DELETE FROM $core->tableProjectMembers WHERE `projectID`='$id'");
					for ($i = 0; $i < count($members); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectMembers (`projectID`, `personID`) VALUES ('$id', '$members[$i]')");
					}
					
					$core->resourceForQuery("DELETE FROM $core->tableProjectClients WHERE `projectID`='$id'");
					for ($i = 0; $i < count($clients); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectClients (`projectID`, `personID`) VALUES ('$id', '$clients[$i]')");
					}
					
					$core->resourceForQuery("DELETE FROM $core->tableProjectConsultants WHERE `projectID`='$id'");
					for ($i = 0; $i < count($consultants); $i++) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectConsultants (`projectID`, `personID`) VALUES ('$id', '$consultants[$i]')");
					}
					
					// Let's see if the user opted to add news to this project
					
					$updateText = trim(htmlentities(utf8_decode($_POST['updateText'])));
					$updateStatus = trim(htmlentities(utf8_decode($_POST['updateStatus'])));
					
					// If he has selected anything, we just write it to the database
					if ($updateText != "" || $updateStatus != 0) {
						$insert = $core->resourceForQuery("INSERT INTO $core->tableProjectHistory (`projectID`, `date`, `description`, `memberID`, `statusID`) VALUES ('$id', NOW(), '$updateText', $core->userID, $updateStatus)");
					}
					
					// And if the status was updated, me must update the project status too
					if ($updateStatus != 0) {
						$update = $core->resourceForQuery("UPDATE $core->tableProject SET `statusID`=$updateStatus WHERE `id`=$id");
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