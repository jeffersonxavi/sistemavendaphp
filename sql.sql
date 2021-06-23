CREATE TABLE cliente(
	idcliente SERIAL PRIMARY KEY NOT NULL,
	nome VARCHAR(40),
	cpf VARCHAR(13),
	idade INTEGER
);

CREATE TABLE produto(
	idproduto SERIAL PRIMARY KEY NOT NULL,
	nome VARCHAR(60),
	valor DECIMAL(7,2),
	quantidade INTEGER
);

CREATE TABLE venda(
	idvenda SERIAL PRIMARY KEY NOT NULL,
	idcliente INTEGER,
	valortotal DECIMAL(7,2),
	FOREIGN KEY (idcliente) REFERENCES cliente(idcliente)
);

CREATE TABLE itensvenda(
	iditensvenda SERIAL PRIMARY KEY NOT NULL,
	idvenda INTEGER,
	idproduto INTEGER,
	quantidade DECIMAL(7,2),
	valorunitario DECIMAL(7,2),
	FOREIGN KEY (idvenda) REFERENCES venda(idvenda),
	FOREIGN KEY (idproduto) REFERENCES produto(idproduto)
);


CREATE OR REPLACE FUNCTION ADICIONAR_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
	UPDATE venda SET valortotal = valortotal + (NEW.quantidade * NEW.valorunitario) WHERE idvenda = NEW.idvenda;
	UPDATE produto SET quantidade = quantidade - NEW.quantidade WHERE idproduto = NEW.idproduto;
	RETURN NULL;
  END;
  $$ language plpgsql;

CREATE TRIGGER additemvenda
AFTER INSERT ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE ADICIONAR_ITEM_VENDA();


CREATE OR REPLACE FUNCTION ATUALIZAR_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
	UPDATE venda SET valortotal = valortotal - ((OLD.quantidade * OLD.valorunitario) * (NEW.quantidade * NEW.valorunitario)) WHERE idvenda = NEW.idvenda;
	UPDATE produto SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade) WHERE idproduto = NEW.idproduto;
	RETURN NULL;
  END;
  $$ language plpgsql;

CREATE TRIGGER attitemvenda
AFTER UPDATE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE ATUALIZAR_ITEM_VENDA();


CREATE OR REPLACE FUNCTION DELETAR_VENDA() RETURNS TRIGGER AS $$
BEGIN
  	DELETE FROM itensvenda WHERE idvenda = OLD.idvenda;
	RETURN NULL;
  END;
  $$ language plpgsql;

CREATE TRIGGER delvenda
AFTER DELETE ON venda
FOR EACH ROW EXECUTE PROCEDURE DELETAR_VENDA();


CREATE OR REPLACE FUNCTION DELETAR_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
  	UPDATE venda SET valortotal = valortotal - (OLD.quantidade * OLD.valorunitario) WHERE idvenda = OLD.idvenda;
	UPDATE produto SET quantidade = quantidade + OLD.quantidade WHERE idproduto = OLD.idproduto;
	RETURN NULL;
  END;
  $$ language plpgsql;

CREATE TRIGGER delitemvenda
AFTER DELETE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE DELETAR_ITEM_VENDA();

