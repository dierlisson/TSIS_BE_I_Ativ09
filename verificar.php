<?php
require_once 'dbProdutos.php';

if (isset($_GET['descricao']) && !empty($_GET['descricao'])) {
    $descricao = $_GET['descricao'];
    $descricao = mysqli_real_escape_string($connect, $descricao); 

    $sql = "SELECT idproduto, descricao, data, preco, validade FROM produtos WHERE descricao LIKE '%$descricao%'";
    $resultado = mysqli_query($connect, $sql);

    $produto = null;
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $produto = mysqli_fetch_assoc($resultado);
    }

   
    if ($produto) {
        echo "<div class='alert alert-info'>";
        echo "<h4>Produto encontrado:</h4><br>";
        echo "<b>Código:</b> " . $produto['idproduto'] . "<br>";
        echo "<b>Descrição:</b> " . $produto['descricao'] . "<br>";
        echo "<b>Data Inclusão:</b> " . $produto['data'] . "<br>";
        echo "<b>Preço:</b> " . $produto['preco'] . "<br>";
        echo "<b>Validade:</b> " . $produto['validade'] . "<br>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>Nenhum produto encontrado com a descrição informada.</div>";
    }
}
?>