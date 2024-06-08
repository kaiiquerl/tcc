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
	usuario VARCHAR (50),
	senha VARCHAR (40),
	tipo CHAR(1) DEFAULT 'U',
	PRIMARY KEY(usuario_id)
);

INSERT INTO tb_login(usuario, senha, tipo)
VALUES 
('admin'  , ('admin'), 'A'),
('usuario@local.com', SHA1('123'), 'U');

SELECT * FROM tb_login;

		 		 			          
