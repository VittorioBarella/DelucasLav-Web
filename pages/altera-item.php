<?php

    session_start();

    include_once("conexao.php");

    $idItem = filter_input(INPUT_POST, 'idItem', FILTER_SANITIZE_STRING);
    $item = filter_input(INPUT_POST, 'item-edicao', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco-edicao', FILTER_SANITIZE_STRING);

    $result_cliente = "UPDATE Item SET item = '$item', preco='$preco' WHERE idItem = '$idItem'";
    
    $resultado_cliente = mysqli_query($con, $result_cliente);

    if(mysqli_affected_rows($con)){
        $_SESSION['msg'] = "<p style='color:green;'>Item alterado com sucesso</p>";
        header("Location: tabela-precos.php");
    }

?>