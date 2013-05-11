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
			
	<!--		<applet name="applet" id="applet" archive="macaddress-applet.jar" code="info.pedrogoes.MacAddressApplet" height="0" width="0" MAYSCRIPT></applet>-->
		
			
		
			<div class="menuContent">

			<!--	<a class="right pointer" href="logout.php"><img src="images/32-logout.png" alt="Exit" id="exitButton"/></a>-->
				<?php if ($core->group == 1) { ?>
					<img src="images/48-plus.png" class="right pointer" alt="Add" id="addProjectButton"/>
					<img src="images/50-pen.png" class="right pointer" alt="Edit" id="editProjectButton"/>
				<?php } ?>
			</div>
			
			
			<!--Content-->
			<div id="eventContent" class="pageContent">
				<div id="userBox"></div>
			</div>

		</div>
    </div>
	
	<?php include_once("includes/wrapper.php") ?>
	
</body>
</html>