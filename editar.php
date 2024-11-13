<?php
include_once 'header.php';
include_once 'dbProdutos.php';

if(isset($_GET['id_prod'])){
    $id_prod = filter_var($_GET['id_prod'], FILTER_SANITIZE_NUMBER_INT);
    
    $sql = "SELECT * FROM produtos WHERE id_prod = '$id_prod'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) > 0){
        $dados = mysqli_fetch_array($resultado);
    }
    else{
        echo "<p>Produto não encontrado.</p>";
        exit;
    }
}
?>

<div class="row">
    <div class="container my-3">
        <form action="atualizar.php" method="POST">
            <div class="row mx-3 g-2">
                <h1 class="display-5 mx-3">Atualizar Produto</h1>
                
                <input type="hidden" name="id_prod" value="<?php echo $dados['id_prod']; ?>">

                <div class="input-field col s1">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" value="<?php echo $dados['descricao']; ?>" required>
                </div>

                <div class="input-field col s1">
                    <label for="data">Data de Inclusão</label>
                    <input type="text" name="data" id="data" placeholder="DD/MM/AAAA" value="<?php echo $dados['data']; ?>" required>
                </div>

                <div class="input-field col s1">
                    <label for="preco">Preço</label>
                    <input type="number" name="preco" id="preco" min="0" step="0.01" value="<?php echo $dados['preco']; ?>" required>
                </div>

                <div class="input-field col s1">
                    <label for="validade">Validade</label>
                    <input type="text" name="validade" id="validade" placeholder="DD/MM/AAAA" value="<?php echo $dados['validade']; ?>" required>
                </div>
            </div>

            <div class="row mx-3 my-3 g-2">
                <div class="col-2">
                    <button type="submit" name="btn-atualizar" class="btn btn-primary">Atualizar</button>
                    <a href="consultar.php" class="btn btn-secondary">Voltar para a Lista</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once 'footer.php'; ?>