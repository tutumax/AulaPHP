CREATE DATABASE consultorio;
USE consultorio;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cpf VARCHAR(14),
    endereco VARCHAR(200),
    nivel VARCHAR(20),
    email VARCHAR(100),
    senha VARCHAR(100),
    status VARCHAR(20)
);

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