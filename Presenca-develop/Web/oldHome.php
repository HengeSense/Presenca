<?php
	include_once("includes/check/login.php");
	
		if (!$core->auth) logout();
?>

<?php
	/*
	$query = "SELECT * FROM $core->tableUser WHERE `id`=$core->userID";
	$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
	$photo = mysql_result($result, 0, "photo");


	if (strpos($photo, "caricatura") !== false) {
		echo "<script>alert('Por favor, preencha seus dados dentro do seu cartão (inclusive a foto). Caso contrário, não poderemos liberar acesso ao plantão.');</script>";
	}
	*/
?>

<?php include_once("includes/header.php") ?>
<body>
	<?php include_once("includes/bar.php") ?>
	<div id="content">

		<!--Content-->
		<div id="indexContent" class="pageContent">
			<div id="userBox"></div>
			
			<div class="boardContent">
			
			
			<!-- <div class="indexContentType">
				<p>Escolha como ficará sua página inicial</p>
				
				<div class="indexContentTypeOption indexContentTypeNewsletterOption">
					<p>Newsletter</p>
					<div class="indexContentTypeOptionContentWrapper">
						<div class="newsletter indexContentTypeOptionContent">
							<img src="images/128-needle-yellow.png" alt="Pin Yellow" class="newsletterPin"/>
							<img src="images/newsletter/Newsnews.jpg" alt="Newsletter" class="newsletterImg"/>
							<div class="imgCredits">
								<p><i>by</i> Me</p>
							</div>
						</div>
					</div>
				</div>
			
				
				<div class="indexContentTypeOption indexContentTypeSystemOption">
					<p>Sistema</p>
					<div class="indexContentTypeOptionContentWrapper">
						<div class="system indexContentTypeOptionContent">
							<div class="newsletter indexContentTypeOptionContent">
								<img src="images/128-needle-yellow.png" alt="Pin Yellow" class="newsletterPin"/>
								<img src="images/newsletter/Newsnews.jpg" alt="Newsletter" class="newsletterImg"/>
								<div class="imgCredits">
									<p><i>by</i> Me</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->

			</div>
		</div>

    </div>
	
	<?php include_once("includes/wrapper.php") ?>
	
</body>
</html>