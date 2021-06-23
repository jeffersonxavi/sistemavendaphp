<?php
//Header
include_once 'includes/header.php';
require_once 'CrudVenda.php';
$Venda = new CrudVenda();
//Select 
if(isset($_GET['idvenda_update'])){
    $Venda->setIdVenda($_GET['idvenda_update']);
    $res = $Venda->buscarDadosVenda($Venda->getIdVenda());
}    

?>

<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Atualizar Venda </h3>
            <form method= "POST">
                <div class="input-field col s12">
                        <input type="text" name="idcliente" id="idcliente"  value="<?php echo $res['idcliente']; ?>">
                        <label for= "idcliente">Id Cliente</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="valortotal" id="valortotal" value="<?php echo $res['valortotal']; ?>">
                        <label for= "valortotal">Valor Total</label>
                    </div>
                    <button href ="editarVenda.php" type="submit" name= "btn-editarVenda" class="btn">Atualizar</button>
                    <a href="menuvenda.php" class="btn green">Lista de Vendas</a>
                 
            </form>
    </div>
</div>

<?php
if(isset($_POST['btn-editarVenda'])){
    $Venda->setIdCliente($_POST['idcliente']);
    $Venda->setValorTotal($_POST['valortotal']);  
    $res = $Venda->atualizarVenda($Venda->getIdCliente(),$Venda->getValorTotal());
    header('Location: menuVenda.php');

}
//Footer
include_once 'includes/footer.php';
?>