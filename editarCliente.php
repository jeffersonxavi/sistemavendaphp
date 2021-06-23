<?php
//Header
include_once 'includes/header.php';
require_once 'CrudCliente.php';
$cliente = new CrudCliente();
//Select 
if(isset($_GET['idcliente_update'])){
    $cliente->setIdCliente($_GET['idcliente_update']);
    $res = $cliente->buscarDadosCliente($cliente->getIdCliente());
} 


?>

<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Atualizar Cliente </h3>
            <form method= "POST">
                <div class="input-field col s12">
                        <input type="text" name="nome" id="nome" value="<?php echo $res['nome']; ?>">
                        <label for= "nome">Nome</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="cpf" id="cpf" value="<?php echo $res['cpf']; ?>">
                        <label for= "cpf">CPF</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="idade" id="idade" value="<?php echo $res['idade']; ?>">
                        <label for= "idade">Idade</label>
                    </div>
                    <button href ="editarCliente.php" type="submit" name= "btn-editarCliente" class="btn">Atualizar</button>
                    <a href="menucliente.php" class="btn green">Lista de Clientes</a>
                 
            </form>
    </div>
</div>

<?php
if(isset($_POST['btn-editarCliente'])){
    $cliente->setIdCliente($_GET['idcliente_update']);
    $cliente->setNome($_POST['nome']);
    $cliente->setCpf($_POST['cpf']);
    $cliente->setIdade($_POST['idade']);  
    $res = $cliente->atualizarCliente($cliente->getIdCliente(),$cliente->getNome(),$cliente->getCpf(),$cliente->getIdade());
    header('Location: menucliente.php');

}
//Footer
include_once 'includes/footer.php';
?>