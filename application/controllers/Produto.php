<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produto extends MY_Controller{
    /**
     * Pega os dados de produtos cadastrados na base antes de mostrar a página
     */
    function index(){
        $dados['produto'] = $this->pegaProdutos();
        // Passa os dados para a view
        $dados['titulo'] = 'Produto';
        $mensagem = $this->pegaDadoFlash('mensagem');
        $this->carregaView('produto/lista_produto', $dados, $mensagem);
    }

    /**
     * Método utilizado para pegar produtos
     */
    function pegaProdutos(){
        $this->load->database();
        $this->load->model('ProdutoModelo');
        $this->load->library('session');
        return $this->ProdutoModelo->buscarProdutos($this->session->idUsuario);
    }
    /**
     * Método utilizado para abrir a view de cadastro de produto
     */
    function novoProduto(){
        $this->load->database();
        $this->load->model('ProdutoModelo');
        $dados['produto'] = $this->ProdutoModelo;
        $dados['titulo'] = 'Formulário Produto';
        $this->carregaView('produto/form_produto', $dados);
    }

    /**
     * Método utilizado para abrir a view de edição de produto
     * @param $idProduto: id do produto para busca
     */
    function editarProduto($idProduto){
        //Carrega modelo e a base
        $this->load->database();
        $this->load->model('ProdutoModelo');
        // Pega todos os dados do produto
        $dados['produto'] = $this->ProdutoModelo->buscarProduto($idProduto);
        $dados['titulo'] = 'Formulário Produto';
        $this->carregaView('produto/form_produto', $dados);
    }
    /**
     * Método utilizado para cadastrar produtos
     */
    function gravarProduto($idProduto = 0){
        // Carrega a base de dados e o modelo, além da sessão para pegar o usuário
        $this->load->database();
        $this->load->model('ProdutoModelo');
        $this->load->library('session');


        // Verifica se é um produto não existente, se não é, insere, se já existe, atualiza
        if($idProduto == 0){
            $dados = array(
                'descricaoProduto' => $this->input->post('descricaoProduto'),
                'valorProduto' => $this->input->post('valorProduto'),
                'quantidadeProduto' => $this->input->post('quantidadeProduto'),
                'dataCadastro' => date('Y-m-d'),
                'idUsuario' => $this->getID()
            );
            $this->ProdutoModelo->dataCadastro = date('Y-m-d');
            //Insere no banco
            $this->ProdutoModelo->inserir($dados);
            //Manda para a tela sucesso
            $dado['titulo'] = 'Produto';
            $dado['produto'] = $this->pegaProdutos();
            $this->retornaSucesso('Registro cadastrado com sucesso!');
            redirect('produto');
        } else {
            //Atualiza no banco
            $dados = array(
                'descricaoProduto' => $this->input->post('descricaoProduto'),
                'valorProduto' => $this->input->post('valorProduto'),
                'quantidadeProduto' => $this->input->post('quantidadeProduto'),
                );
            $this->ProdutoModelo->atualizar($dados, $idProduto);
            // Manda para a tela sucesso
            $dado['titulo'] = 'Produto';
            $dado['produto'] = $this->pegaProdutos();
            $this->retornaSucesso('Registro alterado com sucesso!');
            redirect('produto');
        }

    }
    /**
     * Método utilizado para deletar o produto
     * @param $idProduto: id do produto a se deletar
     */
    function deletarProduto($idProduto = 0){
        $this->load->database();
        $this->load->library('session');
        $this->load->model('ProdutoModelo');
        $this->ProdutoModelo->deletar($idProduto);
        // Pega os outros produtos e volta
        $dado['titulo'] = 'Produto';
        $dado['produto'] = $this->pegaProdutos();
        $this->retornaSucesso('Registro deletado com sucesso!');
        redirect('produto');
    }
}