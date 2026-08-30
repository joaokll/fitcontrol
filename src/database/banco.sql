CREATE DATABASE IF NOT EXISTS fitcontrol CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fitcontrol;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    data_nascimento DATE,
    data_matricula DATE NOT NULL DEFAULT (CURRENT_DATE),
    ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS mensalidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    vencimento DATE NOT NULL,
    status ENUM('pago','pendente','atrasado') NOT NULL DEFAULT 'pendente',
    data_pagamento DATE NULL,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fichas_treino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    nome_ficha VARCHAR(100) NOT NULL,
    objetivo VARCHAR(150),
    data_criacao DATE NOT NULL DEFAULT (CURRENT_DATE),
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ficha_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    series INT,
    repeticoes VARCHAR(20),
    carga VARCHAR(20),
    observacao VARCHAR(255),
    FOREIGN KEY (ficha_id) REFERENCES fichas_treino(id) ON DELETE CASCADE
) ENGINE=InnoDB;
