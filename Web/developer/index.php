<?php include_once("../includes/loginCheck.php"); ?>
<?php 

//	$url = explode(".", $_SERVER["SERVER_NAME"]);
//	$position = array_search("negociopresente", $url);
//	
//	
//	if ($position) {
//		if ($url[$position-1] != "developer") {
//			header("Location: http://developer.negociopresente.com/");
//		}
//	}
 ?><!--

	SISTEMA CRIADO POR PEDRO GÓES (pedrogoes.info)
	
	COMO SEMPRE, DEDICADO A MEMÓRIA DO MEU AMADO AVÔ

-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Negócio Presente Developer - Acessar seus dados nunca foi tão fácil!</title>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php if ($globalDev == 1) { ?>
	
	<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="../js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
	
	<script src="../js/default.js" type="text/javascript"></script>
	<script src="../js/developer.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../css/default.css" type="text/css" />
	<link rel="stylesheet" href="../css/developer.css" type="text/css" />
	
	<?php } else { ?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="../js/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script>!window.jQuery.ui && document.write(unescape('%3Cscript src="../js/jquery-ui-1.8.21.custom.min.js"%3E%3C/script%3E'))</script>
	
	<script src="../js/default.min.js" type="text/javascript"></script>
	<script src="../js/developer.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../css/default.min.css" type="text/css" />
	<link rel="stylesheet" href="../css/developer.css" type="text/css" />
	
	<?php } ?>
	
	<link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.min.css" type="text/css" />
	<script src="../js/analytics.js" type="text/javascript"></script>
	
	<link href="../favicon.ico" rel="icon" type="image/x-icon" />

</head>
<body>

	<div class="bar top">
		<div class="barWrapper">
			<ul class="leftBar">
				<a href="../index.php" target="_blank"><li>Negócio Presente</li></a>
			</ul>
			
			<ul class="rightBar">
			
				<li onclick="" class="userLoginLeading first">Developer</li>
				
			</ul>
		</div>
	</div>
	
	<div class="content">
		
		<div class="features">
		
			<div class="featureBox header">
				<p class="headline">Sua API. Nossa API.</p>
				<p class="sub">Acessar seus dados nunca foi tão fácil.</p>
			</div>
						
			<div style="clear: both;"></div>
	
		</div>
		
		<div class="documentation">
			<div class="menuDocumentation">
				<ul>
<!--					<li>Início</li>-->
					<li class="optionMenuDocumentationSelected"><b>Como usar</b></li>
					<li>Login</li>
					<li>HomePage</li>
					<li>Clientes</li>
					<li>Consultores</li>
					<li>Grupos</li>
					<li>Notificações</li>
					<li>Membros</li>
					<li>Presença</li>
					<li>Projetos</li>
				</ul>
			</div>
			<div class="contentDocumentation">


<!--				COMO USAR-->
				<div class="documentationBox documentationBoxSelected">
					<h2>Uso</h2>

					<p>Para utilizar a API do Negócio Presente, basta consultar nossa documentação disponível a esquerda. Abaixo temos um exemplo que será utilizado posteriormente para explicar o envio de requisições.</p>
					
					<h3>URL oficial</h3>
					<pre>https://negociopresente.com.br/developer/api/</pre>
					<br />
					
					<h3>Exemplo de documentação</h3>
					<div class="documentationFunctionBox">
						<p class="documentFunctionName">login.signIn(<b>username</b>, <b>password</b>, <b>companyID</b>)</p>

						<p class="documentFunctionDescription">Loga um usuário no sistema e retorna um <i>tokenID</i> que será utilizado para todas as outras operações no sistema.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>username</b><sub>GET</sub> : nome de usuário</p>
							<p><b>password</b><sub>GET</sub> : senha do usuário</p>
							<p><b>companyID</b><sub>GET</sub> : id da empresa</p>
						</div>

					</div>
					
					<h3>Exemplo de requisição</h3>
					<pre>https://negociopresente.com.br/developer/api/?method=login.signIn&username=Fulano&password=123456</pre>	
					<br />
					
					<h3>Explicação</h3>
					<p>Existem três seções demarcadas: <b>cabeçalho, retorno e parâmetros</b>, cada qual sendo explicada separadamente:</p>
						<ul>
							<li>O <b>cabeçalho</b> (login.signIn) apresenta a chamada, composto de um <u>namespace</u> (login) e seu <u>método</u> (signIn). A chamada deve ser enviada ao servidor através do parâmetro method via GET, para que seja identificada o tipo de informação que o cliente deseja.</li>
							<li>O <b>retorno</b> explica quais dados serão retornados, podendo o usuário sempre pode fazer uma requisição de teste para ver quais serão os dados de retorno.</li>
							<li>Os <b>parâmetros</b> (enterpriseID, username, password) mostram seu significado e por qual método devem ser enviados, variando sempre entre GET e POST.</li>
						</ul>
					<h3>Notas</h3>
					<p>A API do Negócio Presente utiliza um RPC-REST híbrido, utilizando o POST carregado como forma de enviar dados que necessitem de mais espaço. Além disso, todas as requisições são encriptadas em 256 bit por padrão.</p>
					
				</div>

