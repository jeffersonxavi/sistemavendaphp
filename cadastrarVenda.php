<?php
//Header
include_once 'includes/header.php';
//conexão
require_once 'CrudCliente.php';
require_once 'CrudProduto.php';
require_once 'CrudItensVenda.php';
require_once 'CrudVenda.php';
$Produto = new CrudProduto();
$Cliente = new CrudCliente();
$ItensVenda = new CrudItensVenda();
$venda = new CrudVenda();

if(isset($_POST['btn-cadastrar'])){
 
    

    $idCliente= $_POST['idcliente'];
    $venda->setIdCliente($idCliente);
    $venda->setValorTotal(0);
    $venda->cadastrarVenda($venda->getIdCliente(),$venda->getValorTotal());

    
    $venda->setIdCliente($idCliente);
    $venda->setIdVenda($venda->buscarDadosCliente($idCliente));
    var_dump($venda->getIdVenda());

    $ItensVenda->setIdVenda($venda->getIdVenda());

    $idProduto = $_POST['idproduto'];

    $ItensVenda->setIdProduto($idProduto);
    
    $ItensVenda->setQuantidade($_POST['quantidade']);

    $Produto->setidProduto($_POST['idproduto']);
    $res = $Produto->buscarDadosProduto($Produto->getidProduto());

    $ItensVenda->setValorUnitario($res['valor']);


    $res = $ItensVenda->cadastrarItensVenda($ItensVenda->getIdVenda(),
                                    $idProduto,
                                    $ItensVenda->getQuantidade(),
                                    $ItensVenda->getValorUnitario());
                                    header("location: menuvenda.php");

}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Nova Venda </h3>
            <form method= "POST">
                    <div class="input-field col s12">
                        <select name="idcliente" class="form-select" id="idcliente">
                        <option value="" disabled selected>Selecione</option>
                        <?php
                                    foreach ($Cliente->buscarDados() as $clientes) { ?>
                                        <option value="<?= $clientes['idcliente'] ?>"><?= $clientes['nome']?></option> <?php
                                    }
                                ?>
                        </select>
                        <label for= "idcliente">Selecionar Cliente</label>
                    </div>
                    <div class="input-field col s12">
                    <select name="idproduto" class="form-select" id="idproduto">
                        <option value="" disabled selected>Selecione</option>
                        <?php
                                    foreach ($Produto->buscarDados() as $produtos) { ?>
                                        <option value="<?= $produtos['idproduto'] ?>"><?= $produtos['nome']; echo' ('.$produtos['valor']; echo 'R$)';?></option> <?php
                                    }echo $produto['idproduto'];
                                ?>
                        </select>
                        <label for= "idproduto">Selecionar Produto</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input type="text" name="valorunitario" id="valorunitario" disabled value="">
                        <label for= "valorunitario">Valor Unitário</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input type="number" name="quantidade" id="quantidade">
                        <label for= "quantidade">Qantidade</label>
                    </div>    
                    
                    <div class="input-field col s12">
                        <input type="text" name="valortotal" id="valortotal" disabled value="">
                        <label for= "valortotal">Valor Total</label>
                    </div>                        
                    <button type="submit" name= "btn-cadastrar" class="btn">Cadastrar</button>
                    <a href="menuVenda.php" class="btn green">Lista de Vendas</a>
            </form>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>

