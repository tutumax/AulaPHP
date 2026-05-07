create database empresa;
use empresa;
create table if not exists dados(
    id_funcionario primary key not null auto_increment,
    nome varchar(80) not null,
    salario_bruto float not null,
    salario float not null,
    salarioliquido float not null,
    numero int not null,
    horasextras int not null,
    valorextras float not null,
    inss float not null,
    ir float not null,
);