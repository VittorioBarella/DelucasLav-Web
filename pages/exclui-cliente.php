<?php

    session_start();

    include_once("conexao.php");

    $idCliente = filter_input(INPUT_POST, 'idCliente-exclusao', FILTER_SANITIZE_STRING);
    
    $result_cliente = "DELETE FROM Cliente WHERE idCliente = '$idCliente'";

    echo($result_cliente);

    $resultado_cliente = mysqli_query($con, $result_cliente);

    if(mysqli_affected_rows($con)){
            $_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso</p>";
            header("Location: lista-clientes.php");
    }

?>