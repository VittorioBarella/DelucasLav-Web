<?php

    session_start();

    include_once("conexao.php");

    $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
    
    $result_itens = "INSERT INTO item_higienizacao (item, preco) VALUES ('$item', '$preco')";

    $resultado_itens = mysqli_query($con, $result_itens);

    if(mysqli_insert_id($con)){

       	$_SESSION['msg'] = "<p style='color:green;'>Item cadastrado com sucesso</p>";
          header("Location: tabela-precos.php");
          
    }

?>