<!--				LOGIN-->
				<div class="documentationBox">
					<h2>Login</h2>

					<p>O conteúdo abaixo é referente as ferramentas de login.</p>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">login.signIn(<b>username</b>, <b>password</b>, <b>companyID</b>)</p>

						<p class="documentFunctionDescription">Loga um usuário no sistema e retorna um <i>tokenID</i> que será utilizado para todas as outras operações no sistema.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>username</b><sub>GET</sub> : nome de usuário</p>
							<p><b>password</b><sub>GET</sub> : senha do usuário</p>
							<p><b>companyID</b><sub>GET</sub> : id da empresa</p>
						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">login.getCompanies()</p>

						<p class="documentFunctionDescription">Retorna uma lista das empresas cadastradas no sistema.</p>

					</div>

				</div>

<!--				HOMEPAGE-->
				<div class="documentationBox">
					<h2>HomePage</h2>
					
					<p>O conteúdo abaixo é referente as operações sobre a HomePage</p>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">home.getHomeType(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Função que lhe diz qual o tipo de home page utilizada para essa empresa.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>
					
					<div class="documentationFunctionBox">
						<p class="documentFunctionName">homepage.getNumberOfItensOnPage(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna o número de itens para a página principal, seja qual for o seu tipo.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">homepage.getNewsletters(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna as newsletters que se encontram na página inicial.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">homepage.getBlogposts(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna os blogposts que se encontram na página principal.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

				</div>

<!--				CLIENTES-->
				<div class="documentationBox">
					<h2>Clientes</h2>
					
					<p>O conteúdo abaixo é referente a ferramenta Clientes.</p>
					
					<div class="documentationFunctionBox">
						<p class="documentFunctionName">client.getNumberOfClients(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna o número de clientes cadastrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>


					<div class="documentationFunctionBox">
						<p class="documentFunctionName">client.getClients(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna a lista dos clientes registrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">client.getSingleClient(<b>tokenID</b>, <b>clientID</b>)</p>

						<p class="documentFunctionDescription">Retorna o JSON de um cliente baseado em seu ID.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>clientID</b><sub>GET</sub> : id do cliente</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">client.createClient(<b>tokenID</b>, <b>client</b>)</p>

						<p class="documentFunctionDescription">Esta função registra um novo cliente para essa empresa.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
							<p><b>client</b><sub>POST</sub> : objeto JSON com as informações do novo cliente</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">client.updateClient(<b>tokenID</b>, <b>client</b>)</p>

						<p class="documentFunctionDescription">Esta função atualiza as informações de um cliente já existente.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
							<p><b>client</b><sub>POST</sub> : objeto JSON com as informações atualizadas do cliente</p>

						</div>

					</div>

				</div>
				
<!--				CONSULTORES-->
				<div class="documentationBox">
					<h2>Consultores</h2>
					
					<p>O conteúdo abaixo é referente a ferramenta Consultores.</p>
					
					<div class="documentationFunctionBox">
						<p class="documentFunctionName">consultant.getNumberOfConsultants(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna o número de consultores cadastrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>


					<div class="documentationFunctionBox">
						<p class="documentFunctionName">consultant.getConsultants(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna a lista dos consultores registrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">consultant.getSingleConsultant(<b>tokenID</b>, <b>consultantID</b>)</p>

						<p class="documentFunctionDescription">Retorna o JSON de um consultor baseado em seu ID.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>consultantID</b><sub>GET</sub> : id do consultor</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">consultant.createConsultant(<b>tokenID</b>, <b>client</b>)</p>

						<p class="documentFunctionDescription">Esta função registra um novo consultor para essa empresa.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
							<p><b>consultant</b><sub>POST</sub> : objeto JSON com as informações do novo consultor</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">consultant.updateConsultant(<b>tokenID</b>, <b>client</b>)</p>

						<p class="documentFunctionDescription">Esta função atualiza as informações de um consultor já existente.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
							<p><b>consultant</b><sub>POST</sub> : objeto JSON com as informações atualizadas do consultor</p>

						</div>

					</div>

				</div>

<!--				GRUPOS-->
				<div class="documentationBox">
					<h2>Grupos</h2>

					<p>O conteúdo abaixo é referente a ferramenta Grupos</p>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">group.getNumberOfGroups(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna o número de grupos cadastrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
                        <p class="documentFunctionName">group.getGroups(<b>tokenID</b>)</p>

                        <p class="documentFunctionDescription">Retorna a lista dos grupos registrados para o token fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

                        </div>

                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">group.getSingleGroup(<b>tokenID</b>, <b>groupID</b>)</p>

                        <p class="documentFunctionDescription">Retorna as informações de um grupo específico baseado em seu ID.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>groupID</b><sub>GET</sub> : id do grupo</p>

                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">group.createGroup(<b>tokenID</b>, <b>group</b>)</p>
                        
                        <p class="documentFunctionDescription">Esta função cria um novo grupo para essa empresa.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>group</b><sub>GET</sub> : objeto JSON com as informações do novo grupo</p>

                        </div>

                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">group.updateGroup(<b>tokenID</b>, <b>group</b>)</p>

                        <p class="documentFunctionDescription">Esta função atualiza as informações de um grupo já existente.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>group</b><sub>GET</sub> : objeto JSON com as informações a serem atualizadas</p>

                        </div>

                    </div>

				</div>

<!--				NOTIFICAÇÕES-->
				<div class="documentationBox">
					<h2>Notificações</h2>
					
					<p>O conteúdo abaixo é referente a ferramenta Notificações. O número de notificações retornada varia de acordo com a função.</p>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getNumberOfNotifications(<b>tokenID</b>)</p>
                        
                        <p class="documentFunctionDescription">Retorna o número de notificações para o <i>tokenID</i> fornecido.</p>
                        
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
<!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->

                        </div>
                    
                    </div>
                    
                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getNewNotifications(<b>tokenID</b>)</p>
                        
                        <p class="documentFunctionDescription">Retorna a lista de notificações não lidas para o <i>tokenID</i> fornecido.</p>
                        
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                        </div>
                    
                    </div>
                    
                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getNotificationsSinceNotification(<b>tokenID</b>, <b>lastNotificationID</b>)</p>

                        <p class="documentFunctionDescription">Retorna uma lista com as notificações mais recentes que <i>lastNotificationID</i> para o <i>tokenID</i> fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
<!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->
                            <p><b>lastNotificationID</b><sub>GET</sub> : id da última notificação recebida</p>

                        </div>
                    
                    </div>
                    
                    <div class="documentationFunctionBox">
	                    <p class="documentFunctionName">notification.getNotificationsWithinTime(<b>tokenID</b>, <b>seconds</b>)</p>
	
	                    <p class="documentFunctionDescription">Retorna uma lista com as notificações que ocorreram nos últimos <i>seconds</i> segundos para o <i>tokenID</i> fornecido.</p>
	
	                    <div class="documentationFunctionParametersBox">
	                        <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
	<!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->
	                        <p><b>seconds</b><sub>GET</sub> : número inteiro referente ao tempo limite</p>
	
	                    </div>
	                
	                </div>
	                
	                <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getNewNotificationsWithinTime(<b>tokenID</b>, <b>seconds</b>)</p>
    
                        <p class="documentFunctionDescription">Retorna uma lista com as notificações não lidas que ocorreram nos últimos <i>seconds</i> segundos para o <i>tokenID</i> fornecido. Ideal caso o cliente necessite enviar solicitações várias vezes por minuto.</p>
    
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
    <!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->
                            <p><b>seconds</b><sub>GET</sub> : número inteiro referente ao tempo limite</p>
    
                        </div>
                    
                    </div>
	                
	                <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getNotificationsWithOffset(<b>tokenID</b>, <b>offset</b>)</p>
    
                        <p class="documentFunctionDescription">Retorna uma lista com as últimas notificações partindo da posição definida por <i>offset</i> para o <i>tokenID</i> fornecido.</p>
    
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
    <!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->
                            <p><b>offset</b><sub>GET</sub> : número inteiro referente a posição de início</p>
    
                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.getSingleNotification(<b>tokenID</b>, <b>notificationID</b>)</p>

                        <p class="documentFunctionDescription">Retorna a notificação <i>notificationID</i> para <i>tokenID</i> fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
<!--                            <p><b>userID</b><sub>GET</sub> : id do usuário</p>-->
                            <p><b>notificationID</b><sub>GET</sub> : id da notificação</p>

                        </div>

                    </div>

<!--                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">notification.areThereNewNotifications(<b>tokenID</b>, <b>lastNotificationID</b>)</p>

                        <p class="documentFunctionDescription">Checa se existem novas notificações para o <i>tokenID</i> fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>lastNotificationID</b><sub>GET</sub> : id da última notificação recebida</p>

                        </div>
                    
                    </div>-->

                </div>

<!--				MEMBROS-->
				<div class="documentationBox">
					<h2>Membros</h2>

					<p>O conteúdo abaixo é referente a ferramenta Membros.</p>

					<div class="documentationFunctionBox">
                        <p class="documentFunctionName">member.getNumberOfMembers(<b>tokenID</b>)</p>

                        <p class="documentFunctionDescription">Retorna o número de membros cadastrados para o token fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">member.getMembers(<b>tokenID</b>)</p>
                        
                        <p class="documentFunctionDescription">Retorna a lista dos membros registrados para o token fornecido.</p>
                        
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">member.getSingleMember(<b>tokenID</b>, <b>memberID</b>)</p>

                        <p class="documentFunctionDescription">Retorna o JSON de um membro baseado em seu ID.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>memberID</b><sub>GET</sub> : id do membro</p>

                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">member.createMember(<b>tokenID</b>, <b>member</b>)</p>
                        
                        <p class="documentFunctionDescription">Esta função cria um novo membro para essa empresa.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>member</b><sub>POST</sub> : objeto JSON com as informações do novo membro</p>

                        </div>

                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">member.updateMember(<b>tokenID</b>, <b>member</b>)</p>

                        <p class="documentFunctionDescription">Esta função atualiza as informações de um membro já existente.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>member</b><sub>POST</sub> : objeto JSON com as informações a serem atualizadas</p>

                        </div>

                    </div>
				</div>

<!--				PRESENÇA-->
				<div class="documentationBox">
					<h2>Presença</h2>

					<p>O conteúdo abaixo é referente a ferramenta Presença</p>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">presence.getPeriod(<b>tokenID</b>, <b>fromDate</b>, <b>toDate</b>)</p>

						<p class="documentFunctionDescription">Retorna os dias do periodo especificado com as informações sobre a presença neste dia.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
							<p><b>fromDate</b><sub>GET</sub> : data do inicio do período</p>
							<p><b>toDate</b><sub>GET</sub> : data do fim do período</p>

						</div>

					</div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">presence.getDay(<b>tokenID</b>, <b>day</b>)</p>

                        <p class="documentFunctionDescription">Retorna informações sobre a presença do dia específico.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>day</b><sub>GET</sub> : dia que se deseja as informações</p>

                        </div>

                    </div>

				</div>

<!--				PROJETOS-->
				<div class="documentationBox">
					<h2>Projetos</h2>

					<p>O conteúdo abaixo é referente a ferramenta Projetos</p>

					<div class="documentationFunctionBox">
						<p class="documentFunctionName">project.getNumberOfProjects(<b>tokenID</b>)</p>

						<p class="documentFunctionDescription">Retorna o número de projetos cadastrados para o token fornecido.</p>

						<div class="documentationFunctionParametersBox">
							<p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

						</div>

					</div>

					<div class="documentationFunctionBox">
                        <p class="documentFunctionName">project.getProjects(<b>tokenID</b>)</p>

                        <p class="documentFunctionDescription">Retorna a lista dos projetos registrados para o token fornecido.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

                        </div>

                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">project.getSingleProject(<b>tokenID</b>, <b>projectID</b>)</p>

                        <p class="documentFunctionDescription">Retorna informações de um projeto.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>projectID</b><sub>GET</sub> : id do projeto</p>

                        </div>
                    
                    </div>
                    
                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">project.getStates(<b>tokenID</b>)</p>

                        <p class="documentFunctionDescription">Retorna todos os possíveis estados que um projeto pode ter.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>

                        </div>
                    
                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">project.createProject(<b>tokenID</b>, <b>project</b>)</p>
                        
                        <p class="documentFunctionDescription">Esta função cria um novo projeto para essa empresa.</p>

                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>project</b><sub>GET</sub> : objeto JSON com as informações do novo projeto</p>

                        </div>

                    </div>

                    <div class="documentationFunctionBox">
                        <p class="documentFunctionName">project.updateProject(<b>tokenID</b>, <b>project</b>)</p>
                        
                        <p class="documentFunctionDescription">Esta função atualiza as informações de um projeto já existente.</p>
                        
                        <div class="documentationFunctionParametersBox">
                            <p><b>tokenID</b><sub>GET</sub> : seu id recebido no início da sessão</p>
                            <p><b>project</b><sub>GET</sub> : objeto JSON com as informações a serem atualizadas</p>

                        </div>

                    </div>

				</div>

				<div class="demoDocumentation"></div>

			</div>
		</div>

		<div id="wrapper">
			<p>&reg;<a target="_blank" href="http://estudiotrilha.com.br">Estúdio Trilha 2012</a> &nbsp;&nbsp;&nbsp; Todos os direitos reservados</p>
		</div>
	</div>

</body>
</html>