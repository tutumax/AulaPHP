create database if not exists pague;
use pague;
create table if not exists empresa (
id_funcionarios int(11) key auto_increment,
nome varchar(50) not null,
salariob float(10,2) not null,
horas int(11) not null,
valorh float(10,2) not null,
dependentes int(11) not null,
salariobru float(10,2) not null,
salarioliq float(10,2) not null,
Irenda float(10,2) not null,
inss float(10,2) not null
);

insert into empresa values (null, 'tutu67', 1000.00,0,0,0,1000.00,900.00,30.00,70.00);

select * from empresa;