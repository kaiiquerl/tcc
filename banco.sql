DROP DATABASE IF EXISTS bd3;
CREATE DATABASE bd3;
USE bd3;

SET @numero = -1;

SELECT CASE @numero
       WHEN 1 THEN 'Um'
		 WHEN 2 THEN 'Dois'
		 WHEN 3 THEN 'Três'
		 WHEN 4 THEN 'Quatro'
		 WHEN 5 THEN 'Cinco'
		 ELSE 'Menor/Maior'
END; 

SELECT IF (@numero>5, 
        CONCAT( 'O número: ', @numero, 'é maior ou igual a 5',
        CONCAT( 'O número: ', @numero, 'é menor que 5')) AS res;
        
SET @variavel = NULL;
-- FALSE ou 0
SELECT IF (IFNULL(@variavel, 1) = FALSE, 
         'Variável nula'
          'Variável não nula');
          
CREATE TABLE produtos(
id   INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(60) NOT NULL,
qtde INT,
valor DECIMAL(10,2),
PRIMARY KEY(id)
); 

INSERT INTO produtos (nome, qtde, valor)
VALUES ('Tenis'    , 20 ,  200),
       ('Bota '    , 15 ,  300),
		 ('Sapato'   , NULL ,  150),
		 ('Sandália' , 50 ,  180),
		 ('Chinelo'  , 100,   NULL),         
			 
SELECT id, nome, 
       IFNULL(qtde , 0)    AS qtde,
		 IFNULL(valor, 0)    AS valor,
		 IFNULL(SUM(qtde*valor), 0)  AS total		 
FROM produtos;		 
		 		 

SELECT AVG(qtde*valor) AS `média` FROM produtos;
SELECT SUM(qtde) AS qtde_produtos FROM produtos;

SET @maiorvalor = 0;
SET @_id = 0;
SET @_nome = '';
SELECT nome INTO @_id 

FROM produtos 
WHERE valor = @maiorvalor;       
 

SELECT @maiorvalor;
SELECT @_id;
SELECT @_nome;

SELECT MIN(valor) AS menor_valor FROM produtos;


SELECT MAX(valor) AS maior_valor  FROM produtos;
SELECT MAX(valor) AS menor_valor  FROM produtos;




		 		 			          