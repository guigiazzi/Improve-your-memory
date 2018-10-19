<?php
session_start();
include('verifica_login.php');
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset = "utf-8" author = "Guilherme Giazzi, Matheus Lança e André Vinicius">
	<link rel="stylesheet" type="text/css" href="jogo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <meta name="description" content="Exercite sua memória e previna-se contra o Alzheimer e outras doenças degenerativas">
	<title>Improve your memory - Jogo</title>
</head>

<body class="">
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <!-- Brand -->
                 <a class="navbar-brand" href="painel.php"><img src="img/logo.png"></a>
                 <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <span class="nav-link" href="#">IMPROVE YOUR MEMORY</span>
                    </li> 
                  </ul>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                  
                   <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        
                      <span class="nav-link">Olá, <?php echo $_SESSION['usuario'];?></span>
                    
                      
                    </li> 
                  </ul>
                   <ul class="navbar-nav">
                    <li class="nav-item">
                       
                      <a href="end_session.php" class="nav-link">Sair</a>
                    </li> 
                  </ul>
                </div> 
              </nav>

		<div id="body"></div>
	  <div id="simpleModal" class="modal">
	    <div class="modal-content">
	      <div class="modal-header">
	          <span class="closeBtn">&times;</span>
	          <h2>Essa imagem se refere a:</h2>
	      </div>
	      <div class="modal-body">
			  <form action="">
			      <input type="radio" name="alternative" value="Alternativa_A"><span id="alternativaA"> Alternativa A</span><br>
			      <input type="radio" name="alternative" value="Alternativa_B"><span id="alternativaB"> Alternativa B</span><br>
			      <input type="radio" name="alternative" value="Alternativa_C"><span id="alternativaC"> Alternativa C</span><br>
			      <input type="radio" name="alternative" value="Alternativa_D"><span id="alternativaD"> Alternativa D</span><br>
			    </form>
	      </div>
	      <div class="modal-footer">
	        <input type="button" name="" class="button" value="Confirma resposta" onclick="closeModal()">
	      </div>
	    </div>
	  </div>
 		
 		<div id="divLevel" class="jumbotron text-center Pagination-centered"> 
 			<h1 id="levelSelect" >Selecione um nível: </h1>
 			<br><br>
			<div id="botoes row Pagination-centered">	
	            <button id="facil" class="btn btn-primary col-md-4 col-sm-12" onclick="generateCards('facil')">Facil</button> 
	            <button id="medio" class="btn btn-primary col-md-4 col-sm-12" onclick="generateCards('medio')">Medio</button>
	            <button id="dificil" class="btn btn-primary col-md-4 col-sm-12" onclick="generateCards('dificil')">Dificil</button>
            </div>
 			
 		</div>
	  <div id="BtnInstrucoes" class="jumbotron">
	  		<div class="info">
				<h1>Pontuação</h1>
				<h1 id='pontos'>0</h1>
			</div>

			<div class="info">
				<h1>Nivel</h1>
				<h1 id="nivel"></h1>
			</div>

	  	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Instruções</button>
	  </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Caro <?php echo $_SESSION['usuario'];?></h4>
          
      </div>
      <div class="modal-body">
        <p>Este jogo tem o intuito de manter a memória dos usuários ativa, sejam eles jovens que ainda estão cursando o Ensino Médio, universitários ou idosos, através de um jogo da memória da história da humanidade</p>

		<p>Para começar a jogar, clique em voltar e depois em iniciar. Você deverá selecionar um nível de dificuldade, entre fácil, médio e difícil</p>

		<p>Serão disponibilizadas cartas com imagens de acontecimentos históricos ao longo da humanidade, que estarão viradas para baixo. O número de cartas será definido de acordo com o nível escolhido</p>

		<p>Para selecionar uma carta, basta escolher uma e clicá-la. Você deverá encontrar o par desta carta</p>

		<p>Ao encontrar um par, uma pergunta referente à imagem aparecerá. O objetivo é fazer o maior número de pontos dentro do tempo determinado</p>

	<h2>Entendendo a pontuação:</h2>

		<p>Para cada par encontrado, você ganhará um ponto</p>

		<p>Para cada pergunta referente ao acontecimento respondida corretamente, você ganhará 3 pontos</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
	<script src="jogo.js"></script>
</body>
<footer>
	<hr>
	<p>Jogo desenvolvido por Guilherme Giazzi, Matheus Lança e André Vinicius</p>
</footer>

</html>