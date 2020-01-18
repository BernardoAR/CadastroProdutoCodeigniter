<?php
class ProdutoModelo extends CI_Model
{
    public $idProduto;
    public $imagemProduto;
    public $descricaoProduto;
    public $valorProduto;
    public $quantidadeProduto;
    public $dataCadastro;
    public $idUsuario;

    /**
     * Método utilizado para inserir no banco um novo usuário
     */
    function inserir($dados)
    {
        $this->db->insert('Produto', $dados);
    }

    /**
     * Método utilizado para atualizar dados de um determinado produto
     * @param $dados: dados para atualização
     * @param $idProduto: id do produto a alterar
     */
    function atualizar($dados, $idProduto)
    {
        $this->db->where('idProduto', $idProduto);
        $this->db->update('Produto', $dados);
    }
    /**
     * Método utilizado para deletar dados de um determinado produto
     * @param $idProduto: id do produto a deletar
     */
    function deletar($idProduto)
    {
        $this->db->where('idProduto', $idProduto);
        $this->db->delete('Produto');
    }
    /**
     * Método utilizado para buscar produtos no bancos, referente ao usuário
     */
    function buscarProdutos($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('Produto');
    }

    /**
     * Método utilizado para buscar um único produto, utilizado para edição
     * @param $idProduto: id do produto em questão
     */
    function buscarProduto($idProduto)
    {
        $this->db->where('idProduto', $idProduto);
        return $this->db->get('Produto')->row();
    }
}
