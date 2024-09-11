<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class Filial extends Database
{

  private $id_filial;
  private $nome;
  private $endereco;
  private $cidade;
  private $estado;
  private $faturamento_anual;
  private $status;

  function __construct()
  {
  }

  // Getters e Setters

  public function getIdFilial()
  {
    return $this->id_filial;
  }

  public function setIdFilial($id_filial)
  {
    $this->id_filial = $id_filial;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getEndereco()
  {
    return $this->endereco;
  }

  public function setEndereco($endereco)
  {
    $this->endereco = $endereco;
  }

  public function getCidade()
  {
    return $this->cidade;
  }

  public function setCidade($cidade)
  {
    $this->cidade = $cidade;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function getFaturamentoAnual()
  {
    return $this->faturamento_anual;
  }

  public function setFaturamentoAnual($faturamento_anual)
  {
    $this->faturamento_anual = $faturamento_anual;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  // Função para salvar no banco de dados
  function salvar()
  {
    $sql = "insert into filial (nome, endereco, cidade, estado, faturamento_anual, status) values (?,?,?,?,?,?)";
    $parametros = array($this->getNome(), $this->getEndereco(), $this->getCidade(), $this->getEstado(), $this->getFaturamentoAnual(), $this->getStatus());
    return $this->insertDB($sql, $parametros);
  }

  // Função para pesquisar filial por um atributo específico
  function pesquisaFilial($atributo, $valor)
  {
    $sql = "select * from filial where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'filial');
    if (!empty($dados)) {
      $this->setIdFilial($dados[0]->getIdFilial());
      $this->setNome($dados[0]->getNome());
      $this->setEndereco($dados[0]->getEndereco());
      $this->setCidade($dados[0]->getCidade());
      $this->setEstado($dados[0]->getEstado());
      $this->setFaturamentoAnual($dados[0]->getFaturamentoAnual());
      $this->setStatus($dados[0]->getStatus());
    }
  }

  // Função para atualizar os dados de uma filial
  function atualizar()
  {
    $sql = "update filial set nome =?, endereco =?, cidade =?, estado =?, faturamento_anual =?, status =? where id_filial =?";
    $parametros = array($this->getNome(), $this->getEndereco(), $this->getCidade(), $this->getEstado(), $this->getFaturamentoAnual(), $this->getStatus(), $this->getIdFilial());
    return $this->updateDB($sql, $parametros);
  }

  // Função para verificar se uma filial existe no banco de dados
  function existe($atributo, $valor)
  {
    $sql = "select * from filial where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'filial');
    if (empty($dados)) {
      return false;
    }
    return true;
  }

}

?>
