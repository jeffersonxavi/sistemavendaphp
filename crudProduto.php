<?php
require_once 'DB.php';
require_once 'Produto.php';
class CrudProduto extends Produto{
    protected $tabela = 'produto';

    public function __construct()
    {
    }
    //buscar dados
    public function buscarDados(){
        $res = array();
        $cmd = "SELECT * FROM $this->tabela ORDER BY idproduto DESC";
        $cmd = DB::prepare($cmd);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } 
    //cadastrar Produto
    public function cadastrarProduto(){
        $cmd = "SELECT idproduto FROM $this->tabela WHERE nome = :nome ";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":nome", $this->getNome());
        $cmd->execute();
        if($cmd->rowCount() > 0){
            return false;
        }
        else{
            $cmd = "INSERT INTO $this->tabela (nome,valor,quantidade) VALUES (:nome,:valor,:quantidade)";
            $cmd = DB::prepare($cmd);
            $cmd->bindValue(":nome", $this->getNome());
            $cmd->bindValue(":valor", $this->getValor());
            $cmd->bindValue(":quantidade", $this->getQuantidade());
            $cmd->execute(); var_dump($cmd);
            return true;
        }

    }
    //excluir Produto
    public function excluirProduto(){
        $cmd= "DELETE FROM $this->tabela WHERE idproduto = :idproduto";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":idproduto", $this->getIdProduto());
        $cmd->execute(); 
    }
    //buscar um produto
    public function buscarDadosProduto($idProduto){
        $query = "SELECT * FROM $this->tabela WHERE idproduto = :idproduto";
        $stm = DB::prepare($query);
        $stm->bindParam(':idproduto', $idProduto, PDO::PARAM_INT);
        $stm->execute();

        $produto = new Produto(null, null, null, null);
        $produto = $stm->fetch(PDO::FETCH_ASSOC);
        foreach ($stm->fetchAll() as $pr) {
            $produto->setidProduto($pr->idProduto);
            $produto->setNome($pr->nome);
            $produto->setValor($pr->valor);
            $produto->setQuantidade($pr->quantidade);
        }
        return $produto;
    }


    public function atualizarProduto(){
        $cmd= DB::prepare("UPDATE $this->tabela set nome=:nome, valor=:valor, quantidade=:quantidade 
        where idproduto=:idproduto");
        $cmd->bindValue(":idproduto", $this->getIdProduto());
        $cmd->bindValue(":nome", $this->getNome());
        $cmd->bindValue(":valor", $this->getValor());
        $cmd->bindValue(":quantidade", $this->getQuantidade());
        $cmd->execute();
    }

}

?>