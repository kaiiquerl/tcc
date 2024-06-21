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
('admin',('admin'), 'A'),
('usuario',('usuario'), 'U');

INSERT INTO tb_item(codigo_patrimonio, descricao, bloco, sala, observacao) VALUES
-- LAB 1
('8293510','cadeira','A','LAB 1','riscada'),
('2947624','CPU','A','LAB 1','funcionando parcialmente'),
('6754832','monitor','A','LAB 1','tela queimada'),
('8254763','teclado','A','LAB 1','teclas faltando'),
('3847625','mouse','A','LAB 1','botão quebrado'),
('9548266','tv','A','LAB 1','imagem distorcida'),
('1239487','projetor','A','LAB 1','lâmpada fraca'),
('6375850','cadeira','A','LAB 1','perna quebrada'),
('4958373','CPU','A','LAB 1','quebrado'),
('7491024','monitor','A','LAB 1','sem imagem'),

('3829476','teclado','B','LAB 1','teclas soltas'),
('1958473','mouse','B','LAB 1','funcionando'),
('5847262','tv','B','LAB 1','sem som'),
('9384752','projetor','B','LAB 1','sem foco'),
('8273646','cadeira','B','LAB 1','apoio quebrado'),
('5837295','CPU','B','LAB 1','memória insuficiente'),
('2039476','monitor','B','LAB 1','tela riscada'),
('9584764','teclado','B','LAB 1','teclas gastas'),
('7582935','mouse','B','LAB 1','sensor defeituoso'),
('4048376','tv','B','LAB 1','quebrada'),

('8374652','projetor','C','LAB 1','sem cor'),
('4857264','cadeira','C','LAB 1','braço solto'),
('2039486','CPU','C','LAB 1','superaquecendo'),
('9583747','monitor','C','LAB 1','piscando'),
('5847264','teclado','C','LAB 1','teclas travando'),
('2048372','mouse','C','LAB 1','roda danificada'),
('8475264','tv','C','LAB 1','tela quebrada'),
('7482935','projetor','C','LAB 1','não liga'),
('2039487','cadeira','C','LAB 1','encosto rachado'),
('9583748','CPU','C','LAB 1','lento'),

-- LAB 2
('4857265','monitor','A','LAB 2','desligando sozinho'),
('8475265','teclado','A','LAB 2','desgaste nas teclas'),
('7482936','mouse','A','LAB 2','botões duros'),
('2048373','tv','A','LAB 2','imagem em preto e branco'),
('8374653','projetor','A','LAB 2','imagem embaçada'),
('4857266','cadeira','A','LAB 2','desgastada'),
('2039488','CPU','A','LAB 2','reboot contínuo'),
('9583749','monitor','A','LAB 2','cores invertidas'),
('5847265','teclado','A','LAB 2','teclas quebradas'),
('2048374','mouse','A','LAB 2','sem clique'),

('8475266','tv','B','LAB 2','tela riscada'),
('7482937','projetor','B','LAB 2','sem áudio'),
('2048375','cadeira','B','LAB 2','manchas'),
('8374654','CPU','B','LAB 2','ruído alto'),
('4857267','monitor','B','LAB 2','baixo brilho'),
('8475267','teclado','B','LAB 2','teclas falhando'),
('7482938','mouse','B','LAB 2','movimento irregular'),
('2048376','tv','B','LAB 2','quebrada'),
('8374655','projetor','B','LAB 2','foco ruim'),
('4857268','cadeira','B','LAB 2','apoio danificado'),

('2039489','CPU','C','LAB 2','ventoinha barulhenta'),
('9583750','monitor','C','LAB 2','sem cor'),
('5847266','teclado','C','LAB 2','sem resposta'),
('2048377','mouse','C','LAB 2','funcionando parcialmente'),
('8475268','tv','C','LAB 2','imagem tremida'),
('7482939','projetor','C','LAB 2','resolução baixa'),
('2048378','cadeira','C','LAB 2','frouxa'),
('8374656','CPU','C','LAB 2','não inicializa'),
('4857269','monitor','C','LAB 2','tela riscada'),
('8475269','teclado','C','LAB 2','layout errado'),

-- LAB 3
('7482940','mouse','A','LAB 3','conector quebrado'),
('2048379','tv','A','LAB 3','imagem dupla'),
('8374657','projetor','A','LAB 3','lâmpada queimada'),
('4857270','cadeira','A','LAB 3','roda quebrada'),
('2039490','CPU','A','LAB 3','HD danificado'),
('9583751','monitor','A','LAB 3','sem energia'),
('5847267','teclado','A','LAB 3','tecla faltando'),
('2048380','mouse','A','LAB 3','botão emperrado'),
('8475270','tv','A','LAB 3','volume baixo'),
('7482941','projetor','A','LAB 3','imagem fraca'),

('2048381','cadeira','B','LAB 3','sem estofamento'),
('8374658','CPU','B','LAB 3','memória danificada'),
('4857271','monitor','B','LAB 3','riscos profundos'),
('8475271','teclado','B','LAB 3','teclas desconfiguradas'),
('7482942','mouse','B','LAB 3','botão duplo'),
('2048382','tv','B','LAB 3','sem brilho'),
('8374659','projetor','B','LAB 3','sem iluminação'),
('4857272','cadeira','B','LAB 3','sem rodízio'),
('2039491','CPU','B','LAB 3','sem sistema operacional'),
('9583752','monitor','B','LAB 3','pixels mortos'),

('5847268','teclado','C','LAB 3','conector solto'),
('2048383','mouse','C','LAB 3','cabo danificado'),
('8475272','tv','C','LAB 3','sem som'),
('7482943','projetor','C','LAB 3','não projeta'),
('2048384','cadeira','C','LAB 3','estrutura solta'),
('8374660','CPU','C','LAB 3','placa-mãe com defeito'),
('4857273','monitor','C','LAB 3','listras na tela'),
('8475273','teclado','C','LAB 3','não funciona'),
('7482944','mouse','C','LAB 3','sensor sujo'),
('2048385','tv','C','LAB 3','tela azul');

SELECT * FROM tb_item;
SELECT * FROM tb_login;

