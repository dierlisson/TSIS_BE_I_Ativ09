<?php
include_once 'header.php';
require_once 'sessao.php';
require_once 'dbProdutos.php';

// Função para ler produtos do banco de dados
function lerProdutos($conexao)
{
    $sql = "SELECT id_prod, descricao, data, preco, validade FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    $produtos = array();
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($produto = mysqli_fetch_assoc($resultado)) {
            $produtos[] = $produto;
        }
    }
    return $produtos;
}

// Variável de erro para exibir mensagens de validação
$erro = "";

if (isset($_POST['btn-cadastrar'])) {
    $descricao = $_POST['txtdescricao'];
    $data = $_POST['txtdata'];
    $preco = $_POST['txtpreco'];
    $validade = $_POST['txtvalidade'];

    // Validações
    if (!filter_var($preco, FILTER_VALIDATE_FLOAT)) {
        $erro = "O preço inserido é inválido. Insira um número válido.";
    } elseif (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $data)) {
        $erro = "A data de inclusão é inválida. Use o formato DD/MM/AAAA.";
    } elseif (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $validade)) {
        $erro = "A data de validade é inválida. Use o formato DD/MM/AAAA.";
    } else {
        // Insere o novo produto no banco de dados
        $sql = "INSERT INTO produtos (descricao, data, preco, validade) VALUES ('$descricao', '$data', '$preco', '$validade')";
        if (!mysqli_query($connect, $sql)) {
            $erro = "Erro ao cadastrar o produto: " . mysqli_error($connect);
        }
    }
}

// Busca a lista de produtos do banco de dados
$lista = lerProdutos($connect);
?>

<div class="row mt-4">
    <div class="col-8 container my-2">
        <fieldset class="border p-2">
            <legend class="control-label">Incluir produto</legend>
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
                </div>
            </form>

            <!-- Mensagem de erro, se houver -->
            <?php if ($erro): ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>
        </fieldset>
    </div>

    <!-- Tela de Consulta -->
    <div class="container my-3 col-9">
        <div class="m-5">
            <div class="fs-5 mb-5">
                <h1>Lista de Produtos</h1>
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
                                    <td><?php echo $produto["id_prod"]; ?></td>
                                    <td><?php echo $produto["descricao"]; ?></td>
                                    <td><?php echo $produto["data"]; ?></td>
                                    <td><?php echo $produto["preco"]; ?></td>
                                    <td><?php echo $produto["validade"]; ?></td>
                                    <td>
                                        <a href='editar.php?id=<?php echo $produto["id_prod"]; ?>' class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href='excluir.php?id=<?php echo $produto["id_prod"]; ?>' class="btn btn-sm btn-danger" data-bs-toggle='modal' data-bs-target="#exampleModal<?php echo $produto["id_prod"]; ?>">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal de confirmação de exclusão -->
                                <div class='modal fade' id="exampleModal<?php echo $produto["id_prod"]; ?>" tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header bg-danger text-white'>
                                                <h1 class='modal-title fs-5' id='exampleModalLabel'>ATENÇÃO!</h1>
                                                <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body mb-3 mt-3'>
                                                Tem certeza que deseja <b>EXCLUIR</b> o produto <?php echo $produto["descricao"]; ?>?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Voltar</button>
                                                <a href="excluir.php?id=<?php echo $produto["id_prod"]; ?>" type='button' class='btn btn-danger'>Sim, quero!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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