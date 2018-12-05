<?php

    session_start();

    include_once("conexao.php");

    $idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);
    $nomeCliente = filter_input(INPUT_POST, 'nome-edicao', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone-edicao', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco-edicao', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email-edicao', FILTER_SANITIZE_STRING);

    $result_cliente = "UPDATE Cliente SET nomeCliente = '$nomeCliente', telefone='$telefone', endereco='$endereco', email='$email' WHERE idCliente = '$idCliente'";
    
    $resultado_cliente = mysqli_query($con, $result_cliente);

    if(mysqli_affected_rows($con)){
        $_SESSION['msg'] = "<p style='color:green;'>Cliente Alterado com Sucesso !!! </p>";
        header("Location: lista-clientes.php");
    }

?>