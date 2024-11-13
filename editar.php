<?php
include_once 'header.php';
require_once 'dbProdutos.php';

if (isset($_GET['idproduto'])):
    $idproduto = filter_var($_GET['idproduto'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM produtos WHERE idproduto = '$idproduto'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0):
        $dados = mysqli_fetch_array($resultado);
    else:
        echo "<p>Produto não encontrado.</p>";
        exit;
    endif;
else:
    echo "<p>ID do produto não especificado.</p>";
    exit;
endif;
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4 my-5">
        <div class="card p-4 shadow-sm">
            <h1 class="display-5 text-center mb-4">Atualizar Produto</h1>

            <form action="atualizar.php" method="POST">
                <input type="hidden" name="idproduto" value="<?php echo $dados['idproduto']; ?>">

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $dados['descricao']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="data" class="form-label">Data de Inclusão</label>
                    <input type="text" name="data" id="data" class="form-control" placeholder="DD/MM/AAAA" value="<?php echo $dados['data']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01" value="<?php echo $dados['preco']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="validade" class="form-label">Validade</label>
                    <input type="text" name="validade" id="validade" class="form-control" placeholder="DD/MM/AAAA" value="<?php echo $dados['validade']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="btn-atualizar" class="btn btn-primary">Atualizar</button>
                    <a href="consultar.php" class="btn btn-secondary">Voltar para a Lista</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include_once 'footer.php'; ?>