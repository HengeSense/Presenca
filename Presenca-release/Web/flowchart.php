<?php
	include_once("includes/loginCheck.php");
	
	if (!$core->logado) {
		header("Location: login.php");
		exit("Monkeys are on the way to solve this problem!");
	}
?>

<?php include_once("includes/header.php") ?>
<body>
	<?php include_once("includes/bar.php") ?>
	<div id="content">
		<div class="contentBox">
			<?php echo "<!--".date("c")."-->" ?>

			<!--Content-->
			<div id="flowchartContent" class="pageContent">
				<div class="boardContent">
					
					<div class="menuContent">
						<div class="menuBoard leftBoard">
							<?php if ($core->group == 1 || $core->level >= 10) { ?>
								<input type="button" name="" value="Novo fluxograma" class="menuBoardInput" id="addFlowchart" />
							<?php } ?>
						</div>
						
						<div class="searchBoard rightBoard">
							<div class="searchBoardWrapper">
								<form method="post" action="#">
									<input placeholder="Buscar" type="text" name="" value="" class="searchBoardInput" />
									<img title="ajaxProjects" src="images/128-search.png" alt="Search" class="searchBoardImg" />
								</form>
							</div>
						</div>
					</div>
															
					<div id="userBox">
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

							
							<div class="projectMembers">
								<div class="projectInfoBox">								
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
							</div>
						</div>
					</div>
					
					<div class="projectExternalBoxes">
						<div class="projectExtra">
						
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
												$resultStatus = mysql_query("SELECT * FROM $core->tableProjectStatus");
												
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
					</div>

					<div class="pageContentMenuBox"><?php $core->printAllProjects(); ?></div>
					<div class="pageContentBox"></div>
					<div class="pageContentSearchBox"></div>
				</div>
			</div>

		</div>
    </div>
	
	<?php include_once("includes/wrapper.php") ?>
	
</body>
</html>