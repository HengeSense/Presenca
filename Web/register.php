<?php
	include_once("includes/check/login.php");
?>

<?php include_once("includes/html/header.php") ?>
<body class="deadNotifications">
	<?php include_once("includes/html/bar.php") ?>	
	<div id="content">

		<div id="registerContent" class="pageContent">
		
			<div class="titleContent">Cadastro</div>
					
			<div class="boardContent">
				<div class="boardContentInnerWrapper">
					
					<div class="pageContentBox">
					
						<div class="registrationConflict">
							<p><img src="images/64-Alert-2.png" alt="Alert" />Aparentemente elas já estavam cadastradas em nosso banco de dados.</p>
						</div>
					
						<div class="registrationComplete">
							<p><img src="images/32-Check.png" alt="Check" />Seu cadastro foi concluído com sucesso!</p>
						</div>
						
						<div class="registrationFailed">
							<p><img src="images/32-Cross.png" alt="Cross" />Hum, seus dados ainda não foram salvos. Revise-os e tente novamente.</p>
							<ul class="navigator">
								<a href="location.php"><li>Localização <span class="navigatorHint navigatorHintRight">Anterior</span></li></a>
							</ul>
						</div>
						
						<div class="box informationBox">
							<p class="informationTitle">Informações gerais</p>
							
							<p class="firstParagraph">Antes de mais nada, <b>seja bem-vindo ao Garça!</b> Nossa plataforma foi criada para que você, dono de estabelecimento comercial, pudesse oferecer o melhor serviço para seu consumidor de forma simples, prática e com investimento zero.</p>
							
							<p>Em um prazo de no máximo 24h, um de nossos agentes irá confirmar o seu cadastro (talvez faça uma ligação para confirmar alguns dados), liberando o acesso de nossa plataforma para todos seus clientes. Neste meio tempo, fique a vontade para ir cadastrando seus cardápios, criando suas mesas, habilitando listas de reserva ou definindo os ajustes gerais de seu estabelecimento.</p>
							
							<p>Assim que for liberado, enviaremos para você um conjunto composto por adesivos, assim como um <i>banner</i> para indicar que seu estabelecimento é um parceiro <b>Garça</b>. Se quiser, poderá fixar no lugar mais visível possível, para que seus clientes vejam claramente a indicação sobre a plataforma. Caso queira mais adesivos para, por exemplo, colocar um em cada mesa ou para repor algum que foi perdido, fique a vontade para solicitar mais unidades.</p>
							
							<p>Nosso sistema funciona preferencialmente no <b>Google Chrome</b>, atualmente o melhor navegador do mercado. 
							Se os computadores de seu restaurante ainda não o tem instalado, <a href="http://www.google.com/chrome" target="_blank">clique aqui para baixar</a>.</p>
							
							<p>E sempre que precisar de qualquer ajuda, consulte nossa central de suporte. Nós levamos seu negócio muito a sério e, por isso, nós nunca lhe deixaremos na mão.</p>
							
							<p class="signature">Obrigado, <br />Diretoria do Garça</p>
							
							<!-- <p class="reminder">As informações abaixo também foram enviadas para seu email.</p> -->
						</div>
					</div>
					
				</div>
			</div>

		</div>
    </div>
    
    <?php include_once("includes/html/wrapper.php") ?>
</body>
</html>