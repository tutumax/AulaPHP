CREATE DATABASE arduino;
USE arduino;

CREATE TABLE placar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time1 VARCHAR(100) NOT NULL,
    pontos1 INT NOT NULL,
    time2 VARCHAR(100) NOT NULL,
    pontos2 INT NOT NULL,
);
