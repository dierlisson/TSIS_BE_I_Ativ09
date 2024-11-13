<?php
require_once 'dbProdutos.php';

if (isset($_GET['idproduto'])) {
    $idproduto = filter_input(INPUT_GET, 'idproduto', FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM produtos WHERE idproduto = $idproduto";

    if (mysqli_query($connect, $sql)) {
        header('Location: consultar.php?excluir=ok');
        exit;
    } else {
        header('Location: consultar.php?excluir=erro');
        exit;
    }
}
