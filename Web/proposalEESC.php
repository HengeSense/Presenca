<?php
	include_once("includes/loginCheck.php");
	
	if ($core->logado) {
		header("Location: index.php");
	}
?>
<?php include_once("includes/header.php") ?>
<body>
	
	
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
			
		<article class="section">
			
			<div class="masterBlock letterBlock">
				<p class="title">Boa noite à todos,</p>
				
				<p class="description">Venho através deste delinear os pontos necessários para a aquisição de mensalidade recorrente do Negócio Presente pela EESC jr., de modo a facilitar a integração da empresa júnior com o sistema que tem como forte seu controle de presença, dentre os demais atributos que o compõem.</p>
				
				<p class="description">Ficou acordado na metade do ano passado que o sistema se permaneceria gratuito para EESC jr. caso esta fornecesse informações para o desenvolvimento futuro do produto assim como o Estúdio Trilha se comprometia a prover um ambiente seguro para inserção dos dados da empresa. Dado o prazo de seis meses, renova-se a parceria mas agora com seu oferecimento sendo pago, com os valores exatos aos que estão especificados na página inicial deste produto.</p>
				
				<p class="description">Todas as vantagens e ferramentas descritas na página inicial do Negócio Presente poderão ser utilizadas pela EESC jr. em caráter total, sendo o uso dos futuros aplicativos móveis uma extensão já natural a esta proposta quando publicados em suas devidas lojas.</p>
				
				<p class="description">Caso tenham alguma dúvida, entrem em contato através do email oficial do Estúdio Trilha (<a href="mailto:contato@estudiotrilha.com.br">contato@estudiotrilha.com.br</a>).
				
				<p class="signature">Grato,<br>Pedro Góes<br><span>C.E.O.</span></p>
				
				
				
			</div>
			
		</article>
				
		<div id="wrapper" class="specialWrapper">
			<p>&reg;<a target="_blank" href="http://estudiotrilha.com.br">Estúdio Trilha 2013</a> &nbsp;&nbsp;&nbsp; Todos os direitos reservados</p>
		</div>
	</div>
	
</body>
</html>