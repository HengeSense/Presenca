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
			
		<div id="presencaContent" class="pageContent" data-ajax="ajaxPresenca">
			
			<div class="menuContent">
				<div class="menuBoard leftBoard">
					<img src="images/50-arrow_left.png" class="" alt="Left" id="leftArrow"/>
					<img src="images/50-arrow_right.png" class="" alt="Right" id="rightArrow"/>
				</div>
				
				<div class="searchBoard rightBoard">
					<?php if ($core->group == 3 || $core->level >= 10) { ?>
						<img src="images/50-pen.png" class="" alt="Edit" id="editButton"/>
						<img src="images/50-text_documents.png" class="" alt="Copy" id="copyButton"/>
						<img src="images/50-time_clock.png" class="" alt="Review" id="reviewButton"/>
						<img src="images/50-star_unfilled.png" class="" alt="Favorite" id="favoriteButton"/>
					<?php } ?>
				</div>
			</div>
			
			<div id="userBox"></div>
			
			<div class="boardContent">
				<?php
					$core->weekFromNow = 0;
					$core->printTable();
				?>
			</div>
		</div>

    </div>
	
	<?php include_once("includes/wrapper.php") ?>
	
</body>
</html>