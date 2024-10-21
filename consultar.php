<?php 




//Header
include_once 'header.php';

//adiciona ou persiste itens pré-existentes dentro do arrray
$produto1 = array("codigo"=> "1", "desc"=> "produto 1", "data"=> "10/10/2023" , "preco"=> "101.15"  );
$produto2 = array("codigo"=> "2", "desc"=> "produto 2", "data"=> "11/10/2023" , "preco"=> "200.201" );
$produto3 = array("codigo"=> "3", "desc"=> "produto 3" , "data"=> "12/10/2023" , "preco"=> "52.33");
$produto4 = array("codigo"=> "4", "desc"=> "produto 4", "data"=> "13/10/2023" , "preco"=> "246.65" );
$produto5 = array("codigo"=> "5", "desc"=> "produto 5" , "data"=> "14/10/2023" , "preco"=> "89.24");
$lista = array(  $produto1, $produto2, $produto3, $produto4, $produto5);  
//var_dump( $lista );

?>
   

    

<div class="row mt-4">
        <div class="col-8 container my-2">      
            <fieldset class="border p-2">
                <!--FORMULÁRIO DE INCLUSÃO-->
                <legend class="control-label">Incluir produto</legend>        
                <form action="consultar.php" method="POST">
                    <div class="row mx-3 g-2">
                        <div class="col-3">
                          
                            <label for="nome" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="txtdescricao" required>
                        </div>
                        <div class="col-2">
                            <label for="sobrenome" class="form-label">Data Inclusão</label>
                            <input type="text" class="form-control" id="data" name="txtdata">
                        </div>
                    
                        <div class="col-4">
                            <div class="col-2">
                            <label for="idade" class="form-label">Preço</label>
                            <input type="number" class="form-control" id="preco" name="txtpreco" min="10" max="120">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mx-3 my-3 g-2">
                        <div class="col-2">
                            <button type="submit" name="btn-cadastrar" class="btn btn-primary"> Cadastrar</button>
                            
                        </div>
                    </div>
                </form>    
            </fieldset>
    </div> 

    <!--TELA DE CONSULTA-->
     <div class="container my-3 col-9">   
        <div class="m-5 ">
            <div class="fs-5 mb-5">
                <h1>Lista de Produtos</h1>
            </div>
            <div class="table-responsive">            
                <table class="table  table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data inclusão</th>
                            <th scope="col">Preço</th>                   
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php 
                        
                        //a funcao count retorna quantidade de itens dentro do array
                        if (count($lista) !=0){
                            //Percorre todos os itens do array
                            foreach($lista as  $itemproduto =>$valorproduto){                                    
                               ?>      
        
                                <tr>

                                
                                    <td> <?php echo $valorproduto["codigo"] ?> </td>
                                    <td> <?php echo $valorproduto["desc"] ?> </td>
                                    <td> <?php echo $valorproduto["data"] ?> </td>
                                    <td> <?php echo  $valorproduto["preco"] ?>  </td>
                                    
                                    <td>    
                                        <a href='editar.php?<?php echo  $valorproduto["codigo"];?>'  class="btn btn-sm btn-primary"> 
                                            <i  class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <!-- O atributo  data-bs-toggle pode ser modal ou popover. -->
                                        <a href='excluir.php?<?php echo  $valorproduto["codigo"];?>' class="btn btn-sm btn-danger"  data-bs-toggle='modal' data-bs-target="#exampleModal<?php echo  $valorproduto["codigo"];?>"> 
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

                           }//fechamento do for
                        }else{

                            ?>    
                                                
                        <tr><!--Esse trecho somente será executado se o array estiver vazio-->
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <?php
                        }
                        ?> 
                        
                        
                                
                    </tbody> 
                </table>
            </div>

            
            
        </div>

    </div>
</div>

<?php include_once 'footer.php';?>

     
 
