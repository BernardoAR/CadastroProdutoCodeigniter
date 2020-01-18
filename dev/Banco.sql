CREATE DATABASE IF NOT EXISTS Sistema;
USE Sistema;
-- Tabela Usuário
CREATE TABLE IF NOT EXISTS Usuario(
    idUsuario INT NOT NULL AUTO_INCREMENT,
    nomeUsuario VARCHAR(45) NOT NULL,
    nomeCompletoUsuario VARCHAR (45) NOT NULL,
    emailUsuario VARCHAR(45) NOT NULL,
    senhaUsuario CHAR(200) NOT NULL,
    PRIMARY KEY (idUsuario)
);
-- Tabela Produto
CREATE TABLE IF NOT EXISTS Produto(
    idProduto INT NOT NULL AUTO_INCREMENT,
    descricaoProduto VARCHAR(45) NOT NULL,
    valorProduto DECIMAL(7,2) NOT NULL,
    quantidadeProduto INT NOT NULL,
    dataCadastro DATE NOT NULL,
    idUsuario INT NOT NULL,
    PRIMARY KEY (idProduto)
);
-- Tabela BackupProduto
CREATE TABLE IF NOT EXISTS BackupProduto(
    idBackupProduto INT NOT NULL AUTO_INCREMENT,
    idUsuario INT,
    idProduto INT,
    quantidadeProduto INT NOT NULL,
    descricaoProduto VARCHAR(45) NOT NULL,
    valorProduto DECIMAL(7,2) NOT NULL,
    dataCadastro DATE NOT NULL,
    dataAtualizacao DATE NOT NULL,
    dataExclusao DATE,
    PRIMARY KEY (idBackupProduto)
);
-- FKs BackupProduto
ALTER TABLE BackupProduto
ADD CONSTRAINT fk_BackupProduto_idUsuario FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE BackupProduto
ADD CONSTRAINT fk_BackupProduto_idProduto FOREIGN KEY (idProduto) REFERENCES Produto(idProduto) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE Produto
ADD CONSTRAINT fk_Produto_idUsuario FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario) ON DELETE CASCADE ON UPDATE CASCADE;

-- Inserir usuário prévio
INSERT INTO Usuario
VALUES (NULL, 'sgt', 'SGT - Gestão & Tecnologia ', 'suporte@sgtgestaoetecnologia.com.br', 'b81b9b1a51870667c8b9019d16c46251e0058774f3b41c724ee17748c3752039936c245214a70b1f57dcf7e56a8c17230e162ccc26546e24b63ac9b9c9d47358Q+cHqBX6VE7WaxOSVqFjXfu/ONEQS0fbba3XwlC8YGY=');

-- TRIGGERS
DELIMITER $$
CREATE TRIGGER tgr_produto_after_insert AFTER INSERT
ON Produto
FOR EACH ROW
BEGIN
    INSERT INTO BackupProduto(idUsuario, idProduto, quantidadeProduto, descricaoProduto, valorProduto, dataCadastro, dataAtualizacao)
    VALUES(NEW.idUsuario, NEW.idProduto, NEW.quantidadeProduto, NEW.descricaoProduto, NEW.valorProduto, NEW.dataCadastro, NEW.dataCadastro);
END$$
CREATE TRIGGER tgr_produto_after_update AFTER UPDATE
ON Produto
FOR EACH ROW
BEGIN
    UPDATE BackupProduto
    SET quantidadeProduto = OLD.quantidadeProduto, descricaoProduto = OLD.descricaoProduto, valorProduto = OLD.valorProduto, dataAtualizacao = CURDATE()
        WHERE idProduto = OLD.idProduto;
END$$
CREATE TRIGGER tgr_produto_after_delete BEFORE DELETE
ON Produto
FOR EACH ROW
BEGIN
    UPDATE BackupProduto
    SET quantidadeProduto = OLD.quantidadeProduto, descricaoProduto = OLD.descricaoProduto, valorProduto = OLD.valorProduto, dataExclusao = CURDATE()
        WHERE idProduto = OLD.idProduto;
END$$
DELIMITER ;