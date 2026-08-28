CREATE DATABASE IF NOT EXISTS fitcontrol
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE fitcontrol;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('personal', 'aluno', 'administrador') NOT NULL DEFAULT 'aluno',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT NULL,

    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    data_nascimento DATE,
    anamnese TEXT,
    vencimento_mensalidade DATE,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_alunos_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,
    grupo_muscular VARCHAR(50) NOT NULL,
    video_url VARCHAR(255),

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fichas_treino (
    id INT AUTO_INCREMENT PRIMARY KEY,

    aluno_id INT NOT NULL,

    tipo ENUM(
        'Full-body',
        'Upper/lower AB',
        'Upper/lower Full-body',
        'PPL',
        'ABC',
        'ABCD',
        'ABCDE',
        'Bro split',
        'PHUL',
        'PHAT',
        'arnold split'
    ) NOT NULL,

    frequencia ENUM(
        '1x',
        '2x',
        '3x',
        '4x',
        '5x',
        '6x',
        '7x'
    ) NOT NULL,

    objetivo VARCHAR(150),

    data_inicio DATE NOT NULL,
    data_fim DATE,

    status ENUM('ativa', 'inativa') DEFAULT 'ativa',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_fichas_aluno
        FOREIGN KEY (aluno_id)
        REFERENCES alunos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE exercicios_ficha (
    id INT AUTO_INCREMENT PRIMARY KEY,

    ficha_id INT NOT NULL,
    exercicio_id INT NOT NULL,

    series INT NOT NULL,
    repeticoes VARCHAR(50) NOT NULL,
    carga DECIMAL(6,2),
    observacoes VARCHAR(255),

    CONSTRAINT fk_exercicios_ficha
        FOREIGN KEY (ficha_id)
        REFERENCES fichas_treino(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_ficha_exercicio
        FOREIGN KEY (exercicio_id)
        REFERENCES exercicios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE mensalidades (
    id INT AUTO_INCREMENT PRIMARY KEY,

    aluno_id INT NOT NULL,

    valor DECIMAL(10,2) NOT NULL,
    vencimento DATE NOT NULL,
    data_pagamento DATE NULL,

    status ENUM('pendente', 'pago') DEFAULT 'pendente',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_mensalidades_aluno
        FOREIGN KEY (aluno_id)
        REFERENCES alunos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

