<?php
    class UsuarioModelo extends CI_Model{
        public $idUsuario;
        public $nomeUsuario;
        public $nomeCompletoUsuario;
        public $emailUsuario;
        public $senhaUsuario;

        /**
         * Método utilizado para inserir no banco um novo usuário
         */
        function inserir(){
            $this->db->insert('usuario', $this);
        }

        /**
         * Método utilizado para atualizar dados de um determinado usuário
         */
        function atualizar($dados, $idUsuario){
            $this->db->where('idUsuario', $idUsuario);
            $this->db->update('usuario', $dados);
        }

        /**
         * Método utilizado para deletar uma conta de usuário
         * @param $idUsuario: id que irá deletar
         */
        function deletar($idUsuario){
            $this->db->where('idUsuario', $idUsuario);
            $this->db->delete('usuario');
        }

        /**
         * Método utilizado para buscar os dados do usuário atual
         */
        function buscaUsuarioAtual($idUsuario){
            $this->db->where('idUsuario', $idUsuario);
            $query = $this->db->get('usuario')->row();
            return $query;
        }
        /**
         * Método utilizado para a autenticação
         * @param $nomeUsuario: Nome do usuário
         * @param $senhaUsuario: Senha do usuário
         * @return a linha com o usuário
         */
        function buscaUsuario($nomeUsuario, $senhaUsuario){
            //Pega o decrypter
            $this->load->library('encryption');
            // Verifica se existe o nome de usuário
            $this->db->where('nomeUsuario', $nomeUsuario);
            //Pega o resultado em questão
            $query = $this->db->get('usuario')->row();
            //Se não estiver vazio o resultado, e o resultado for verdadeiro
            if(!empty($query)){
                if($this->encryption->decrypt($query->senhaUsuario) == $senhaUsuario){
                    return $query;
                }
            }
            return null;
        }

        /**
         * Método utilizado para verificar a senha, em relação ao usuário
         * @param $idUsuario: id do usuário
         * @param $senhaUsuario: senha do usuário
         * @return a linha do usuário com o valor
         */
        function verificaSenha($senhaUsuario, $idUsuario){
            //Pega o decrypter
            $this->load->library('encryption');
            //Query resulta na linha do id do usuario
            $this->db->where('idUsuario', $idUsuario);
            $query = $this->db->get('usuario')->row();
            if($this->encryption->decrypt($query->senhaUsuario) == $senhaUsuario){
                return false;
            } else {
                return true;
            }

        }

        /**
         * Método utilizado para verificação de email
         * @param $emailUsuario: email passado para a verificação
         * @return bool
         */
        function emailExistente($emailUsuario, $idUsuario = ""){
            // Query para verificar a existencia do email
            $this->db->where('emailUsuario', $emailUsuario);
            $query = $this->db->get('usuario')->row();
            //Se tiver e não ser o do mesmo usuário, retorna que já existe, se não, retorna falso
            if(($query) and ($query->idUsuario != $idUsuario)){
                return true;
            } else {
                return false;
            }

        }

        /**
         * Método utilizado para verificação de nome de usuário
         * @param $nomeUsuario: nome de usuário passado para verificação
         * @return bool
         */
        function nomeUsuarioExistente($nomeUsuario, $idUsuario = 0){
            // Query para verificar a existencia do email
            $this->db->where('nomeUsuario', $nomeUsuario);
            $query = $this->db->get('usuario')->row();
            //Se tiver e não ser o do mesmo usuário, retorna que já existe, se não, retorna falso
            if(($query) and ($query->idUsuario != $idUsuario)){
                return true;
            } else {
                return false;
            }
        }
    }

