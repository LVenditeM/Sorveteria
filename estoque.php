<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class Estoque extends Database
{

  private $id_estoque;
  private $fk_filial;
  private $fk_produto;
  private $quantidade;

  function __construct()
  {
  }

  // Getters e Setters

  public function getIdEstoque()
  {
    return $this->id_estoque;
  }

  public function setIdEstoque($id_estoque)
  {
    $this->id_estoque = $id_estoque;
  }

  public function getFK_Filial()
  {
    return $this->fk_filial;
  }

  public function setFK_Filial($fk_filial)
  {
    $this->fk_filial = $fk_filial;
  }

  public function getFK_Produto()
  {
    return $this->fk_produto;
  }

  public function setFK_Produto($fk_produto)
  {
    $this->fk_produto = $fk_produto;
  }

  public function getQuantidade()
  {
    return $this->quantidade;
  }

  public function setQuantidade($quantidade)
  {
    $this->quantidade = $quantidade;
  }

  // Função para salvar no banco de dados
  function salvar()
  {
    $sql = "insert into estoque (fk_filial, fk_produto, quantidade) values (?,?,?)";
    $parametros = array($this->getFK_Filial(), $this->getFK_Produto(), $this->getQuantidade());
    return $this->insertDB($sql, $parametros);
  }

  // Função para pesquisar estoque por um atributo específico
  function pesquisaEstoque($atributo, $valor)
  {
    $sql = "select * from estoque where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'estoque');
    if (!empty($dados)) {
      $this->setIdEstoque($dados[0]->getIdEstoque());
      $this->setFK_Filial($dados[0]->getFK_Filial());
      $this->setFK_Produto($dados[0]->getFK_Produto());
      $this->setQuantidade($dados[0]->getQuantidade());
    }
  }

  // Função para atualizar os dados do estoque
  function atualizar()
  {
    $sql = "update estoque set fk_filial =?, fk_produto =?, quantidade =? where id_estoque =?";
    $parametros = array($this->getFK_Filial(), $this->getFK_Produto(), $this->getQuantidade(), $this->getIdEstoque());
    return $this->updateDB($sql, $parametros);
  }

  // Função para verificar se um registro de estoque existe no banco de dados
  function existe($atributo, $valor)
  {
    $sql = "select * from estoque where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'estoque');
    if (empty($dados)) {
      return false;
    }
    return true;
  }

}

?>
