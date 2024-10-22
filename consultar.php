<?php

include_once 'header.php';
loginRequired();
function loginRequired() {
    global $auth;
    if ($auth === false) {
        header('Location: login.php');
        exit(); // Interrompe a execução do script
    }
}

$arquivo = 'produtos.json';

function lerArquivo($arquivo) {
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        return json_decode($conteudo, true);
    } else {
        return array(); 
    }
}

// salvar dados no JSON
function salvarArquivo($arquivo, $dados) {
    $json = json_encode($dados, JSON_PRETTY_PRINT);
    file_put_contents($arquivo, $json);
}

// percorre lista de produtos 
$lista = lerArquivo($arquivo);

$erro = "";


if (isset($_POST['btn-cadastrar'])) {
    $descricao = $_POST['txtdescricao'];
    $data = $_POST['txtdata'];
    $preco = $_POST['txtpreco'];
    $validade = $_POST['txtvalidade'];

    // filter_var preço
    if (!filter_var($preco, FILTER_VALIDATE_FLOAT)) {
        $erro = "O preço inserido é inválido. Insira um número válido.";
    }
    // filter_var inclusão e validade
    elseif (!filter_var($data, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{2}\/\d{2}\/\d{4}$/")))) {
        $erro = "A data de inclusão é inválida. Use o formato DD/MM/AAAA.";
    }
    elseif (!filter_var($validade, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{2}\/\d{2}\/\d{4}$/")))) {
        $erro = "A data de validade é inválida. Use o formato DD/MM/AAAA.";
    } else {
        // add novo prod
        $novoProduto = array(
            "id_prod" => count($lista) + 1, 
            "desc" => $descricao, 
            "data" => $data, 
            "preco" => $preco, 
            "validade" => $validade
        );
        
        $lista[] = $novoProduto; 
        salvarArquivo($arquivo, $lista); 
    }
}
?>

<div class="row mt-4">
    <div class="col-8 container my-2">      
        <fieldset class="border p-2">
            <!--FORMULÁRIO DE INCLUSÃO-->
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

            <!-- se der erro -->
            <?php if ($erro): ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>
        </fieldset>
    </div> 

    <!--TELA DE CONSULTA-->
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
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php 
                        if (count($lista) != 0) {
                            // Percorre todos os itens do array
                            foreach($lista as $valorproduto) {                                  
                        ?>
                            <tr>
                                <td><?php echo $valorproduto["id_prod"] ?></td>
                                <td><?php echo $valorproduto["desc"] ?></td>
                                <td><?php echo $valorproduto["data"] ?></td>
                                <td><?php echo $valorproduto["preco"] ?></td>
                                <td><?php echo $valorproduto["validade"] ?></td>
                                <td>
                                    <a href='editar.php?<?php echo $valorproduto["id_prod"];?>' class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href='excluir.php?<?php echo $valorproduto["id_prod"];?>' class="btn btn-sm btn-danger" data-bs-toggle='modal' data-bs-target="#exampleModal<?php echo $valorproduto["id_prod"];?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>

                            <!--INICIO do Modal-->
                            <div class='modal fade' id="exampleModal<?php echo  $valorproduto["codigo"];?>" tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header bg-danger text-white'>
                                                <h1 class='modal-title fs-5 ' id='exampleModalLabel'>ATENÇÃO!</h1>
                                                <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body mb-3 mt-3'>
                                                Tem certeza que deseja <b>EXCLUIR</b> o produto <?php echo $valorproduto["desc"];?>?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Voltar</button>
                                                <a href="excluir.php?id=<?php echo  $valorproduto["codigo"];?>" type='button' class='btn btn-danger'>Sim, quero!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!--FIM do Modal-->

                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <?php } ?> 
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php';?>
