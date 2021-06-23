<?php
require_once 'DB.php';
require_once 'Venda.php';
class CrudVenda extends Venda{
    protected $tabela = 'venda';

    public function __construct()
    {
    }
    //buscar dados
    public function buscardados()
    {
        $query = "SELECT * FROM $this->tabela order by idvenda DESC";
        $cmd = DB::prepare($query);
        $cmd->execute();
        $vendas = array();
      
        foreach ($cmd->fetchAll() as $venda) {
            array_push(
                $vendas,
                new Venda($venda->idvenda, $venda->idcliente, $venda->valortotal)
            );

        }

        return $vendas;
    }
    //cadastrar Venda
    public function cadastrarVenda(){

            $cmd = "INSERT INTO $this->tabela (idcliente,valortotal) VALUES (:idcliente,:valortotal)";
            $cmd = DB::prepare($cmd);
            $cmd->bindValue(":idcliente", $this->getIdCliente());
            $cmd->bindValue(":valortotal", $this->getValorTotal());
            $cmd->execute();
    }

    //excluir Venda
    public function excluirVenda(){
        $cmd= "DELETE FROM $this->tabela WHERE idvenda = :idvenda";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":idvenda", $this->getIdVenda());
        $cmd->execute(); 
    }    
    //excluir Venda pelo idcliente
    public function excluirVendaCliente(){
        $cmd= "DELETE FROM $this->tabela WHERE idcliente = :idcliente";
        $cmd = DB::prepare($cmd);
        $cmd->bindValue(":idcliente", $this->getIdCliente());
        $cmd->execute(); 
    }
    //buscar uma venda
    public function buscarDadosVenda($IdVenda){
        $query = "SELECT * FROM $this->tabela WHERE idvenda = :idvenda";
        $cmd = DB::prepare($query);
        $cmd->bindParam(':idvenda', $IdVenda, PDO::PARAM_INT);
        $cmd->execute();
        
        $venda = new Venda(null, null, null);
        $venda = $cmd->fetch(PDO::FETCH_ASSOC);
        foreach ($cmd->fetchAll() as $ven) {
            $venda->setIdVenda($ven->idvenda);
            $venda->setIdCliente($ven->idcliente);
            $venda->setValorTotal($ven->valortotal);
        }
        return $venda;
    }  

    //buscar venda pelo idcliente
    public function buscarDadosCliente($idCliente) {

        $idvenda = null;
        $query = "SELECT idvenda FROM $this->tabela WHERE idcliente = :idvenda AND valortotal = 0";
        $stm = DB::prepare($query);
        $stm->bindParam(':idvenda', $idCliente, PDO::PARAM_INT);
        $stm->execute();
        
        foreach ($stm->fetchAll() as $venda) {
            $idvenda = $venda->idvenda;
        }
        return $idvenda;
    }



    public function atualizarVenda(){
        $cmd= DB::prepare("UPDATE $this->tabela set idcliente=:idcliente, valortotal=:valortotal 
        where idvenda=:idvenda");
        
        $cmd->bindValue(":idvenda", $this->getIdVenda());
        $cmd->bindValue(":idcliente", $this->getIdCliente());
        $cmd->bindValue(":valortotal", $this->getValorTotal());
        $cmd->execute();
    }

}

?>