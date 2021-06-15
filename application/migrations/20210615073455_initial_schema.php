<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_initial_schema extends CI_Migration
{

  private function tableBackupProduto()
  {
    $this->dbforge->add_field(array(
      'idBackupProduto' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'descricaoProduto' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'valorProduto' => array(
        'type' => 'DECIMAL',
        'constraint' => '7,2',
      ),
      'quantidadeProduto' => array(
        'type' => 'INT',
      ),
      'dataCadastro' => array(
        'type' => 'DATE',
      ),
      'dataAtualizacao' => array(
        'type' => 'DATE',
      ),
      'dataExclusao' => array(
        'type' => 'DATE',
      ),
      'idUsuario' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'null', TRUE
      ),
      'idProduto' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'null', TRUE
      ),
    ));
    $this->dbforge->add_key('idBackupProduto', TRUE);
    $this->dbforge->create_table('BackupProduto');
  }
  private function tableProduto()
  {
    $this->dbforge->add_field(array(
      'idProduto' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'descricaoProduto' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'valorProduto' => array(
        'type' => 'DECIMAL',
        'constraint' => '7,2',
      ),
      'quantidadeProduto' => array(
        'type' => 'INT',
      ),
      'dataCadastro' => array(
        'type' => 'DATE',
      ),
      'idUsuario' => array(
        'type' => 'INT',
        'unsigned' => TRUE
      ),
      'CONSTRAINT fk_Produto_idUsuario FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE'
    ));
    $this->dbforge->add_key('idProduto', TRUE);
    $this->dbforge->create_table('Produto');
  }
  private function tableUsuario()
  {
    $this->dbforge->add_field(array(
      'idUsuario' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'nomeUsuario' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'nomeCompletoUsuario' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'emailUsuario' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'senhaUsuario' => array(
        'type' => 'CHAR',
        'constraint' => '200',
      ),
    ));
    $this->dbforge->add_key('idUsuario', TRUE);
    $this->dbforge->create_table('Usuario');
  }
  private function triggers()
  {
    // Triggers
    $this->db->query("
      CREATE TRIGGER tgr_produto_after_insert AFTER INSERT
      ON Produto
      FOR EACH ROW
      BEGIN
          INSERT INTO BackupProduto(idUsuario, idProduto, quantidadeProduto, descricaoProduto, valorProduto, dataCadastro, dataAtualizacao)
          VALUES(NEW.idUsuario, NEW.idProduto, NEW.quantidadeProduto, NEW.descricaoProduto, NEW.valorProduto, NEW.dataCadastro, NEW.dataCadastro);
      END
      ");
    $this->db->query("
      CREATE TRIGGER tgr_produto_after_update AFTER UPDATE
      ON Produto
      FOR EACH ROW
      BEGIN
          UPDATE BackupProduto
          SET quantidadeProduto = OLD.quantidadeProduto, descricaoProduto = OLD.descricaoProduto, valorProduto = OLD.valorProduto, dataAtualizacao = CURDATE()
              WHERE idProduto = OLD.idProduto;
      END
      ");
    $this->db->query("
      CREATE TRIGGER tgr_produto_after_delete BEFORE DELETE
      ON Produto
      FOR EACH ROW
      BEGIN
          UPDATE BackupProduto
          SET quantidadeProduto = OLD.quantidadeProduto, descricaoProduto = OLD.descricaoProduto, valorProduto = OLD.valorProduto, dataExclusao = CURDATE()
              WHERE idProduto = OLD.idProduto;
      END
      ");
  }
  public function up()
  {
    $this->tableUsuario();
    $this->tableProduto();
    $this->tableBackupProduto();
    $this->triggers();
  }

  public function down()
  {
    $this->dbforge->drop_table('BackupProduto');
    $this->dbforge->drop_table('Produto');
    $this->dbforge->drop_table('Usuario');
  }
}
