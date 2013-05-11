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
			<div id="projectContent" class="pageContent">
				<div class="boardContent">
					
					<div class="menuContent">
						<div class="menuBoard leftBoard">
							<?php if ($core->group == 1 || $core->level >= 10) { ?>
								<input type="button" name="" value="Novo projeto" class="menuBoardInput" id="addProject" />
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
															
					<div id="userBox"></div>

					<div class="pageContentBox">
						<?php $core->printAllProjects(); ?>
					</div>
					<div class="pageContentSearchBox"></div>
				</div>
			</div>

		</div>
    </div>
	
	<?php include_once("includes/wrapper.php") ?>
	
</body>
</html>