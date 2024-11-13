<?php
require_once 'dbProdutos.php';

if (isset($_POST['btn-atualizar'])) {

    $idproduto = filter_input(INPUT_POST, 'idproduto', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $validade = filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_STRING);

    $sql = "UPDATE produtos SET descricao = '$descricao', data = '$data', preco = '$preco', validade = '$validade' WHERE idproduto = $idproduto";

    if (mysqli_query($connect, $sql)) {
        header('Location: consultar.php?atualizar=ok');
        exit;
    } else {
        header('Location: consultar.php?atualizar=erro');
        exit;
    }
}
