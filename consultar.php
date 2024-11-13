<?php
include_once 'header.php';
require_once 'sessao.php';
require_once 'dbProdutos.php';

// Função para ler produtos do banco de dados
function lerProdutos($conexao)
{
    $sql = "SELECT idproduto, descricao, data, preco, validade FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    $produtos = array();
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($produto = mysqli_fetch_assoc($resultado)) {
            $produtos[] = $produto;
        }
    }
    return $produtos;
}

$lista = lerProdutos($connect);
?>

<div class="row mt-4">


    <div class="container my-3 col-9">
        <div class="m-5">
            <div class="fs-5 mb-5">
                <h1>Pesquisar Produto</h1>
            </div>
            <div class="row mx-3 my-3 g-2">
                <form action="consultar.php" method="GET" class="col-8 ">
                    <div class="input-group">
                        <input type="text" class="form-control" name="descricao" placeholder="Pesquisar produto por sua descrição" required>
                        <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                    </div>
                    <div class="col-4 my-3">
                        <a href="cadastrar.php" name="btn-voltar" class="btn btn-secondary">Cadastrar Produto</a>
                    </div>
                </form>
            </div>
            <div class="fs-5 mb-5">
                <h1>Lista de Produtos</h1>
            </div>



            <div class="mt-4">
                <?php
                if (isset($_GET['descricao'])) {
                    include_once 'verificar.php';
                }
                ?>

            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data inclusão</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Validade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (count($lista) > 0) {
                            foreach ($lista as $produto) {
                        ?>
                                <tr>
                                    <td><?php echo $produto["idproduto"]; ?></td>
                                    <td><?php echo $produto["descricao"]; ?></td>
                                    <td><?php echo $produto["data"]; ?></td>
                                    <td><?php echo $produto["preco"]; ?></td>
                                    <td><?php echo $produto["validade"]; ?></td>
                                    <td>
                                        <a href='editar.php?idproduto=<?php echo $produto["idproduto"]; ?>' class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href='excluir.php?idproduto=<?php echo $produto["idproduto"]; ?>' class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">Nenhum produto encontrado</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'footer.php';
?>