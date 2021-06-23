<?php
//Header
include_once 'includes/header.php';
require_once 'crudVenda.php';
require_once 'crudCliente.php';
require_once 'Cruditensvenda.php';
$vendas = new CrudVenda();
$clientes = new CrudCliente();
$itensvenda = new Cruditensvenda();

if(isset($_GET['idvenda_update'])){
    $idVenda_update = addslashes($_GET['idvenda_update']);
    $dados = $Venda->buscarDadosVenda($idVenda_update);
}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"><center> Vendas </h3>
            <table class="striped s12">
                <thead>
                    <tr>            
                    <a href="index.php" class="btn-floating"><i class="material-icons">arrow_back</a>
                        <th>Cliente:</th>
                        <th>Valor Total:</th>
                    </tr>
                    <tbody>
                <?php
                    foreach ($vendas->buscardados() as $venda) { ?>
                        <tr>
                            <td> <?= $clientes->setIdCliente($venda->getIdCliente());
                            $res = $clientes->buscarDadosCliente($clientes->getIdCliente()); echo $res['nome'];  
                            ?> </td>
                            <td>R$ <?= number_format($venda->getValorTotal(), 2, ',', '') ?> </td>
                            <td>
                                        <td><a href="editarVenda.php?idvenda_update=<?php echo $venda->getIdVenda()?>" class="btn-floating green"><i class="material-icons">edit</i></a></td>
                                        <td><a href="menuvenda.php?idvenda=<?php echo $venda->getIdVenda()?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
                            </td>
                        </tr> <?php
                    }
                ?>
            </tbody>
                </thead>
            </table>
            <br>
            <a href="cadastrarVenda.php" class="btn"> REALIZAR VENDA </a>
    </div>
</div>

<?php
if(isset($_GET['idvenda'])){
    $itensvenda->setIdVenda($_GET['idvenda']);
    $itensvenda->excluiritensvenda($itensvenda->getIdItensVenda());

    $vendas->setIdVenda($_GET['idvenda']);
    $vendas->excluirVenda($vendas->getIdVenda());
    
    var_dump($vendas);    
    header("location: menuvenda.php");
    echo 'Venda excluída com sucesso.';
}

//Footer    
include_once 'includes/footer.php';
?>