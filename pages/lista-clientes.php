<?php
session_start();
include_once("conexao.php");
if (!empty($_SESSION['id'])) {
      echo "Olá " . $_SESSION['nome'] . ", Bem vindo <br>";
      echo "<a href='sair.php'>Sair</a>";
} else {
      $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
      header("Location: login.php");
}
?>
<!doctype html>
<html lang="br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Sistema para Lavanderia Delucas">
      <meta name="author" content=" Luciano Junior e Vittório Barella">
      <title> Lista de Clientes</title>
      <!-- IMPORTANDO FONTAWESOME -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="../bootstrap-4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="../bootstrap-4.1.3/site/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
      <!-- Estilo Próprio -->
      <link href="../css/style.css" rel="stylesheet">

      <script
      src="https://code.jquery.com/jquery-3.3.1.slim.js"
      integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
      crossorigin="anonymous"></script>

      <script type="text/javascript" src="../js/funcoes.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script type="text/javascript" src="../js/jquery.quick.search.js"></script>
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>


   </head>
   <body>
      <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
         <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Lavanderia Delucas</a>
         <input class="form-control form-control-dark w-100 input-search" type="text" alt="lista-clientes" placeholder="Buscar" aria-label="Buscar" onclick="buscar()">
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
                  <a class="nav-link" href="cadastrar.php">
                  <span data-feather="users"></span>
                  Cadastro de Funcionários
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="clientes.php">
                  <span data-feather="users"></span>
                  Cadastro de Clientes
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link  active" href="lista-clientes.php">
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
      
      <!-- INÍCIO DA TABELA PARA LISTAR CLIENTES -->
      <div class="container-fluid tabelaClientes lista-clientes">
      <h2>Tabela de Clientes</h2>
      <div class="table-responsive">
         <?php
            include_once("conexao.php");

            clientes($con); //Método criado no arquivo conexao.php para manipulação da tabela

            ?>
      </div>
      <!-- FIM DA TABELA PARA LISTAR CLIENTES -->
      <?php
                  if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                  }
                  ?>
      </div>
      <!-- INÍCIO MODAL PARA EDITAR CLIENTE -->
      <div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title " id="Heading">Edite o Cliente</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">

                 

                  <form method="POST" action="altera-cliente.php">
                  
                        <input type="hidden" id="idCliente" name="idCliente">

                        <div class="form-group">
                        <input class="form-control" type="text" placeholder="Nome" id="nome-edicao" name="nome-edicao">
                        </div>
                        <div class="form-group">
                        <input class="form-control" type="text" placeholder="Telefone" id="telefone-edicao" name="telefone-edicao">
                        </div>
                        <div class="form-group">
                        <input class="form-control" type="text" placeholder="Endereço" id="endereco-edicao" name="endereco-edicao">
                        </div>
                        <div class="form-group">
                        <input class="form-control" type="text" placeholder="Email" id="email-edicao" name="email-edicao">
                        </div>
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-warning btn-lg" style="width: 100%;" value="Atualizar"><span class="glyphicon glyphicon-ok-sign" value="Editar"></span>
                        </div>
               </form>

            </div>
         </div>
      </div>
      <!-- FIM MODAL PARA EDITAR CLIENTE -->
      <!-- INÍCIO MODAL PARA EXCLUIR O CLIENTE -->
      <div class="modal fade" id="excluirCliente" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="Heading">Excluir Cliente</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Você tem certeza que deseja Excluir <div name="nome-mensagem" id="nome-mensagem"></div> ?</div>
               </div>
               <div class="modal-footer">

            <form method="POST" action="exclui-cliente.php">

                  <input type="hidden" id="idCliente-exclusao" name="idCliente-exclusao">

                  <input type="submit" class="btn btn-success" value="Sim"><span class="glyphicon glyphicon-ok-sign"></span>
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Não </button>

            </form>

               </div>
            </div>
         </div>
      </div>
      <!-- FIM MODAL PARA EXCLUIR O CLIENTE -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="../bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
      <script src="../bootstrap-4.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Icons -->
      <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
      <script>
         feather.replace()
      </script>
