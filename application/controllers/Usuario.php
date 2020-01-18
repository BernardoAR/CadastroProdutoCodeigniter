<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Usuario extends MY_Controller
{
    /**
     * Método que carrega a view de dados do usuário
     */
    function index()
    {
        // Dados do perfil do usuario, manda para a view
        $dados['dadosUsuario'] = $this->pegaDadosUsuario();
        $dados['titulo'] = 'Formulário de Usuário';
        $mensagem = $this->pegaDadoFlash('mensagem');
        $this->carregaView('Usuario/form_usuario', $dados, $mensagem);
    }

    /**
     * Método utilizado para retornar o dado do Usuário
     * @return mixed
     */
    function pegaDadosUsuario()
    {
        $this->load->database();
        $this->load->model('UsuarioModelo');
        return $this->UsuarioModelo->buscaUsuarioAtual($this->getID());
    }

    /**
     * Método que possui as regras de entrada
     */
    function regrasInput()
    {
        // Library de validação
        $this->load->library('form_validation');

        //Validação de formulário
        $this->form_validation->set_rules('emailUsuario', 'Email', 'trim|required|callback_validarEmail');
        $this->form_validation->set_rules('nomeUsuario', 'Nome de Usuário', 'trim|required|callback_validarNomeUsuario');
        $this->form_validation->set_rules('senhaAtual', 'Senha Atual', 'trim|required|min_length[6]|callback_validarSenha');
        $this->form_validation->set_rules('novaSenha', 'Nova Senha', 'trim|min_length[6]');
    }
    /**
     * Método utilizado para atualizar os dados do usuário no banco
     */
    function atualizarUsuario()
    {
        //Coloca as regras de entrada
        $this->regrasInput();
        // Carrega a base de dados e o modelo
        $this->load->database();
        $this->load->model('UsuarioModelo');


        // Se a verificação retornar valor, atualiza os dados do usuário
        if ($this->form_validation->run() == true) {
            $novaSenha = $this->input->post('novaSenha');
            //Atualiza os Dados
            if (!empty($novaSenha)) {
                $dados = array(
                    'nomeCompletoUsuario' => $this->input->post('nomeCompletoUsuario'),
                    'nomeUsuario' => $this->input->post('nomeUsuario'),
                    'emailUsuario' => $this->input->post('emailUsuario'),
                    'senhaUsuario' => $this->encryption->encrypt($novaSenha)
                );
            } else {
                $dados = array(
                    'nomeCompletoUsuario' => $this->input->post('nomeCompletoUsuario'),
                    'nomeUsuario' => $this->input->post('nomeUsuario'),
                    'emailUsuario' => $this->input->post('emailUsuario'),
                );
            }
            $this->UsuarioModelo->atualizar($dados, $this->getID());
            //Atualiza os dados da sessão
            $this->atualizaDadosSessao();
            //Volta para a page
            $dado['titulo'] = 'Início';
            $dado['usuario'] = $this->session;
            $this->retornaSucesso('Registros alterados com sucesso');
            redirect('Sistema');
        } else {
            $dado['usuario'] = $this->pegaDadosUsuario();
            $dado['titulo'] = 'Formulário de Usuário';
            $erros = validation_errors();
            $this->retornaErro($erros);
            redirect('Usuario');
        }
    }

    /**
     * Método utilizado para tualizar os dados da sessão
     */
    function atualizaDadosSessao()
    {
        // Pega os dados completos, mas só retorna os principais, na sessão
        $this->load->library('session');
        $dados = $this->pegaDadosUsuario();
        $sessao = array(
            'idUsuario' => $dados->idUsuario,
            'nomeCompleto' => $dados->nomeCompletoUsuario
        );
        $this->session->set_userdata($sessao);
    }
    /**
     * Método utilizado para a view de deletar conta do usuário
     */
    function excluirConta()
    {
        $dados['titulo'] = 'Deletar Conta';
        $this->carregaView('Usuario/deletar_usuario', $dados);
    }
    /**
     *  Método utilizado para deletar a conta
     */
    function deletarUsuario()
    {
        // Library de validação
        $this->load->library('form_validation');
        //Validação de formulário
        $this->form_validation->set_rules('senhaAtual', 'senhaUsuario', 'trim|required|callback_validarSenha');

        //Carrega a sessão, os dados e o modelo;
        $this->load->database();
        $this->load->model('UsuarioModelo');

        // Se a verificação retornar valor, deleta o usuário
        if ($this->form_validation->run() == true) {
            $this->session->sess_destroy();
            $this->UsuarioModelo->deletar($this->getID());
            redirect('Login');
        } else {
            $dado['usuario'] = $this->pegaDadosUsuario();
            $dado['titulo'] = 'Deletar Conta';
            $erros = validation_errors();
            $this->retornaErro($erros);
            redirect('Usuario');
        }
    }

    /**
     * Método utilizado para validar nome de usuário, se já existente
     * @param $nomeUsuario: nome para verificação
     * @return bool
     */
    function validarNomeUsuario($nomeUsuario)
    {
        // Pega o retorno
        $nomeUsuarioExistente = $this->UsuarioModelo->nomeUsuarioExistente($nomeUsuario, $this->getID());
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
    function validarEmail($email)
    {
        // Pega o retorno
        $emailExistente = $this->UsuarioModelo->emailExistente($email, $this->getID());

        // Mandar mensagem para a tela, sobre o erro ocorrido
        if ($emailExistente) {
            $this->form_validation->set_message('validarEmail', 'Endereço de email já existente!');
            return false;
        } else {
            return true;
        }
    }


    /**
     * Método utilizado para validar senha
     * @param $senha: senha atual para verificação
     * @return bool
     */
    function validarSenha($senha)
    {
        // Pega o retorno
        $senhaIncorreta = $this->UsuarioModelo->verificaSenha($senha, $this->getID());

        // Mandar mensagem para a tela, sobre o erro ocorrido
        if ($senhaIncorreta) {
            $this->form_validation->set_message('validarSenha', 'Senha atual incorreta!');
            return false;
        } else {
            return true;
        }
    }
}
