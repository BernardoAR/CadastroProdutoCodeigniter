<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sistema extends MY_Controller
{

        public function index()
        {
                $dados['titulo'] = 'Início';
                $dados['usuario'] = $this->session;
                $mensagem = $this->pegaDadoFlash('mensagem');
                $this->carregaView('Sistema/home', $dados, $mensagem);
        }
}
