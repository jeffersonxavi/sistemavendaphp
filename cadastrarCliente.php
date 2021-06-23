<?php
//Header
include_once 'includes/header.php';
//conexão
require_once 'CrudCliente.php';
$cliente = new CrudCliente();


if(isset($_POST['btn-cadastrar'])){
    $cliente->setNome($_POST['nome']);
    $cliente->setCpf($_POST['cpf']);
    $cliente->setIdade($_POST['idade']);

    if(!empty($cliente->getNome()) && !empty($cliente->getCpf()) && !empty($cliente->getIdade())){
        if(!$cliente->cadastrarCliente($cliente->getNome(),$cliente->getCpf(),$cliente->getIdade())){
            echo "CPF já cadastrado.";
        }else{
            header('Location: menucliente.php');
        }
    }
    else{
        echo "Preencha todos os campos";
    }
}
?>


<div class= "row">
    <div class="col s12 m6 push-m3">
        <h3 class="light"> Novo Cliente </h3>
            <form method= "POST">
                <div class="input-field col s12">
                        <label for= "nome">Nome</label>
                        <input type="text" name="nome" id="nome">
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="cpf" id="cpf">
                        <label for= "cpf">CPF</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="idade" id="idade">
                        <label for= "idade">Idade</label>
                    </div>
                    <button type="submit" name= "btn-cadastrar" class="btn">Cadastrar</button>
                    <a href="menucliente.php" class="btn green">Lista de Clientes</a>
                 
            </form>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>

