<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function index()
    {
        // Controle de sites no login
        $this->load->library('session');
        if ($this->session->logado) {
            redirect('Sistema');
        } else {
            //Carrega o template junto da view
            $dados['titulo'] = 'Login';
            $mensagem = $this->pegaDadoFlash('mensagem');
            $this->carregaView('Login/form_login', $dados, $mensagem);
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
        $this->load->view('Template/cabecalho_login', $dados);
        echo $retorno;
        $this->load->view($view);
        $this->load->view('Template/rodape_login');
    }
    /**
     * Carrega página de cadastro
     **/
    function novoUsuario()
    {
        $dados['titulo'] = 'Cadastro';
        $this->carregaView('Login/form_cadastro', $dados);
    }

    /**
     * Método utilizado para autenticar usuário
     */
    function autenticar()
    {
        // Carrega as partes pendentes
        $this->load->database();
        $this->load->model('UsuarioModelo');

        $nome = $this->input->post('nomeUsuario');
        $senha = $this->input->post('senhaUsuario');

        // Consulta no banco o usuario
        $usuario = $this->UsuarioModelo->buscaUsuario($nome, $senha);

        //Se retornar, existe, logo loga o usuário
        if ($usuario) {

            $this->load->library('session');
            $this->session->set_userdata('logado', true);

            $dados = array(
                'idUsuario' => $usuario->idUsuario,
                'nomeCompleto' => $usuario->nomeCompletoUsuario
            );
            $this->session->set_userdata($dados);
            //Tela inicial do sistema
            redirect('Sistema');
        } else {
            $this->retornaErro('Login falhou, Email ou Senha incorretos!');
            redirect('Login');
        }
    }

    /**
     * Regras de entrada
     */
    function regrasInput()
    {
        // Library de validação
        $this->load->library('form_validation');

        //Formulário de validação
        $this->form_validation->set_rules('emailUsuario', 'emailUsuario', 'trim|required|callback_validarEmail');
        $this->form_validation->set_rules('nomeUsuario', 'nomeUsuario', 'trim|required|callback_validarNomeUsuario');
        $this->form_validation->set_rules('senhaUsuario', 'senhaUsuario', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confSenha', 'confSenha', 'trim|required|min_length[6]|matches[senhaUsuario]');
    }
    /**
     * Cadastrar usuário no BD
     **/
    function cadastrarUsuario()
    {
        $this->regrasInput();
        // Conectar Banco
        $this->load->database();
        // Carregar Modelo
        $this->load->model('UsuarioModelo');
        // Pegar informações da tela

        if ($this->form_validation->run() == true) {
            $this->UsuarioModelo->nomeUsuario = $this->input->post('nomeUsuario');
            $this->UsuarioModelo->emailUsuario =  $this->input->post('emailUsuario');
            $this->UsuarioModelo->nomeCompletoUsuario = $this->input->post('nomeCompletoUsuario');

            //Encriptar senha
            $this->load->library('encryption');
            $senha = $this->encryption->encrypt($this->input->post('senhaUsuario'));
            $this->UsuarioModelo->senhaUsuario = $senha;

            // Gravar
            $this->UsuarioModelo->inserir();

            // Redirecionar para login
            $this->retornaSucesso('Cadastro efetuado com sucesso!');
            redirect('Login');
        } else {
            $erros = validation_errors();
            $this->retornaErro($erros);
            redirect('Login');
        }
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
    /**
     * Método para validar nome de usuário, se já existente
     * @param $nomeUsuario: nome para verificação
     * @return bool
     */
    function validarNomeUsuario()
    {
        // Pega o retorno
        $nomeUsuarioExistente = $this->UsuarioModelo->nomeUsuarioExistente($this->input->post('nomeUsuario'));
        if ($nomeUsuarioExistente) {
            $this->form_validation->set_message('validarNomeUsuario', 'Nome de usuário já existente!');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Método utilizado para validar email de usuário, se já existente
     * @param $email: email para verificação
     * @return bool
     */
    function validarEmail()
    {
        // Pega o retorno
        $emailExistente = $this->UsuarioModelo->emailExistente($this->input->post('emailUsuario'));

        // Mandar mensagem para a tela, sobre o erro ocorrido
        if ($emailExistente) {
            $this->form_validation->set_message('validarEmail', 'Endereço de email já existente!');
            return false;
        } else {
            return true;
        }
    }
    /**
     * Função para deslogar do sistema
     */
    function deslogar()
    {
        //Destrói a função, depois redireciona
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect();
    }
}
