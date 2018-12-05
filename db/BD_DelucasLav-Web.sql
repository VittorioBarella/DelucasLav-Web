
CREATE DATABASE DelucasLav;

USE DelucasLav;

CREATE TABLE Usuario (
idUsuario INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomeUsuario VARCHAR(10),
senha VARCHAR(20),
nome VARCHAR(30),
nivel VARCHAR(20)

);

CREATE TABLE Item_Higienizacao (
item VARCHAR(10),
idItem INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
preco FLOAT
);

CREATE TABLE Cliente (
idCliente INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomeCliente VARCHAR(40),
telefone VARCHAR(15),
endereco VARCHAR(100),
email VARCHAR(40)
);

CREATE TABLE Ordem_Servico (
idOds INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
dataEntrega DATE,
precoTotal DECIMAL(10,2),
dataRecebimento DATE,
idCliente INTEGER,
FOREIGN KEY(idCliente) REFERENCES Cliente (idCliente)
);

CREATE TABLE Item_ODS (
quantidade INTEGER,
idItemOds INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
somaTotalItem FLOAT,
idOds INTEGER,
idItem INTEGER,
FOREIGN KEY(idOds) REFERENCES Ordem_Servico (idOds),
FOREIGN KEY(idItem) REFERENCES Item_Higienizacao (idItem)
);

CREATE TABLE Estoque_Material (
idMaterial INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
quantidade INTEGER,
nomeMaterial VARCHAR(10),
idFornecedor INTEGER
);

CREATE TABLE Fornecedor (
idFornecedor INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomeFornecedor VARCHAR(30),
telefone VARCHAR(15),
email VARCHAR(40),
endereco VARCHAR(100)
);

ALTER TABLE Estoque_Material ADD FOREIGN KEY(idFornecedor) REFERENCES Fornecedor (idFornecedor);

INSERT INTO Usuario (nomeUsuario, nome, senha) VALUES ('admin', 'Administrador', 'q1w2e3');
