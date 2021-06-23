<?php
//Header
include_once 'includes/header.php';
//conexão
require_once 'Crudproduto.php';
$produto = new Crudproduto();


if(isset($_POST['btn-cadastrar'])){
    $produto->setNome($_POST['nome']);
    $produto->setValor($_POST['valor']);
    $produto->setQuantidade($_POST['quantidade']);

    if(!empty($produto->getNome()) && !empty($produto->getValor()) && !empty($produto->getQuantidade())){
        if(!$produto->cadastrarProduto($produto->getNome(),$produto->getValor(),$produto->getQuantidade())){
            echo "Produto já cadastrado.";
        }else{    
            header("location: menuproduto.php");
        }
    }
    else{
        echo "Preencha todos os campos";
    }
}    

?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Novo produto </h3>
            <form method= "POST">
                <div class="input-field col s12">
                        <label for= "nome">Nome</label>
                        <input type="text" name="nome" id="nome">
                    </div>
                    <div class="input-field col s12 l6">
                        <input type="text" name="valor" id="valor">
                        <label for= "valor">Valor</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input type="number" name="quantidade" id="quantidade">
                        <label for= "quantidade">Quantidade</label>
                    </div>
                    <button type="submit" name= "btn-cadastrar" class="btn">Cadastrar</button>
                    <a href="menuproduto.php" class="btn green">Lista de produtos</a>
                 
            </form>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>

