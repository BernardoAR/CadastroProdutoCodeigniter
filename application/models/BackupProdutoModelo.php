<?php

/**
 * Class BackupProdutoModelo: Classe de somente leitura, utilizado para ver versão anterior dos produtos cadastrados
 */
class BackupProdutoModelo extends CI_Model
{
    public $idBackupProduto;
    public $idUsuario;
    public $idProduto;
    public $quantidadeProduto;
    public $descricaoProduto;
    public $valorProduto;
    public $dataCadastro;
    public $dataAtualizacao;
    public $dataExclusao;

    /**
     * Método utilizado para buscar backup dos produtos no banco, referente ao usuário
     */
    function buscarProdutos($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('BackupProduto');
    }
}
