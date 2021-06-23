<?php
//Header
include_once 'includes/header.php';
require_once 'CrudProduto.php';
$Produto = new CrudProduto();
//Select 
if(isset($_GET['idproduto_update'])){
    $Produto->setIdProduto($_GET['idproduto_update']);
    $res = $Produto->buscarDadosProduto($Produto->getIdProduto());
}

?>

<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Atualizar Produto </h3>
            <form method= "POST">
                <div class="input-field col s12">
                        <input type="text" name="nome" id="nome" value="<?php echo $res['nome']; ?>">
                        <label for= "nome">Nome</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="valor" id="valor" value="<?php echo $res['valor']; ?>">
                        <label for= "valor">Valor</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="quantidade" id="quantidade" value="<?php echo $res['quantidade']; ?>">
                        <label for= "quantidade">Quantidade</label>
                    </div>
                    <button href ="editarproduto.php" type="submit" name= "btn-editarproduto" class="btn">Atualizar</button>
                    <a href="menuproduto.php" class="btn green">Lista de Produtos</a>
                 
            </form>
    </div>
</div>

<?php
if(isset($_POST['btn-editarproduto'])){
    $Produto->setIdProduto($_GET['idproduto_update']);
    $Produto->setNome($_POST['nome']);
    $Produto->setValor($_POST['valor']);
    $Produto->setQuantidade($_POST['quantidade']);  
    $res = $Produto->atualizarProduto($Produto->getIdProduto(),$Produto->getNome(),$Produto->getValor(),$Produto->getQuantidade());
    header('Location: menuproduto.php');

}
//Footer
include_once 'includes/footer.php';
?>