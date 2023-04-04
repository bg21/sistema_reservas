<?php
	date_default_timezone_set('America/Sao_Paulo');
	$pdo = new PDO('mysql:host=localhost;dbname=sistema','root','');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Reserva</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Lato";
	}

	body{
		background: rgb(225,225,225);
	}

	header{
		padding: 10px 0;
		background: #333;
		color: white;
	}

	nav.menu ul{
		list-style-type: none;
	}

	nav.menu li{
		display: inline-block;
		padding: 0 8px;
	}

	nav.menu a{
		color: white;
		text-decoration: none;
	}
	.logo{
		float: left;
	}

	.clear{clear: both;}

	nav.menu{
		position: relative;
		top:4px;
		float: right;
	}

	.center{
		max-width: 1100px;
		margin: 0 auto;
		padding: 0 2%;
	}

	section.reserva{
		padding: 40px 0;
		text-align: center;
	}

	section.reserva select{
		width: 100%;
		height: 30px;
		border: 1px solid #ccc;
	}

	section.reserva input[type=text]{
		width: 100%;
		height: 30px;
		padding-left: 7px;
		margin-bottom: 10px;
	}

	section.reserva input[type=submit]{
		background: #4286f4;
		width: 200px;
		height: 30px;
		border: 0;
		cursor: pointer;
		color: white;
		font-size: 19px;
		font-weight: bold;
		margin-top: 10px;
	}

	.sucesso{
		width: 100%;
		margin:10px 0;
		padding: 8px 15px;
		color: #3c763d;
		background: #dff0d8;
	}
</style>
<body>
	<header>
		<div class="center">
		<div class="logo">
			<h2>Danki Code</h2>
		</div>

		<nav class="menu">
			<ul>
				<li><a href="">Reservas</a></li>
				<li><a href="">Sobre</a></li>
				<li><a href="">Contato</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="reserva">
		<div class="center">
			<?php
				if(isset($_POST['acao'])){
					//Quero fazer uma reserva!
					$nome = $_POST['nome'];
					$dataHora = $_POST['dataHora'];
					$date = DateTime::createFromFormat('d/m/Y H:i:s', $dataHora);
					$dataHora =  $date->format('Y-m-d H:i:s');
					$sql = $pdo->prepare("INSERT INTO `tb_agendados` VALUES (null,?,?)");
					$sql->execute(array($nome,$dataHora));
					echo '<div class="sucesso">Seu horário foi agendado com sucesso!</div>';
				}
			?>
			<form method="post">
				<input type="text" name="nome" placeholder="Seu nome...">
				<select name="dataHora">
					<?php
						for($i = 0; $i <= 23; $i++){
							$hora = $i;
							if($i < 10){
								$hora = '0'.$hora;
							}

							$hora.=':00:00';

							$verifica = date('Y-m-d').' '.$hora;
							$sql = $pdo->prepare("SELECT * FROM `tb_agendados` WHERE horario = '$verifica'");
							$sql->execute();

							if($sql->rowCount() == 0 && strtotime($verifica) > time()){
								$dataHora = date('d/m/Y').' '.$hora;
								echo '<option value="'.$dataHora.'">'.$dataHora.'</option>';
							}
						}
					?>


				</select>
				<input type="submit" name="acao" value="Enviar!">
			</form>
		</div>
	</section>
</body>
</html>