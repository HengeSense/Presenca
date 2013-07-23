<?php
	include_once("includes/check/login.php");
	
		if (!$core->auth) logout();
?>

<?php include_once("includes/header.php") ?>
<body>
	<?php include_once("includes/bar.php") ?>
	<div id="content">
			
		<!--Content-->
		<div id="groupsContent" class="pageContent" data-ajax="ajaxGroups">
			
			<div class="menuContent">
				<div class="menuBoard leftBoard">
					<?php if ($core->group == 3 /* RH */ || $core->level >= 10) { ?>
						<input type="button" name="" value="Novo grupo" class="menuInput" id="add" />
						<img src="images/48-drag.png" alt="Edit" class="editButton"/>
					<?php } ?>
				</div>
				
				<div class="searchBoard rightBoard">
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
					<?php $core->printGroups(); ?>
				</div>
				<div class="pageContentSearchBox"></div>
				
				<li value="0" class="post newPost postCentralized infoContainer defaultInfoContainer">
					<form method="post" action="#">
						<input type="hidden" id="memberID" value="0" />
						<div class="postHolder"></div>
						<?php if ($core->group == 3 /* RH */ || $core->level >= 10) { ?>
			    		<div class="postTurner">
			    			<img class="editButton" src="images/64-Pencil.png" alt="Turn the card around" />
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
								<img src="images/128-users.png" alt="Group logo" />
							</div>
						
							<div class="postInformation">
								<div class="postName"><input class="infoContainerInputContent" placeholder="Nome" type="text" id="name" title="name" tabindex="1"/></div>
								<span class="postParenthesisLeft">(</span>
								<span class="postAcronym"><input class="infoContainerInputContent" placeholder="Acrônimo" type="text" id="acronym" title="acronym" tabindex="2"/></span>
								<span class="postParenthesisRight">)</span>
							</div>
							<div class="infoContainerSave saveButton">Salvar!</div>
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