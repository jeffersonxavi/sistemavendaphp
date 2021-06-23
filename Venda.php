<?php
require_once 'DB.php';
class Venda extends DB
{
    private $IdVenda;
    private $IdCliente;
    private $ValorTotal;

    public function __construct($IdVenda, $IdCliente, $ValorTotal)
    {
        $this->IdVenda = $IdVenda;
        $this->IdCliente = $IdCliente;
        $this->ValorTotal = $ValorTotal;
    }

    public function getIdVenda()
    {
        return $this->IdVenda;
    }

    public function setIdVenda($IdVenda)
    {
        $this->IdVenda = $IdVenda;
    }

    public function getIdCliente()
    {
        return $this->IdCliente;
    }

    public function setIdCliente($IdCliente)
    {
        $this->IdCliente = $IdCliente;
    }

    public function getValorTotal()
    {
        return $this->ValorTotal;
    }

    public function setValorTotal($ValorTotal)
    {
        $this->ValorTotal = $ValorTotal;
    }

}