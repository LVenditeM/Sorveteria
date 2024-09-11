<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class Venda extends Database
{

    private $id_venda;
    private $status;
    private $fk_carrinheiro;
    private $valor_bruto;
    private $valor_ganho;
    private $valor_carrinheiro;
    private $data;

    function __construct()
    {
    }

    public function getIdVenda()
    {
        return $this->id_venda;
    }

    public function setIdVenda($id_venda)
    {
        $this->id_venda = $id_venda;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFK_Carrinheiro()
    {
        return $this->fk_carrinheiro;
    }

    public function setFK_Carrinheiro($fk_carrinheiro)
    {
        $this->fk_carrinheiro = $fk_carrinheiro;
    }

    public function getValor_Bruto()
    {
        return $this->valor_bruto;
    }

    public function setValor_Bruto($valor_bruto)
    {
        $this->valor_bruto = $valor_bruto;
    }

    public function getValor_Ganho()
    {
        return $this->valor_ganho;
    }

    public function setValor_Ganho($valor_ganho)
    {
        $this->valor_ganho = $valor_ganho;
    }

    public function getValor_Carrinheiro()
    {
        return $this->valor_carrinheiro;
    }

    public function setValor_Carrinheiro($valor_carrinheiro)
    {
        $this->valor_carrinheiro = $valor_carrinheiro;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    function salvar()
    {
        $sql = "insert into venda (status, fk_carrinheiro, valor_bruto, valor_ganho, valor_carrinheiro, data) values (?,?,?,?,?,?)";
        $parametros = array($this->getStatus(), $this->getFK_Carrinheiro(), $this->getValor_Bruto(), $this->getValor_Ganho(), $this->getValor_Carrinheiro(), $this->getData());
        return $this->insertDB($sql, $parametros);
    }

    function pesquisaVenda($atributo, $valor)
    {
        $sql = "select * from venda where " . $atributo . " = ?";
        $parametros = array($valor);
        $dados = $this->selectDB($sql, $parametros, 'venda');

        if (!empty($dados)) {
            $this->setIdVenda($dados[0]->getIdVenda());
            $this->setStatus($dados[0]->getStatus());
            $this->setFK_Carrinheiro($dados[0]->getFK_Carrinheiro());
            $this->setValor_Bruto($dados[0]->getValor_Bruto());
            $this->setValor_Ganho($dados[0]->getValor_Ganho());
            $this->setValor_Carrinheiro($dados[0]->getValor_Carrinheiro());
            $this->setData($dados[0]->getData());
        }
    }


    function atualizar()
    {
        $sql = "update venda set status =?, fk_carrinheiro =?, valor_bruto =?, valor_ganho =?, valor_carrinheiro =?, data =? where id_venda =?";
        $parametros = array($this->getStatus(), $this->getFK_Carrinheiro(), $this->getValor_Bruto(), $this->getValor_Ganho(), $this->getValor_Carrinheiro(), $this->getData(), $this->getIdVenda());
        return $this->updateDB($sql, $parametros);
    }

    function existe($atributo, $valor)
    {
        $sql = "select * from venda where " . $atributo . " = ?";
        $parametros = array($valor);
        $dados = $this->selectDB($sql, $parametros, 'venda');
        if (empty($dados)) {
            return false;
        }
        return true;
    }


}

?>