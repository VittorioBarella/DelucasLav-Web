<script type="text/javascript" src="../js/funcoes.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php
   $servidor = "localhost";
   $usuario = "root";
   $senha = "";
   $dbname = "lavanderia_delucas";
   
   //Criar a conexao
   $con = mysqli_connect($servidor, $usuario, $senha, $dbname);
   
   function fecharBD($con){ 
   
   	mysqli_close($con); //Método que faz o fechamento da conexão
   
   }
   
   function dashboard($con){ //Método que faz a manipulação do banco
   
   	$sql = sprintf("SELECT c.nomeCliente, o.dataRecebimento, o.dataEntrega, o.precoTotal, o.status 
   	FROM ordem_servico o 
   	JOIN Cliente c USING (idCliente)"); //Query com o SELECT com Join puxando os dados das duas tabelas ordem_servico e cliente
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$array = mysqli_fetch_assoc($data);
   
   	$total = mysqli_num_rows($data);
   
   	?>
<hr>
<!-- Abaixo a criação e manipulação da tabela. -->
<table class="table table-striped table-sm lista-clientes">
   <thead>
      <tr>
         <th>Nome do Cliente</th>
         <th>Data de Recebimento</th>
         <th>Data de Entrega</th>
         <th>Valor Total</th>
         <th>Status</th>
      </tr>
   </thead>
   <?php if($total > 0){
      do{
      
      ?>
   <tr>
      <td> <?= $array['nomeCliente']?> </td>
      <td> <?= $array['dataRecebimento']?> </td>
      <td> <?= $array['dataEntrega']?> </td>
      <td> <?= $array['precoTotal']?> </td>
      <td> <?= $array['status']?> </td>
   </tr>
   <?php
      } while ($array = mysqli_fetch_assoc($data)); 
      
      fecharBD($con);
      
      ?> 
</table>
<?php
      }
   
   }
   
   function clientes($con){
   
   $sql = sprintf("SELECT * FROM Cliente");
   
   $data = mysqli_query($con, $sql) or die(mysql_error());
   
   $array = mysqli_fetch_assoc($data);
   
   $total = mysqli_num_rows($data);
   
   ?>
<!-- Abaixo a criação e manipulação da tabela. -->
<table class="table table-stripe lista-clientes" id="listaDeClientes">
   <thead>
      <tr value="clientes"  class="checkgroup" >
         <th>Selecionar Cliente</th>
         <th>ID</th>
         <th>Nome</th>
         <th>Telefone</th>
         <th>Endereço</th>
         <th>E-mail</th>
         <th scope="col">Editar</th>
         <th scope="col">Excluir</th>
      </tr>
   </thead>
   <?php if($total > 0){
      do{
      
      ?>
   <tbody>
      <tr>
         <script>
            $(function(){
               $('input.checkgroup').click(function(){
                  				if($(this).is(":checked")){
            			 $('input.checkgroup').attr('disabled',true);
            			 $('button.editar<?= $array['idCliente']?>').attr('disabled',true);
            			 $('button.excluir<?= $array['idCliente'] ?>').attr('disabled',true);
                     				 $(this).removeAttr('disabled');
                  				}else{
            			
            			 $('input.checkgroup').removeAttr('disable',true);
            			 $('button.editar<?= $array['idCliente']?>').attr('disabled',true);
            			 $('button.excluir<?= $array['idCliente'] ?>').attr('disabled',true);
                  				}
               				})
            			})
            
         </script>
         <th scope="row" class="selecionaClientes "><input type="checkbox" onclick="selecionaCheckbox()" class="checkgroup" id="<?= $array['idCliente'] ?>"/></th>
         <td data-id="<?= $array['idCliente']?>"> <?= $array['idCliente']?></td>
         <td data-nome="<?= $array['nomeCliente']?>"> <?= $array['nomeCliente']?> </td>
         <td data-telefone="<?= $array['telefone']?>"> <?= $array['telefone']?> </td>
         <td data-endereco="<?= $array['endereco']?>"> <?= $array['endereco']?> </td>
         <td data-email="<?= $array['email']?>"> <?= $array['email']?> </td>
         <td><button type="button" onclick="editarCliente()" class="btn btn-success editar<?= $array['idCliente']?>" data-toggle="modal" data-target="#editarCliente" title="Editar Cliente"><i class="fa fa-pencil"></i></button></td>
         <td><button onclick="excluirCliente()" class="btn btn btn-danger excluir<?= $array['idCliente']?>" data-toggle="modal" data-target="#excluirCliente" title="Excluir Cliente"><i class="fa fa-trash"></i></button></td>
      </tr>
      <script>
         function editarCliente(){
         
               $(function(){
                     $(document).on('click', '.btn-success', function(e) {
                           e.preventDefault;
                           
                           var idCliente = $(this).closest('tr').find('td[data-id]').data('id');
                           var nomeCliente = $(this).closest('tr').find('td[data-nome]').data('nome');
                           var telefone = $(this).closest('tr').find('td[data-telefone]').data('telefone');
                           var endereco = $(this).closest('tr').find('td[data-endereco]').data('endereco');
                           var email = $(this).closest('tr').find('td[data-email]').data('email');
                           
                           document.getElementById('idCliente').value = idCliente;
                           document.getElementById('nome-edicao').value = nomeCliente;
                           document.getElementById('telefone-edicao').value = telefone;
                           document.getElementById('endereco-edicao').value = endereco;
                           document.getElementById('email-edicao').value = email;
                           
                     });
               });
         
         }
         
         function excluirCliente(){
         
               $(function(){
                     $(document).on('click', '.btn-danger', function(e) {
                           e.preventDefault;
                           
                           var idCliente = $(this).closest('tr').find('td[data-id]').data('id');
                           var nomeCliente = $(this).closest('tr').find('td[data-nome]').data('nome');
                           
                           document.getElementById('idCliente-exclusao').value = idCliente;
                           document.getElementById('nome-mensagem').value = nomeCliente;
         
                     });
               });
         
         }
         
      </script>
      <?php
         } while ($array = mysqli_fetch_assoc($data)); 
         
         fecharBD($con);
         
         ?> 
   </tbody>
</table>
<?php
   }
   
   }
   
   function precos($con){
   
      $sql = sprintf("SELECT * FROM item_higienizacao");
      
      $data = mysqli_query($con, $sql) or die(mysql_error());
      
      $array = mysqli_fetch_assoc($data);
      
      $total = mysqli_num_rows($data);
      
      ?>
   <!-- Abaixo a criação e manipulação da tabela. -->
   <table class="table table-stripe lista-itens" id="listaDeItens">
      <thead>
         <tr value="itens"  class="checkgroup" >
            <th>Selecionar Item</th>
            <th>ID</th>
            <th>Item</th>
            <th>Preço</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
         </tr>
      </thead>
      <?php if($total > 0){
         do{
         
         ?>
         <tbody>
   
      <tr>
         <script>
            $(function(){
                                       $('input.checkgroup').click(function(){
                                          if($(this).is(":checked")){
                               $('input.checkgroup').attr('disabled',true);
                               $('button.editar<?= $array['idItem']?>').attr('disabled',true);
                               $('button.excluir<?= $array['idItem'] ?>').attr('disabled',true);
                                              $(this).removeAttr('disabled');
                                          }else{
                              
                               $('input.checkgroup').removeAttr('disabled');
                               $('button.editar<?= $array['idItem']?>').removeAttr('disabled');
                               $('button.excluir<?= $array['idItem'] ?>').removeAttr('disabled');
                                          }
                                       })
                              })
            
         </script>
         <th scope="row" class="selecionaItens "><input type="checkbox" class="checkgroup" id="<?= $array['idItem'] ?>"/></th>
         <td data-id="<?= $array['idItem']?>"> <?= $array['idItem']?></td>
         <td data-item="<?= $array['item']?>"> <?= $array['item']?> </td>
         <td data-preco="<?= $array['preco']?>"> <?= $array['preco']?> </td>
         
         <td><button type="button" onclick="editarItem()" class="btn btn-success editar<?= $array['idItem']?>" data-toggle="modal" data-target="#editarItem" title="Editar Item" onclick="selecionaCheckbox()"><i class="fa fa-pencil"></i></button></td>
         <td><button onclick="excluirItem()" class="btn btn btn-danger excluir<?= $array['idItem']?>" data-toggle="modal" data-target="#excluirItem" title="Excluir Item"><i class="fa fa-trash"></i></button></td>
      </tr>
   
         <script>
         
               function editarItem(){
   
                     $(function(){
                           $(document).on('click', '.btn-success', function(e) {
                                 e.preventDefault;
                                 
                                 var idItem = $(this).closest('tr').find('td[data-id]').data('id');
                                 var item = $(this).closest('tr').find('td[data-item]').data('item');
                                 var preco = $(this).closest('tr').find('td[data-preco]').data('preco');
                                 
                                 document.getElementById('idItem').value = idItem;
                                 document.getElementById('item-edicao').value = item;
                                 document.getElemenstById('preco-edicao').value = preco;
                                 
                           });
                     });
   
               }
   
               function excluirItem(){
   
                     $(function(){
                           $(document).on('click', '.btn-danger', function(e) {
                                 e.preventDefault;
                                 
                                 var idItem = $(this).closest('tr').find('td[data-id]').data('id');
                                 var item = $(this).closest('tr').find('td[data-item]').data('item');
                                 
                                 document.getElementById('idItem-exclusao').value = idItem;
                                 document.getElementById('item-mensagem').value = preco;
   
                           });
                     });
   
               }
   
         </script>
   
      <?php
         } while ($array = mysqli_fetch_assoc($data)); 
         
            fecharBD($con);
         
         ?> 
    </tbody>
   </table>
   <?php
      }
      
      }

   function dadosGraficoRecebidos($con){
   
   $sql = sprintf("SELECT DAYOFWEEK(NOW()) dia");
   
   $data = mysqli_query($con, $sql) or die(mysql_error());
   
   $array = mysqli_fetch_assoc($data);
   
   //Contabiliza todos os registros - SELECT COUNT(*) FROM ordem_servico WHERE dataRecebimento BETWEEN NOW() AND CURRENT_DATE+6;
   //Contabiliza registro no dia - SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE
   
   $dia = $array['dia'];
   
   $arrayGrafico[] = "";
   
   if($dia == 1){
   
   $cont = 0;
   
   for($cont; $cont < 6; $cont++){
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 2){
   
   $cont = 1;
   
   for($cont; $cont >= 0; $cont--){ //Domingo, Segunda
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 5; $cont++){ //Terça a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 3){
   
   $cont = 2;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a terça
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 4; $cont++){ //Quarta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 4){
   
   $cont = 3;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a quarta
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 3; $cont++){ //Quinta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 5){
   
   $cont = 3;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a quinta
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 3; $cont++){ //Sexta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 6){
   
   $cont = 4;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a Sexta
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 2; $cont++){ //Sábado
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif($dia == 7){
   
   $cont = 6;
   
   for($cont; $cont > 0; $cont--){
   
   	$sql = sprintf("SELECT COUNT(*) recebidos FROM ordem_servico WHERE dataRecebimento = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   }
   
   unset($arrayGrafico[0]);
   
   return $arrayGrafico;
   
   }
   
   function dadosGraficoEntrega($con){
   
   $sql = sprintf("SELECT DAYOFWEEK(NOW()) dia");
   
   $data = mysqli_query($con, $sql) or die(mysql_error());
   
   $array = mysqli_fetch_assoc($data);
   
   $dia = $array['dia'];
   
   $arrayGrafico[] = "";
   
   if($dia == 1){
   
   $cont = 0;
   
   for($cont; $cont < 6; $cont++){
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 2){
   
   $cont = 1;
   
   for($cont; $cont >= 0; $cont--){ //Domingo, Segunda
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 5; $cont++){ //Terça a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 3){
   
   $cont = 2;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a terça
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 4; $cont++){ //Quarta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 4){
   
   $cont = 3;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a quarta
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 3; $cont++){ //Quinta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 5){
   
   $cont = 3;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a quinta
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 3; $cont++){ //Sexta a Sábado
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif ($dia == 6){
   
   $cont = 4;
   
   for($cont; $cont >= 0; $cont--){ //Domingo a Sexta
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   $cont = 1;
   
   for($cont; $cont <= 2; $cont++){ //Sábado
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE+".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   } elseif($dia == 7){
   
   $cont = 6;
   
   for($cont; $cont > 0; $cont--){
   
   	$sql = sprintf("SELECT COUNT(*) entrega FROM ordem_servico WHERE dataEntrega = CURRENT_DATE-".$cont);
   
   	$data = mysqli_query($con, $sql) or die(mysql_error());
   
   	$quantRegistros = mysqli_fetch_assoc($data);
   
   	array_push($arrayGrafico, $quantRegistros);
   
   }
   
   }
   
   unset($arrayGrafico[0]);
   
   return $arrayGrafico;
   
   }
   
   ?>