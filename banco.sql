CREATE DATABASE bd_cadastro;
USE bd_cadastro;

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE,
    serie VARCHAR(50),
    cpf VARCHAR(14),
    rg VARCHAR(20),
    telefone VARCHAR(20),
    responsavel VARCHAR(100),
    escola VARCHAR(100),
    endereco TEXT
);