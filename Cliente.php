<?php
require_once 'DB.php';
class Cliente extends DB
{
    private $IdCliente;
    private $nome;
    private $cpf;
    private $idade;

    public function __construct($IdCliente, $nome, $cpf, $idade)
    {
        $this->IdCliente = $IdCliente;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->idade = $idade;
    }

    public function getIdCliente()
    {
        return $this->IdCliente;
    }

    public function setIdCliente($IdCliente)
    {
        $this->IdCliente = $IdCliente;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

}