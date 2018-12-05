<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="../images/logo(pq).png">
		<title>Lavanderia Delucas - Login</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="form-signin" style="background: #148543;">
				<h2 class="text-center" style="color: #FFFFFF;">Bem-Vindo !</h2>
				
				<form method="POST" action="valida.php">
					
					<input type="text" name="usuario" placeholder="Digite o seu usuário" class="form-control"><br>
					
					<input type="password" name="senha" placeholder="Digite a sua senha" class="form-control"><br>
					
					<input type="submit" name="btnLogin" value="Entrar" class="btn btn-success btn-block btnLogin">		
					<br>
					<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
					if(isset($_SESSION['msgcad'])){
						echo $_SESSION['msgcad'];
						unset($_SESSION['msgcad']);
					}
					?>
				</form>
			</div>
		</div>			
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>