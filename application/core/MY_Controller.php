<?php

/**
 * Class MY_Controller: Classe genérica de controle, estilizada
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Se não estiver autorizado, volta para a página de login
        $this->load->library('session');
        if ((!$this->session->logado)) {
            redirect('Login');
        }
    }

    /**
     * Método utilizado para carregar a view, já com os pre-requisitos
     * @param $view: a view principal passada
     * @param int $dados: dados para passar na tela, caso necessário
     * @param $retorno: caso tenha sido retornado
     */

    public function carregaView($view, $dados = 0, $retorno = "")
    {
        $this->load->library('session');
        $dados['mensagem'] = $retorno;
        $dados['usuario'] = $this->session;
        $this->load->view('Template/cabecalho_sistema', $dados);
        $this->load->view('Template/menu');
        $this->load->view($view);
        $this->load->view('Template/rodape_sistema');
    }

    /**
     * Método utilizado para formatar a data vinda do banco, bastante utilizado em tabelas
     * @param string $formato: formato que irá terminar
     * @param null $dataRecebida: data que irá converter
     * @return false|string
     */
    public function formataData($formato = 'd-m-Y', $dataRecebida = null)
    {
        return date($formato, $dataRecebida);
    }
    /**
     * Método utilizado para pegar a id do usuário
     */
    function getID()
    {
        $this->load->library('session');
        return $this->session->idUsuario;
    }

    /**
     * Método utilizado para mandar uma mensagem de sucesso
     * @param $mensagem: mensagem de sucesso amigável
     */
    function retornaSucesso($mensagem = "Sucesso!")
    {
        $this->load->library('session');
        $this->session->set_flashdata('mensagem', '<div class="alert alert-success" role="alert" >' . $mensagem . '</div>');
    }

    /**
     * Método utilizado para mandar uma mensagem de erro
     * @param $mensagem: mensagem de erro amigável
     */
    function retornaErro($mensagem = "Erro")
    {
        $this->load->library('session');
        $this->session->set_flashdata('mensagem', '<div class="alert alert-danger" role="alert" >' . $mensagem . '</div>');
    }

    /**
     * Método utilizado para pegar o dado guardado após um redirect
     * @param $nome: nome do dado flash
     * @return mixed
     */
    function pegaDadoFlash($nome)
    {
        $this->load->library('session');
        return $this->session->flashdata($nome);
    }
}
