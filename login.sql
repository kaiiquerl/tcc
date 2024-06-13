DROP DATABASE if EXISTS inventario;
CREATE DATABASE inventario;
USE inventario;

CREATE TABLE tb_item (
	codigo_patrimonio INT NOT NULL,
	descricao  VARCHAR(30),
	bloco  VARCHAR(30),
	sala VARCHAR(30),
	observacao VARCHAR(255),
	PRIMARY KEY(codigo_patrimonio)
);

CREATE TABLE tb_login(
	usuario_id INT NOT NULL AUTO_INCREMENT,
	usuario VARCHAR(50) NOT NULL,
	senha VARCHAR(40) NOT NULL,
	tipo CHAR(1) DEFAULT 'U',
	PRIMARY KEY(usuario_id)
);

ALTER TABLE tb_login 
MODIFY usuario VARCHAR(50) NOT NULL,
MODIFY senha VARCHAR(40) NOT NULL,
ADD CONSTRAINT CHK_usuario CHECK (usuario != ''),
ADD CONSTRAINT CHK_senha CHECK (senha != '');

INSERT INTO tb_login(usuario, senha, tipo)
VALUES 
('admin', SHA1('admin'), 'A'),
('usuario@local.com', SHA1('123'), 'U');

INSERT INTO tb_item(codigo_patrimonio,descricao,bloco,sala ,observacao) VALUES
('1346141','pc','B','LAB 3','ok');

SELECT * FROM tb_item;
SELECT * FROM tb_login;

