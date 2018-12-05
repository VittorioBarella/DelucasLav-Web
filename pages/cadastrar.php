<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$erro = false;
	
	$dados_st = array_map('strip_tags', $dados_rc);
	$dados = array_map('trim', $dados_st);
	
	if(in_array('',$dados)){
		$erro = true;
		$_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos!</div>";
	}elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "<div class='alert alert-danger'>A senha deve ter no minímo 6 caracteres!</div>";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "<div class='alert alert-danger'>Caracter ( ' ) utilizado na senha é inválido!</div>";
	}else{
		$result_usuario = "SELECT id FROM usuarios WHERE usuario='". $dados['usuario'] ."'";
		$resultado_usuario = mysqli_query($con, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger'>Este usuário já está sendo utilizado!</div>";
		}
		
		$result_usuario = "SELECT id FROM usuarios WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($con, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger'>Este e-mail já está cadastrado!</div>";
		}
	}
	
	
	//var_dump($dados);
	if(!$erro){
		//var_dump($dados);
		$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
		
		$result_usuario = "INSERT INTO usuarios (nome, email, usuario, senha) VALUES (
						'" .$dados['nome']. "',
						'" .$dados['email']. "',
						'" .$dados['usuario']. "',
						'" .$dados['senha']. "'
						)";
		$resultado_usario = mysqli_query($con, $result_usuario);
		if(mysqli_insert_id($con)){
			$_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
			header("Location: dashboard.php");
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o usuário!</div>";
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Sistema para Lavanderia Delucas">
      <meta name="author" content=" Luciano Junior e Vittório Barella">
      <title> Cadastro de Funcionários</title>
      <!-- IMPORTANDO FONTAWESOME -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="../bootstrap-4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="../bootstrap-4.1.3/site/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
      <!-- Estilo Próprio -->
      <link href="../css/style.css" rel="stylesheet">

      <script type="text/javascript" src="../js/funcoes.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>

   </head>
   <body>
      <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
         <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Lavanderia Delucas</a>      
         <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
               <a class="nav-link" href="login.php">Sair</a>
            </li>
         </ul>
      </nav>
      <div class="container">
      <div class="row alinhaCampos">
         <!-- INÍCIO MENU LATERAL -->
         <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
               <ul class="nav flex-column">
                  <li class="nav-item">
                     <a class="nav-link " href="dashboard.php">
                     <span data-feather="home"></span>
                     Painel de Controle <span class="sr-only">(current)</span>
                     </a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link active" href="cadastrar.php">
                        <span data-feather="users"></span>
                        Cadastro de Funcionários
                        </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="clientes.php">
                     <span data-feather="users"></span>
                    Cadastro de Clientes
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="lista-clientes.php">
                     <span data-feather="users"></span>
                     Lista de Clientes
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">
                     <span data-feather="file"></span>
                     Ordens de Serviço
                     </a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="higienizacoes.php">
                        <span data-feather="shopping-cart"></span>
                        Higienizações
                        </a>
                     </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">
                     <span data-feather="shopping-cart"></span>
                     Produtos
                     </a>
                  </li>
               </ul>
            </div>
         </nav>
         <!-- FIM MENU LATERAL -->
		 <div class="container">
			<div class="form-signin" >
				<h2>Cadastrar Usuário</h2>
			
				<form method="POST" action="">
					
					<input type="text" name="nome" placeholder="Digite seu nome" class="form-control"><br>
					
					
					<input type="text" name="email" placeholder="Digite o seu e-mail" class="form-control"><br>
					
					
					<input type="text" name="usuario" placeholder="Digite o usuário" class="form-control"><br>
					
					
					<input type="password" name="senha" placeholder="Digite a senha" class="form-control"><br>
					
					<input type="submit" name="btnCadUsuario" value="Cadastrar" class="btn btn-success btn-cadastrar"><br><br>
					
					<input class="btn btn-primary btn-LimpaCampos" type="reset" value="Limpar Campos">

				</form>
				
					<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
				?>
			</div>
		</div>
     
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		 <script src="../js/bootstrap.min.js"></script>	
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
         <script src="../bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
         <script src="../bootstrap-4.1.3/dist/js/bootstrap.bundle.min.js"></script>
         <!-- Icons -->
         <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
         <script>
            feather.replace()
         </script>
         </div>
         </div>
      </div>
   </body>
</html>