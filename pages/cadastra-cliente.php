<?php

    session_start();

    include_once("conexao.php");

    $nomeCliente = filter_input(INPUT_POST, 'nomeCliente', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    $result_cliente = "INSERT INTO Cliente (nomeCliente, telefone, endereco, email) VALUES ('$nomeCliente', '$telefone', '$endereco', '$email')";

    $resultado_cliente = mysqli_query($con, $result_cliente);

    if(mysqli_insert_id($con)){

       	$_SESSION['msg'] = "<p style='color:green;'>Cliente cadastrado com sucesso</p>";
          header("Location: lista-clientes.php");
          
    }

?>