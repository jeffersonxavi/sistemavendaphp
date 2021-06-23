<?php
require_once 'DB.php';
class Produto extends DB
{
    private $idProduto;
    private $nome;
    private $Valor;
    private $Quantidade;

    public function __construct($idProduto, $nome, $Valor, $Quantidade)
    {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->Valor = $Valor;
        $this->Quantidade = $Quantidade;
    }

    public function getidProduto()
    {
        return $this->idProduto;
    }

    public function setidProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getValor()
    {
        return $this->Valor;
    }

    public function setValor($Valor)
    {
        $this->Valor = $Valor;
    }

    public function getQuantidade()
    {
        return $this->Quantidade;
    }

    public function setQuantidade($Quantidade)
    {
        $this->Quantidade = $Quantidade;
    }

}