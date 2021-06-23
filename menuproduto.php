<?php
//Header
include_once 'includes/header.php';
require_once 'crudProduto.php';
$Produto = new CrudProduto();

if(isset($_GET['idproduto_update'])){
    $idProduto_update = addslashes($_GET['idproduto_update']);
    $dados = $Produto->buscarDadosProduto($idProduto_update);
}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"><center> Produtos </h3>
            <table class="striped s12">
                <thead>
                    <tr>                    
                    <a href="index.php" class="btn-floating"><i class="material-icons">arrow_back</a>
                        <th>Nome:</th>
                        <th>Valor:</th>
                        <th>Quantidade:</th> 
                    </tr>
                    <tbody>
                    <tr>
					<?php 
                        $dados = $Produto->buscarDados();
                        if ( count($dados) > 0 ) {
                            for ( $i = 0; $i < count($dados); $i++ ) {
                                echo '<tr>';
                                    foreach ( $dados[$i] as $k => $v ) {
                                        if ( $k != 'idproduto' ) {
                                                echo '<td>'.utf8_encode($v).'</td>'; 
                                            }
                                        }
                    ?>
                                        <td><?php echo $dados[$i]['idproduto'];?></a></td>
                                        <td><a href="editarProduto.php?idproduto_update=<?php echo $dados[$i]['idproduto'];?>" class="btn-floating green"><i class="material-icons">edit</i></a></td>
                                        <td><a href="menuProduto.php?idproduto=<?php echo $dados[$i]['idproduto'];?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
        
                    <?php
                                    }
                                }
                                else{
                                    echo "Não há produtos cadastrados.";
                                }
                    ?>
                    </tr>
                    </tbody>
                </thead>
            </table>
            <br>
            <a href="cadastrarProduto.php" class="btn">Adicionar Produto</a>
    </div>
</div>

<?php
if(isset($_GET['idproduto'])){
    $Produto->setIdProduto($_GET['idproduto']);
    $Produto->excluirProduto($Produto->getIdProduto());    
    header("location: menuproduto.php");
}

//Footer    
include_once 'includes/footer.php';
?>