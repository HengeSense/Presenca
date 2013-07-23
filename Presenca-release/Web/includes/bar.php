<div class="bar top">
	<ul class="leftBar">
		<a href="index.php"><li>Home</li></a>
		<a href="presenca.php"><li>Presença</li></a>
		<a href="projects.php"><li>Projetos</li></a>
		<!-- <a href="flowchart.php"><li>Fluxograma</li></a> -->
		<a href="members.php"><li>Membros</li></a>
		<a href="clients.php"><li>Clientes</li></a>
		<a href="consultants.php"><li>Consultores</li></a>
		<a href="groups.php"><li>Grupos</li></a>
	</ul>
	
	<ul class="rightBar">
		
		<li onclick="" class="notificationsInfo"><span class="notificationsInfoCount">0</span> <img class="downArrow" src="images/16-br-down.png" alt="Down arrow" /></li>
		
		<li onclick="" class="notifications barContainer">
			<div class="notificationsHeader"></div>
		
			<div class="notificationsContent">
				<ul>
				
				</ul>
			</div>
			
			<div class="notificationsBottom">
				<ul><li class="notificationLoadExtra">Carregar mais notificações ...</li></ul>
			</div>
		</li>
	
		<li onclick="" class="userSettingsInfo">Olá <?php echo $core->truncateName($core->user, 15) ?>! <img class="downArrow" src="images/16-br-down.png" alt="Down arrow" /></li>
		
		<li onclick="" class="userSettingsMenu barContainer">
			<ul>
			
				<!-- SUPER USERS -->
				<li class="powerUsersItem firstItem">
					<span class="firstItemText">Usuários com poderes</span>
					<ul>
					<?php if ($core->level >= 10) { ?>

						<li class="powerUsersList firstAnchor barContainer collectionBox">
							<ul>
								<li class="powerUsersListAnchor secondItem">
									<span class="secondItemText">Adicionar usuário</span>
									<ul>
										<li class="powerUsersAddList secondAnchor barContainer collectionSelected">
											<ul>
												<li class="powerUsersSearch"><input title="<?php echo $core->tableUser ?>" type="text" name="powerUsersSearchInput" class="powerUsersSearchInput collectionSelectedInput" value="" placeholder="Quem?" /></li>
											</ul>
											<ul class="collectionOptions barContainer">
				
											</ul>
										</li>
										<li class="powerUsersActiveUsers collectionSelectedList">
											<ul>
												<?php // $core->printPowerUsers() ?>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
				
					<?php } else { ?>
					
						<li class="powerUsersList firstAnchor powerUsersActiveUsers barContainer"></li>
					
					<?php } ?>
				
					</ul>
				</li>


				<!-- USER SETTINGS -->
				<li class="userSettingsItem firstItem">
					<span class="firstItemText">Preferências do usuário</span>
					<ul>
						<li class="firstAnchor barContainer">
							<ul>
								<li class="secondItem">
									<span class="secondItemText">Trocar senha</span>
									<ul>
										<li class="secondAnchor barContainer">
											<ul>
												<form method="post" action="#">
													<li><input title="<?php echo $core->tableUser ?>" type="password" name="oldPassword" class="oldPassword" placeholder="Senha atual" tabindex="1"/></li>
													<li><input title="<?php echo $core->tableUser ?>" type="password" name="newPassword" class="newPassword" placeholder="Nova senha" tabindex="2"/></li>
													<li class="saveButton">Trocar</li>
												</form>
											</ul>
										</li>

									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				
				
				
				<a href="logout.php"><li class="logoutButton">Logout</li></a>
			</ul>
		</li>
	</ul>
</div>
