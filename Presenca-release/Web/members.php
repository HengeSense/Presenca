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
			
		<!--Content-->
		<div id="membersContent" class="pageContent" data-ajax="ajaxMembers">
			
			<div class="menuContent">
				<div class="menuBoard leftBoard">
					<?php if ($core->group == 3 || $core->level >= 10) { ?>
						<input type="button" name="" value="Novo membro" class="menuInput" id="add" />
					<?php } ?>
				</div>
				
				<div class="searchBoard rightBoard">
					<div class="sliderBoardWrapper"><div class="sliderBoard"></div><p>Redimensionar</p></div>
					<form method="post" action="#" class="searchBoardWrapper">
						<input placeholder="Buscar" type="text" name="" value="" class="searchBoardInput" />
						<img src="images/50-search.png" alt="Search" class="searchBoardImg" />
					</form>
				</div>
			</div>
			
			<div id="userBox"></div>
			
			<div class="boardContent">
				<div class="snowflake"></div>
				
				<div class="pageContentBox">
					<?php $core->printAllUsers(); ?>
				</div>
				<div class="pageContentSearchBox"></div>
				
				<li class="badge newBadge badgeCentralized infoContainer defaultInfoContainer">
					<form method="post" action="#">
						<input type="hidden" id="memberID" value="0" />
						<div class="badgeHolder"></div>
						<div class="badgeTurner">
							<img class="editButton" src="images/48-redo.png" alt="Turn the badge around" />
						</div>
						<div class="badgeImage infoContainerImage">
							<div id="file-uploader"></div>
							<img src="images/128-man.png" alt="Imagem do membro" id="imagePhoto" />
						</div>
						<div class="badgeName"><input class="infoContainerInputContent" placeholder="Nome" type="text" title="user" id="name" /></div>
						<div class="badgePassword"><input class="infoContainerInputContent" placeholder="Senha" type="password" title="password" id="password" /></div>
						<div class="badgePosition"><input class="infoContainerInputContent" placeholder="Cargo" type="text" title="position" id="position" /></div>
						<div class="badgeExtra infoContainerExtra">
							<p class="general"><span class="bold">Aniversário:</span> <input class="infoContainerInputContent" placeholder="Aniversário" type="text" title="birthday" id="birthday" /></p>
							<p class="general"><span class="bold">Telefone:</span> <input class="infoContainerInputContent" placeholder="Telefone" type="text" title="telephone" id="telephone" /></p>
							<p class="general"><span class="bold">Email:</span> <input class="infoContainerInputContent" placeholder="Email" type="text" title="email" id="email" /></p>
							
							<div class="infoContainerSave badgeSave saveButton">Salvar!</div>
							<div class="saveButtonError"></div>
						</div>
					</form>
				</li>
			</div>

		</div>
    </div>
    
    <?php include_once("includes/wrapper.php") ?>
	
</body>
</html>