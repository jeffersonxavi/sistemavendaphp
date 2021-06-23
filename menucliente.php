<?php
//Header
include_once 'includes/header.php';
require_once 'crudCliente.php';
require_once 'crudVenda.php';
require_once 'crudItensvenda.php';

$cliente = new CrudCliente();
$venda = new CrudVenda();
$itensvenda= new Cruditensvenda();
if(isset($_GET['idcliente_update'])){
    $idcliente_update = addslashes($_GET['idcliente_update']);
    $dados = $cliente->buscarDadosCliente($idCliente);
}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"><center> Clientes </h3>
            <table class="striped s12">
                <thead>
                    <tr>                    
                    <a href="index.php" class="btn-floating"><i class="material-icons">arrow_back</a>
                        <th>Nome:</th>
                        <th>CPF:</th>
                        <th>Idade:</th> 
                        <th>Id:</th> 
                    </tr>
                    <tbody>
                    <tr>
					<?php 
                        $dados = $cliente->buscarDados();
                        if ( count($dados) > 0 ) {
                            for ( $i = 0; $i < count($dados); $i++ ) {
                                echo '<tr>';
                                    foreach ( $dados[$i] as $k => $v ) {
                                        if ( $k != 'idcliente' ) {
                                                echo '<td>'.utf8_encode($v).'</td>'; 
                                            }
                                        }
                    ?>
                                        <td><?php echo $dados[$i]['idcliente'];?></a></td>
                                        <td><a href="editarCliente.php?idcliente_update=<?php echo $dados[$i]['idcliente'];?>" class="btn-floating green"><i class="material-icons">edit</i></a></td>
                                        <td><a href="menucliente.php?idcliente=<?php echo $dados[$i]['idcliente'];?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
        
                    <?php
                                    }
                                }
                                else{
                                    echo "Não há pessoas cadastradas.";
                                }
                    ?>
                    </tr>
                    </tbody>
                </thead>
            </table>
            <br>
            <a href="cadastrarCliente.php" class="btn" >Adicionar Cliente</a>
            
    </div>
</div>

<?php
if(isset($_GET['idcliente'])){

    $idCliente= $_GET['idcliente'];
    $venda->setIdCliente($idCliente);
    $res = $venda->setIdVenda($venda->buscarDadosCliente($idCliente));

    $venda->setIdVenda($res['idvenda']);
    $venda->excluirVenda($venda->getIdVenda());
    $itensvenda->setIdVenda($res['idvenda']);
    $itensvenda->excluiritensvenda($itensvenda->getIdVenda());

    $cliente->setIdCliente($_GET['idcliente']);
    $cliente->excluirCliente($cliente->getIdCliente());    
    header("location: menucliente.php");
}

//Footer    
include_once 'includes/footer.php';
?>