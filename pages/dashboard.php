<?php
   session_start();
   if(!empty($_SESSION['id'])){
   	echo "Olá ".$_SESSION['nome'].", Bem vindo <br>";
   	echo "<a href='sair.php'>Sair</a>";
   }else{
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
      <title> Painel de Controle</title>
      <!-- Bootstrap core CSS -->
      <link href="../bootstrap-4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="../bootstrap-4.1.3/site/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
   </head>
   <body>
      <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow ">
         <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="http://localhost/Lavanderia_Delucas/pages/dashboard.php">Lavanderia Delucas</a>         
         <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
               <a class="nav-link" href="http://localhost/Lavanderia_Delucas/pages/login.php">Sair</a>
            </li>
         </ul>
      </nav>
      <div class="container-fluid">
         <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
               <div class="sidebar-sticky">
                  <ul class="nav flex-column">
                     <li class="nav-item">
                        <a class="nav-link active" href="#">
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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
               <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">Painel de Controle</h1>
                  <?php echo "Olá ".$_SESSION['nome'].", Bem-Vindo! <br>" ?> <!-- BOAS VINDAS AO USUÁRIO LOGADO. -->
                  <div class="btn-toolbar mb-2 mb-md-0">
                     <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Compartilhar</button>
                        <button class="btn btn-sm btn-outline-secondary">Exportar</button>
                     </div>
                     <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                     <span data-feather="calendar"></span>
                     Essa Semana
                     </button>
                  </div>
               </div>

                <?php
                
                include_once("navbar.php");

                ?>

               <!-- Tag abaixo é a criação do gráfico -->
               <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
               <?php 
                  include('conexao.php'); 
                  
                  $arrayRec = dadosGraficoRecebidos($con);
                  
                  $domingoRec  = implode("",$arrayRec[1]);
                  $segundaRec  = implode("",$arrayRec[2]);
                  $terçaRec    = implode("",$arrayRec[3]);
                  $quartaRec   = implode("",$arrayRec[4]);
                  $quintaRec   = implode("",$arrayRec[5]);
                  $sextaRec    = implode("",$arrayRec[6]);
                  $sabadoRec   = implode("",$arrayRec[7]);
                  
                  $arrayEnt = dadosGraficoEntrega($con);
                  
                  $domingoEnt  = implode("",$arrayEnt[1]);
                  $segundaEnt  = implode("",$arrayEnt[2]);
                  $terçaEnt    = implode("",$arrayEnt[3]);
                  $quartaEnt   = implode("",$arrayEnt[4]);
                  $quintaEnt   = implode("",$arrayEnt[5]);
                  $sextaEnt    = implode("",$arrayEnt[6]);
                  $sabadoEnt   = implode("",$arrayEnt[7]);
                  
                  ?>
        
            </main>
         </div>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="../bootstrap-4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
      <script src="../bootstrap-4.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Icons -->
      <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
      <script>
         feather.replace()
      </script>
      <!-- Graphs -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
      <script>
         var ctx = document.getElementById("myChart");
         
         var myChart = new Chart(ctx, {
             type: 'line',
             data: {
                 labels: ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"],
                 datasets: [{
                     label: 'Recebidos no dia',
                     data: [<?php echo($domingoRec)?>, <?php echo($segundaRec)?>, <?php echo($terçaRec)?>, <?php echo($quartaRec)?>, <?php echo($quintaRec)?>, <?php echo($sextaRec)?>, <?php echo($sabadoRec)?>],
                     lineTension: 0,
                     backgroundColor: 'transparent',
                     borderColor: '#007bff',
                     borderWidth: 4,
                     pointBackgroundColor: '#007bff'
                 }, {
                     label: 'Para entregar',
                     data: [<?php echo($domingoEnt)?>, <?php echo($segundaEnt)?>, <?php echo($terçaEnt)?>, <?php echo($quartaEnt)?>, <?php echo($quintaEnt)?>, <?php echo($sextaEnt)?>, <?php echo($sabadoEnt)?>],
                     lineTension: 0,
                     backgroundColor: 'transparent',
                     borderColor: '#3CB371',
                     borderWidth: 8,
                     pointBackgroundColor: '#007bff'
                 }],
             },
         
             options: {
                 scales: {
                     yAxes: [{
                         ticks: {
                             beginAtZero: false
                         }
                     }]
                 },
                 legend: {
                     display: true,
                     text: 'test',
                 }
             }
         });
         
      </script>
   </body>
</html>