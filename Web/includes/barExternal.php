<div class="bar top loginBar">
	<div class="barWrapper">
		<ul class="leftBar">
			<a href="index.php"><li>Negócio Presente</li></a>
		</ul>
		
		<ul class="rightBar">
		
			<li onclick="" class="userLoginLeading first">Entrar!</li>
			
			<li onclick="" class="userLoginBox secondary">
			
				<div class="userCompanyBox floatLeft">
					
					<p>Escolha sua empresa</p>
					<div class="promoImage" style="background-image: url('images/logo.png')" alt="Feature 1"></div>
					
					<div class="selectBox">
						<div class="selectSelected">
							<ul>
								<li class="placeholder">Qual?</li>
							</ul>
						</div>
						<div class="selectOptions">
							<ul>
							<?php

							// Get all valid companies inside our system
							$result = $core->resourceForQuery("SELECT * FROM $core->tableEnterprise WHERE `valid`=1");

							for ($i = 0; $i < mysql_num_rows($result); $i++) {
								$id = mysql_result($result, $i, "id");
								$tradeName = mysql_result($result, $i, "tradeName");

								echo "<li value='$id'>$tradeName</li>";
							}

							?>
							</ul>
						</div>
					</div>
				</div>
				
				
				<div class="userMemberBox floatRight">
					
					<p>Insira seus dados</p>
					
					<form method="post" action="login.php">
						<input type="hidden" name="enterprise" value="1" id="enterprise" />
						<input placeholder="Usuário" type="text" name="user"/>
						<input placeholder="Senha" type="password" name="password"/>
						<input type="image" src="images/right.png" name="" id="imagemForm" alt="Enviar Formulário"/>
					</form>
				</div>

			</li>
			
			<li onclick="" class="userRegisterLeading first">Registrar!</li>
			
			<li onclick="" class="userRegisterBox secondary">
			
				<div class="userCompanyBox floatLeft">
					
					<p>Envie seu logo</p>

					<div class="promoImage file-uploaderTrigger" style="background-image: url('')" alt="Feature 1" />
						<div id="file-uploader">
							<noscript>
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>
						</div>
					</div>
					
				</div>
				
				
				<div class="userMemberBox floatRight">
					
					<p>Insira seus dados</p>
					
					<form method="post" action="login.php">
						<input placeholder="Nome da empresa" type="text" name="user"/>
						<input type="image" src="images/right.png" name="" id="imagemForm" alt="Enviar Formulário"/>
					</form>
				</div>
				
			</li>
		</ul>
	</div>
</div>