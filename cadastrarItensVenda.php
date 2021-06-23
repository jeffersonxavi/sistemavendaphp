<?php
//Header
include_once 'includes/header.php';
//conexão
require_once 'CrudVenda.php';
require_once 'CrudItensVenda.php';
require_once 'CrudProduto.php';
$Venda = new CrudVenda();
$ItensVenda = new CrudItensVenda();
$Produto = new CrudProduto();

if(isset($_POST['btn-cadastrar'])){
    $Venda->setIdCliente($_POST['idcliente']);
    $Venda->setIdVenda($_POST['idvenda']);
    $ItensVenda->setIdItensVenda($_POST['quantidade']);

    if(!empty($Venda->getIdCliente()) && !empty($Venda->getValorTotal())){
        if(!$Venda->cadastrarVenda($Venda->getIdCliente(),$Venda->getValorTotal())){
            
        }else{
            header('Location: menuVenda.php');
        }
    }
    else{
        echo "Preencha todos os campos";
    }
}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Novo Venda </h3>
            <form method= "POST">
                    <div class="input-field col s12">
                        <input type="text" name="idcliente" id="idcliente">
                        <label for= "idcliente">Id Cliente</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="idproduto" id="idproduto">
                        <label for= "idproduto">Id Produto</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="quantidade" id="quantidade">
                        <label for= "quantidade">Qantidade</label>
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

