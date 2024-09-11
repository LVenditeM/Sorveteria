<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class Produto extends Database
{

  private $id_produto;
  private $nome;
  private $preco;
  private $status;



  function __construct()
  {
  }

  public function getIdProduto()
  {
    return $this->id_produto;
  }

  public function setIdProduto($id_produto)
  {
    $this->id_produto = $id_produto;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getPreco()
  {
    return $this->preco;
  }

  public function setPreco($preco)
  {
    $this->preco = $preco;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  function salvar()
  {
    $sql = "insert into produto (nome, preco, status) values (?,?,?)";
    $parametros = array($this->getNome(), $this->getPreco(), $this->getStatus());
    return $this->insertDB($sql, $parametros);
  }

  function pesquisaProduto($atributo, $valor)
  {
    $sql = "select * from produto where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'produto');
    if (!empty($dados)) {
      $this->setIdProduto($dados[0]->getIdProduto());
      $this->setNome($dados[0]->getNome());
      $this->setPreco($dados[0]->getPreco());
      $this->setStatus($dados[0]->getStatus());

    }
  }

  function atualizar()
  {
    $sql = "update produto set nome =?, preco =?, status =? where id_produto =?";
    $parametros = array($this->getNome(), $this->getPreco(), $this->getStatus(), $this->getIdProduto());
    return $this->updateDB($sql, $parametros);
  }

  function existe($atributo, $valor)
  {
    $sql = "select * from produto where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'produto');
    if (empty($dados)) {
      return false;
    }
    return true;
  }


}

?>