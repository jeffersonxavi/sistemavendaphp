<?php
require_once 'DB.php';
require_once 'ItensVenda.php';
class Cruditensvenda extends ItensVenda{
    protected $tabela = 'itensvenda';


    public function __construct()
    {
    }
    //buscar dados
    public function buscarDados(){
        $res = array();
        $cmd = "SELECT * FROM $this->tabela ORDER BY iditensvenda DESC";
        $cmd = DB::prepare($cmd);   
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } 
    //cadastrar itensvenda
    public function cadastrarItensVenda(){
            $cmd = "INSERT INTO $this->tabela (idvenda,idproduto,quantidade,valorunitario) VALUES (:idvenda,:idproduto,:quantidade,:valorunitario)";
            $cmd = DB::prepare($cmd);
            $cmd->bindValue(":idvenda", $this->getIdVenda());
            $cmd->bindValue(":idproduto", $this->getIdProduto());
            $cmd->bindValue(":quantidade", $this->getQuantidade());
            $cmd->bindValue(":valorunitario", $this->getValorUnitario());
            $cmd->execute();
    }

    //excluir itensvenda
    public function excluiritensvenda(){
        $cmd= "DELETE FROM $this->tabela WHERE idvenda = :idvenda";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":idvenda", $this->getIdVenda());
        $cmd->execute(); 
    }

    public function buscarDadosItensVenda(){
        $res = array();
        $cmd= "SELECT * FROM $this->tabela WHERE idvenda = :idvenda";
        $cmd = DB::prepare($cmd); 
        $cmd->bindValue(":idvenda", $this->getIdVenda());
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;

    }
}