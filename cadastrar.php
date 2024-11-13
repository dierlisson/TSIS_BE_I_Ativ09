<?php
include_once 'header.php';
require_once 'sessao.php';
require_once 'dbProdutos.php';

$erro = "";

if (isset($_POST['btn-cadastrar'])) {
    $descricao = $_POST['txtdescricao'];
    $data = $_POST['txtdata'];
    $preco = $_POST['txtpreco'];
    $validade = $_POST['txtvalidade'];

    if (!filter_var($preco, FILTER_VALIDATE_FLOAT)) {
        $erro = "O preço inserido é inválido. Insira um número válido.";
    } elseif (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $data)) {
        $erro = "A data de inclusão é inválida. Use o formato DD/MM/AAAA.";
    } elseif (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $validade)) {
        $erro = "A data de validade é inválida. Use o formato DD/MM/AAAA.";
    } else {
        $sql = "INSERT INTO produtos (descricao, data, preco, validade) VALUES ('$descricao', '$data', '$preco', '$validade')";
        if (!mysqli_query($connect, $sql)) {
            $erro = "Erro ao cadastrar o produto: " . mysqli_error($connect);
        }
    }
}

?>

<div class="row mt-4">
    <div class="col-8 container my-2">
        <fieldset class="border p-2">
            <legend class="control-label">Cadastrar produto</legend>
            <form action="" method="POST">
                <div class="row mx-3 g-2">
                    <div class="col-3">
                        <label for="produto" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="txtdescricao" required>
                    </div>
                    <div class="col-2">
                        <label for="dataInclusao" class="form-label">Data Inclusão</label>
                        <input type="text" class="form-control" id="data" name="txtdata" placeholder="DD/MM/AAAA" required>
                    </div>

                    <div class="col-2">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" name="txtpreco" min="1" max="120" step="0.01" required>
                    </div>
                    <div class="col-2">
                        <label for="dataValidade" class="form-label">Validade</label>
                        <input type="text" class="form-control" id="validade" name="txtvalidade" placeholder="DD/MM/AAAA" required>
                    </div>
                </div>
                <div class="row mx-3 my-3 g-2">
                    <div class="col-2">
                        <button type="submit" name="btn-cadastrar" class="btn btn-primary">Cadastrar</button>
                    </div>
                    <div class="col-3">
                        <a href="consultar.php" onclick="" name="btn-voltar" class="btn btn-secondary">Voltar à Consulta</a>
                    </div>
                </div>
            </form>

             <!-- Mensagem de erro, se houver -->
            <?php if ($erro){ ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php } ?>
        </fieldset>
    </div>
