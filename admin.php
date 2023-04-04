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

	
	.sucesso{
		width: 100%;
		margin:10px 0;
		padding: 8px 15px;
		color: #3c763d;
		background: #dff0d8;
	}

	section.agendamentos{
		padding: 30px 0;

	}

	.box-single-horario{
		float: left;
		width: 33.3%;
	
		padding: 10px;
	}
	.box-single-wraper{
		padding: 10px;
		background: white;
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
				<li><a href="">Reservas Atuais</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="agendamentos">
		<div class="center">

			<?php
				if(isset($_GET['excluir'])){
					$id = (int)$_GET['excluir'];
					$pdo->exec("DELETE FROM `tb_agendados` WHERE id = $id");
					echo '<div class="sucesso">O agendamento foi deletado com sucesso!</div>';
				}
				$info = $pdo->prepare("SELECT * FROM `tb_agendados`");
				$info->execute();
				$info = $info->fetchAll();
				foreach ($info as $key => $value) {
			?>
			<div class="box-single-horario">
				<div class="box-single-wraper">
					Nome: <?php echo $value['nome'] ?><br />
					Data e Horário: <?php echo date('d/m/Y H:i:s',strtotime($value['horario'])); ?>
					<br />
					<a href="?excluir=<?php echo $value['id']; ?>">Excluir!</a>
				</div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</section>

	
		</div>
	</section>
</body>
</html>