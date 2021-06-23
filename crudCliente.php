<?php
require_once 'DB.php';
require_once 'Cliente.php';
class CrudCliente extends Cliente{
    protected $tabela = 'cliente';

    public function __construct()
    {
    }
    //buscar dados
    public function buscarDados(){
        $res = array();
        $cmd = "SELECT * FROM $this->tabela ORDER BY idcliente DESC";
        $cmd = DB::prepare($cmd);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } 
    //cadastrar cliente
    public function cadastrarCliente(){
        $cmd = "SELECT idcliente FROM $this->tabela WHERE cpf = :cpf ";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":cpf", $this->getCpf());
        $cmd->execute();
        if($cmd->rowCount() > 0){
            return false;
        }
        else{
            $cmd = "INSERT INTO $this->tabela (nome,cpf,idade) VALUES (:nome,:cpf,:idade)";
            $cmd = DB::prepare($cmd);
            $cmd->bindValue(":nome", $this->getNome());
            $cmd->bindValue(":cpf", $this->getCpf());
            $cmd->bindValue(":idade", $this->getIdade());
            $cmd->execute();
            return true;
        }

    }

    //excluir cliente
    public function excluirCliente(){
        $cmd= "DELETE FROM $this->tabela WHERE idcliente = :idcliente";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":idcliente", $this->getIdCliente());
        $cmd->execute(); 
    }
     //buscar um cliente
     public function buscarDadosCliente($IdCliente)
     {
         $query = "SELECT * FROM $this->tabela WHERE idcliente = :idcliente";
         $cmd = DB::prepare($query);
         $cmd->bindParam(':idcliente', $IdCliente, PDO::PARAM_INT);
         $cmd->execute();
         
         $res = new Cliente(null, null, null, null);
         $res = $cmd->fetch(PDO::FETCH_ASSOC);
         foreach ($cmd->fetchAll() as $c) {
             $res->setIdCliente($c->idcliente);
             $res->setNome($c->nome);
             $res->setCpf($c->cpf);
             $res->setIdade($c->idade);                   
         } 

         return $res;
     }

     public function atualizarCliente()
     {
         $cpf = $this->getCpf();
         $idade = $this->getIdade();
         $query = "UPDATE $this->tabela SET nome = :nome, cpf = :cpf, idade = :idade WHERE idcliente = :idcliente";
         $stm = DB::prepare($query);
         $stm->bindParam(':idcliente', $this->getIdCliente(), PDO::PARAM_INT);
         $stm->bindParam(':nome', $this->getNome());
         $stm->bindParam(':cpf', $cpf);
         $stm->bindParam(':idade', $idade);
         return $stm->execute();
     }
 

}

?>