<?php
	include_once("includes/loginCheck.php");
	
	if ($core->logado) {
		header("Location: index.php");
	}
?>
<?php include_once("includes/header.php") ?>
<body>
	<?php include_once("includes/barExternal.php") ?>
	<div id="content" class="indexContent">
		
		<article class="section">
			
			<div class="featureBox header">
				<img class="floatLeft" src="images/logoNP@100dbi.png" alt="Top bar" />
				<div class="text">
					<h2 class="title">Negócio Presente</h2>
					<p class="headline">A plataforma de gerencimento empresarial simples e eficiente.</p>
					<p class="sub">Sua empresa nunca esteve em melhores mãos.</p>
				</div>
			</div>
			
<!-- 			<ul class="stepByStep">
				<li>
					<img src="images/256-egretBlueOrdering.png" alt="Client" class="egret egretOrdering">
					<p class="title">Veja seu plantão.</p>
				</li>
				<li>
					<img src="images/256-egretGreenReceiving.png" alt="Chef Receiving" class="egret egretReceiving">
					<p class="title">Clique.</p>
				</li>
				<li>
					<img src="images/256-egretRedDelivering.png" alt="Waiter" class="egret egretDelivering">
					<p class="title">E depois entrega ao cliente!</p>
				</li>
			</ul> -->
			
			<div class="coolBox coolBoxSelfish">
				<ul>
					<li>
						<div>
							<img src="images/50-check.png" alt="Sem custos">
							<div class="text">
								<p class="title">Sem custos de instalação</p>
								<p class="description">Sem taxas e contratos, a implementação da plataforma é simples e rápida!</p>
							</div>
						</div>
						<div>
							<img src="images/50-love.png" alt="Ame seu orçamento">
							<div class="text">
								<p class="title">Reduza seus custos</p>
								<p class="description">Simplifique seu controle e aumente a produtividade de sua empresa.</p>
							</div>
						</div>
					</li>
					<li>
						<img src="images/50-home.png" alt="Plano">
						<div class="text">
							<p class="title">Um plano completo</p>
							<p class="description">Perfeito para suas necessidades!</p>
							<div class="planWrapper">
								<div class="plan">
									<div class="text">
										<p class="title">Mensal</p>
										<p class="description">Aproveite nosso valor de lançamento!</p>
									</div>
									<div class="price">R$ 34,90 <span>/mês</span></div>
								</div>
								<div class="plan">
									<div class="text">
										<p class="title">Anual</p>
										<p class="description">No plano anual, <b>ganhe 2 meses gratuitos!</b></p>
									</div>
									<div class="price">R$ 349,00<span>/ano</span></div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			
		</article>
		
		<article class="section">
			<div class="header">
				<p class="title">Presença integrada</p>
				<p class="description">Controle a presença de todos os membros</p>
			</div>
			
			<div class="masterBlock">
				<div class="leftBlock coolBox">
					<ul>
						<li>
							<img src="images/50-pen.png" alt="Edit"/>
							<div class="text">
								<p class="title">Edite <i>on the go</i></p>
								<p class="description">Altere os horários de plantão de qualquer membro rapidamente.</p>
							</div>
						</li>
						<li>
							<img src="images/50-text_documents.png" alt="Copy"/>
							<div class="text">
								<p class="title">Mantenha a consistência</p>
								<p class="description">Toda semana, copie a tabela de plantões e altere apenas o necessário.</p>
							</div>
						</li>
						<li>
							<img src="images/50-time_clock.png" alt="Review"/>
							<div class="text">
								<p class="title">Revise as faltas</p>
								<p class="description">Avalie as justificativas de falta em um clique.</p>
							</div>
						</li>
						<li>
							<img src="images/50-star_filled.png" alt="Favorite">
							<div class="text">
								<p class="title">Autorize os pontos de acesso</p>
								<p class="description">Escolha onde seus membros podem entrar no plantão.</p>
							</div>
						</li>
						<li>
							<img src="images/50-arrow_left.png" alt="Shift">
							<div class="text">
								<p class="title">Histórico simplificado</p>
								<p class="description">Avance entre todas as semanas em razão de milisegundos!</p>
							</div>
						</li>
						
					</ul>
				</div>
				
				<div class="rightBlock">
					<img class="promoImage" src='images/demo/presenca.png' alt="Presenca demo" />
				</div>
			</div>
			
		</article>
			
		<article class="section">
			<div class="header">
				<p class="title">Exponha seus projetos</p>
				<p class="description">Gerencie os projetos de sua empresa</p>
			</div>
			
			<div class="masterBlock">
				<div class="leftBlock">
					<img class="promoImage" src='images/demo/projects.png' alt="Projetos demo" />
				</div>
				
				<div class="rightBlock coolBox">
					<ul>
						<li>
							<img src="images/50-pen.png" alt="Edit"/>
							<div class="text">
								<p class="title">Rápidas edições</p>
								<p class="description">Altere as informações em instantes.</p>
							</div>
						</li>
						<li>
							<img src="images/50-photos.png" alt="Photos"/>
							<div class="text">
								<p class="title">Escolha uma foto</p>
								<p class="description">Seu projeto com uma imagem para rápida assimilição.</p>
							</div>
						</li>
						<li>
							<img src="images/50-calendar.png" alt="Details">
							<div class="text">
								<p class="title">Detalhe suas informações</p>
								<p class="description">Use os campos adequados para uma maior eficiência.</p>
							</div>
						</li>
						<li>
							<img src="images/50-users.png" alt="Users">
							<div class="text">
								<p class="title">Indique as pessoas</p>
								<p class="description">Mostre em seu projeto quem está atualmente associado com ele.</p>
							</div>
						</li>
						<li>
							<img src="images/50-screen.png" alt="Display"/>
							<div class="text">
								<p class="title">Visualize seus projetos</p>
								<p class="description">Escolha a maneira para dispor seus projetos.</p>
							</div>
						</li>
					</ul>
				</div>
			</div>

		</article>
			
		<article class="section">
			<div class="header">
				<p class="title">Valorize seus membros</p>
				<p class="description">Cartões pessoais dos membros de sua equipe</p>
			</div>
			
			<div class="masterBlock">
				<div class="leftBlock coolBox">
					<ul>
						<li>
							<img src="images/50-address_book.png" alt="Contacts"/>
							<div class="text">
								<p class="title">Acesso aos contatos</p>
								<p class="description">Rapidamente encontre os contatos dos membros.</p>
							</div>
						</li>
						<li>
							<img src="images/50-new_email.png" alt="Email">
							<div class="text">
								<p class="title">Envie email</p>
								<p class="description">Utilizando o Gmail, envie emails diretamente!</p>
							</div>
						</li>
						<li>
							<img src="images/50-pen.png" alt="Edit"/>
							<div class="text">
								<p class="title">Edite <i>on the go</i></p>
								<p class="description">Modifique os dados em dois cliques.</p>
							</div>
						</li>
						<li>
							<img src="images/50-power.png" alt="Active"/>
							<div class="text">
								<p class="title">Escolha os membros ativos</p>
								<p class="description">Saiba quem são os atuais e ex-membros.</p>
							</div>
						</li>
						<li>
							<img src="images/50-locked.png" alt="Locked">
							<div class="text">
								<p class="title">Defina as permissões</p>
								<p class="description">Mantenha usuários selecionados para alterar o sistema.</p>
							</div>
						</li>
					</ul>
				</div>
				
				<div class="rightBlock">
					<img class="promoImage" src='images/demo/members.png' alt="Members demo" />
				</div>
			</div>
			
		</article>
			
		<article class="section">
			<div class="header">
				<p class="title">Lindos cartões</p>
				<p class="description">Seus clientes e consultores em primeira mão</p>
			</div>
			
			<div class="masterBlock">
				<div class="leftBlock">
					<img class="promoImage" src='images/demo/clients.png' alt="Clients demo" />
				</div>
				
				<div class="rightBlock coolBox">
					<ul>
						<li>
							<img src="images/50-plus.png" alt="Add"/>
							<div class="text">
								<p class="title">Adicione seus clientes</p>
								<p class="description">Não perca nenhum contato.</p>
							</div>
						</li>
						<li>
							<img src="images/50-id.png" alt="Identity"/>
							<div class="text">
								<p class="title">Sua identidade</p>
								<p class="description">Grave todas as informações necessárias.</p>
							</div>
						</li>
						<li>
							<img src="images/50-presentation.png" alt="Presentation"/>
							<div class="text">
								<p class="title">Escolha o tamanho</p>
								<p class="description">Seus cartões mudam de tamanho.</p>
							</div>
						</li>
						<li>
							<img src="images/50-graph.png" alt="Graphic">
							<div class="text">
								<p class="title">Aumente seu número de clientes</p>
								<p class="description">Mais cartões para diversos grupos.</p>
							</div>
						</li>
						<li>
							<img src="images/50-text_document.png" alt="Document">
							<div class="text">
								<p class="title">Observe o histórico</p>
								<p class="description">Saiba em quais projetos está associado.</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			
		</article>
			
		<article class="section">
			<div class="header">
				<p class="title">Grupos organizados</p>
				<p class="description">Um espaço único para ver sua equipe</p>
			</div>
			
			<div class="masterBlock">
				<div class="leftBlock coolBox">
					<ul>
						<li>
							<img src="images/50-clipboard.png" alt="Clipboard"/>
							<div class="text">
								<p class="title">Seu organograma </p>
								<p class="description">Visualize todos os grupos em um único lugar.</p>
							</div>
						</li>
						<li>
							<img src="images/50-user.png" alt="User"/>
							<div class="text">
								<p class="title">Encontre um membro</p>
								<p class="description">Todos os membros, todos os grupos.</p>
							</div>
						</li>
						<li>
							<img src="images/50-cut.png" alt="Move"/>
							<div class="text">
								<p class="title">Mova os membros</p>
								<p class="description">Troque o membro de grupo em um arrasto!</p>
							</div>
						</li>
						<li>
							<img src="images/50-bookmark_2.png" alt="Bookmark">
							<div class="text">
								<p class="title">Encontre os cargos</p>
								<p class="description">Identifique com a tarja especial.</p>
							</div>
						</li>
						<li>
							<img src="images/50-talk.png" alt="Talk">
							<div class="text">
								<p class="title">Converse com sua equipe</p>
								<p class="description">Encontre seus diferenciais.</p>
							</div>
						</li>
						
					</ul>
				</div>
				
				<div class="rightBlock">
					<img class="promoImage" src='images/demo/groups.png' alt="Groups demo" />
				</div>
			</div>

		</article>
			
		<article class="section">
			<div class="header">
				<p class="title">Ferramentas únicas</p>
				<p class="description">Ferramentas que complementam sua experiência</p>
			</div>
			
			<div class="masterBlock featureBoxMiniWrapper">
				<div class="featureBoxMini coolBox">
					<img src="images/50-new_email.png" alt="Notification">
					<div class="text">
						<p class="title">Central de Notificações</p>
						<p class="description">Notificações em tempo real para todos os usuários.</p>
					</div>
					<img class="promoImage mini floatLeft" src='images/demo/notification.png' alt="Feature 1" />
				</div>
				
				<div class="featureBoxMini coolBox">
					<img src="images/50-preferences.png" alt="Preferences">
					<div class="text">
						<p class="title">Menu de Preferências</p>
						<p class="description">Veja quem são os super usuários, altere seus dados e muito mais!</p>
					</div>
					<img class="promoImage mini floatLeft" src='images/demo/settings.png' alt="Feature 1" />
				</div>
				
				<div class="featureBoxMini coolBox">
					<img src="images/50-search.png" alt="Search">
					<div class="text">
						<p class="title">Barra de Pesquisa</p>
						<p class="description">Procurando algo? Use nossa barra de pesquisa e encontre na hora!</p>
					</div>
					<img class="promoImage mini floatLeft" src='images/demo/search.png' alt="Feature 1" />
				</div>
			</div>
			
			<div style="clear: both;"></div>
	
		</article>
		
		<!-- <div class="pageContent indexContent">
		
			<article class="section">
				<div class="header">
					<p class="title">Pronto para a revolução?</p>
					<p class="description">Após completar o cadastro, seu sistema já estará pronto para uso dentro de instantes.</p>
					<p class="bigLink"><a href="data.php">Quero me cadastrar agora!</a></p>
				</div>
			</article>
			
		</div> -->
		
		<?php include_once("includes/wrapperExternal.php") ?>
	</div>
	
</body>
</html>