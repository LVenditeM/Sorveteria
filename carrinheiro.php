<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class Carrinheiro extends Database
{

  private $id_carrinheiro;
  private $fk_filial;
  private $nome;
  private $rg;
  private $cpf;
  private $foto_3x4;
  private $descricao;

  function __construct()
  {
  }

  // Getters e Setters

  public function getIdCarrinheiro()
  {
    return $this->id_carrinheiro;
  }

  public function setIdCarrinheiro($id_carrinheiro)
  {
    $this->id_carrinheiro = $id_carrinheiro;
  }

  public function getFK_Filial()
  {
    return $this->fk_filial;
  }

  public function setFK_Filial($fk_filial)
  {
    $this->fk_filial = $fk_filial;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getRg()
  {
    return $this->rg;
  }

  public function setRg($rg)
  {
    $this->rg = $rg;
  }

  public function getCpf()
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;
  }

  public function getFoto3x4()
  {
    return $this->foto_3x4;
  }

  public function setFoto3x4($foto_3x4)
  {
    $this->foto_3x4 = $foto_3x4;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  // Função para salvar no banco de dados
  function salvar()
  {
    $sql = "insert into carrinheiro (fk_filial, nome, rg, cpf, foto_3x4, descricao) values (?,?,?,?,?,?)";
    $parametros = array($this->getFK_Filial(), $this->getNome(), $this->getRg(), $this->getCpf(), $this->getFoto3x4(), $this->getDescricao());
    return $this->insertDB($sql, $parametros);
  }

  // Função para pesquisar carrinheiro por um atributo específico
  function pesquisaCarrinheiro($atributo, $valor)
  {
    $sql = "select * from carrinheiro where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'carrinheiro');
    if (!empty($dados)) {
      $this->setIdCarrinheiro($dados[0]->getIdCarrinheiro());
      $this->setFK_Filial($dados[0]->getFK_Filial());
      $this->setNome($dados[0]->getNome());
      $this->setRg($dados[0]->getRg());
      $this->setCpf($dados[0]->getCpf());
      $this->setFoto3x4($dados[0]->getFoto3x4());
      $this->setDescricao($dados[0]->getDescricao());
    }
  }

  // Função para atualizar os dados de um carrinheiro
  function atualizar()
  {
    $sql = "update carrinheiro set fk_filial =?, nome =?, rg =?, cpf =?, foto_3x4 =?, descricao =? where id_carrinheiro =?";
    $parametros = array($this->getFK_Filial(), $this->getNome(), $this->getRg(), $this->getCpf(), $this->getFoto3x4(), $this->getDescricao(), $this->getIdCarrinheiro());
    return $this->updateDB($sql, $parametros);
  }

  // Função para verificar se um carrinheiro existe no banco de dados
  function existe($atributo, $valor)
  {
    $sql = "select * from carrinheiro where " . $atributo . " = ?";
    $parametros = array($valor);
    $dados = $this->selectDB($sql, $parametros, 'carrinheiro');
    if (empty($dados)) {
      return false;
    }
    return true;
  }

}

?>
