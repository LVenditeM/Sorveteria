<?php
require_once(ABSPATH . 'config.php');
require_once DBAPI;

class ProdutoVenda extends Database
{

    private $id_produto_venda;
    private $fk_produto;
    private $fk_venda;
    private $quantidade_entrada;
    private $quantidade_saida;

    function __construct()
    {
    }

    // Getters e Setters

    public function getIdProdutoVenda()
    {
        return $this->id_produto_venda;
    }

    public function setIdProdutoVenda($id_produto_venda)
    {
        $this->id_produto_venda = $id_produto_venda;
    }

    public function getFK_Produto()
    {
        return $this->fk_produto;
    }

    public function setFK_Produto($fk_produto)
    {
        $this->fk_produto = $fk_produto;
    }

    public function getFK_Venda()
    {
        return $this->fk_venda;
    }

    public function setFK_Venda($fk_venda)
    {
        $this->fk_venda = $fk_venda;
    }

    public function getQuantidadeEntrada()
    {
        return $this->quantidade_entrada;
    }

    public function setQuantidadeEntrada($quantidade_entrada)
    {
        $this->quantidade_entrada = $quantidade_entrada;
    }

    public function getQuantidadeSaida()
    {
        return $this->quantidade_saida;
    }

    public function setQuantidadeSaida($quantidade_saida)
    {
        $this->quantidade_saida = $quantidade_saida;
    }

    // Função para salvar no banco de dados
    function salvar()
    {
        $sql = "insert into produto_venda (fk_produto, fk_venda, quantidade_entrada, quantidade_saida) values (?,?,?,?)";
        $parametros = array($this->getFK_Produto(), $this->getFK_Venda(), $this->getQuantidadeEntrada(), $this->getQuantidadeSaida());
        return $this->insertDB($sql, $parametros);
    }

    // Função para pesquisar produto_venda por um atributo específico
    function pesquisaProdutoVenda($atributo, $valor)
    {
        $sql = "select * from produto_venda where " . $atributo . " = ?";
        $parametros = array($valor);
        $dados = $this->selectDB($sql, $parametros, 'produto_venda');

        if (!empty($dados)) {
            $this->setIdProdutoVenda($dados[0]->getIdProdutoVenda());
            $this->setFK_Produto($dados[0]->getFK_Produto());
            $this->setFK_Venda($dados[0]->getFK_Venda());
            $this->setQuantidadeEntrada($dados[0]->getQuantidadeEntrada());
            $this->setQuantidadeSaida($dados[0]->getQuantidadeSaida());
        }
    }

    // Função para atualizar os dados de um produto_venda
    function atualizar()
    {
        $sql = "update produto_venda set fk_produto =?, fk_venda =?, quantidade_entrada =?, quantidade_saida =? where id_produto_venda =?";
        $parametros = array($this->getFK_Produto(), $this->getFK_Venda(), $this->getQuantidadeEntrada(), $this->getQuantidadeSaida(), $this->getIdProdutoVenda());
        return $this->updateDB($sql, $parametros);
    }

    // Função para verificar se um produto_venda existe no banco de dados
    function existe($atributo, $valor)
    {
        $sql = "select * from produto_venda where " . $atributo . " = ?";
        $parametros = array($valor);
        $dados = $this->selectDB($sql, $parametros, 'produto_venda');
        if (empty($dados)) {
            return false;
        }
        return true;
    }
}

?>
