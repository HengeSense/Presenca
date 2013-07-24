<?php
	include_once("includes/check/login.php");
	
		if (!$core->auth) logout();
?>

<?php include_once("includes/header.php") ?>
<body>
	<?php include_once("includes/bar.php") ?>
	<div id="content">
			
		<!--Content-->
		<div id="clientsContent" class="pageContent" data-ajax="ajaxClients">
			
				<div class="menuContent">
					<div class="menuBoard leftBoard">
						<?php if ($core->group == 1 || $core->level >= 10) { ?>
							<input type="button" name="" value="Novo cliente" class="menuInput" id="add" />
						<?php } ?>
					</div>
					
					<div class="searchBoard rightBoard">
						<div class="sliderBoardWrapper"><div class="sliderBoard"></div><p>Redimensionar</p></div>
						<form method="post" action="#" class="searchBoardWrapper">
							<input placeholder="Buscar" type="text" name="" value="" class="searchBoardInput" />
							<img src="images/64-Magnifying-Glass-2.png" alt="Search" class="searchBoardImg" />
						</form>
					</div>
				</div>
				
				<div id="userBox"></div>
				
				<div class="boardContent">
					<div class="snowflake"></div>
					
					<div class="pageContentBox">
						<?php $core->printClients(); ?>
					</div>
					<div class="pageContentSearchBox"></div>

					
					<li class="card newCard cardCentralized infoContainer defaultInfoContainer">
						<form method="post" action="#">
							<input type="hidden" id="memberID" value="0" />
							<div class="cardTurner">
								<img class="editButton" src="images/64-Pencil.png" alt="Turn the card around" />
							</div>
							<div class="cardName"><input class="infoContainerInputContent" placeholder="Nome" type="text" id="user" title="user" /></div>
							<div class="cardPosition"><input class="infoContainerInputContent" placeholder="Cargo" type="text" id="position" title="position"/></div>
							
							<div class="cardBottom">
								<div class="cardEmail">
									<p class="general"><!--<span class="bold">Email: </span>--><input class="infoContainerInputContent" placeholder="Email" type="text" id="email" title="email" /></p>
								</div>
								<div class="cardTelephone">
									<p class="general"><!--<span class="bold">Telefone: </span>--><input class="infoContainerInputContent" placeholder="Telefone" type="text" id="telephone" title="telephone"/></p>
								</div>
								
								<div class="infoContainerSave saveButton">Salvar!</div>
								<div class="saveButtonError"></div>
							</div>
							
							<div class="cardExtra"></div>
						</form>
					</li>
				</div>
				
			</div>
		</div>
    </div>
    
    <?php include_once("includes/wrapper.php") ?>
	
</body>
</html>