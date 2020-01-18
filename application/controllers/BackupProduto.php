<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BackupProduto extends MY_Controller{
    function index(){
        $this->load->database();
        $this->load->model('BackupProdutoModelo');
        $this->load->library('session');
        $dados['produto'] = $this->BackupProdutoModelo->buscarProdutos($this->getID());

        // Passa os dados para a view
        $dados['titulo'] = 'Backup do Produto';
        $this->carregaView('backupproduto/lista_backup_produto', $dados);
    }
}