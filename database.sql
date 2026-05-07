create database empresa;
use empresa;
create table funcionarios(
    id INT PRIMARY KEY AUTO_INCREMENT
    nome varchar(60) NOT NULL,
    salario_base float NOT NULL,
    horas_extras int NOT NULL,
    valores_horas float NOT NULL,
    dependentes int NOT NULL,
    inss float NOT NULL,
    ir float NOT NULL,
    salario_liquido float NOT NULL,
);