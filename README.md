# HabitTrack — Controle de Hábitos Pessoais

Projeto para a UC de desenvolvimento Back end

## Tecnologias

- PHP 8.3+
- MySQL
- PDO
- OOP
- MVC
- HTML5 / CSS3
- Bootstrap 5
- Composer

## Estrutura

O projeto utiliza MVC simples com `Model`, `Controller` e `View`, tendo `index.php` como ponto de entrada.

## Banco de Dados

CREATE DATABASE IF NOT EXISTS habittrack
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE habittrack;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS habitos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    descricao VARCHAR(1000) NOT NULL DEFAULT '',
    categoria VARCHAR(50) NOT NULL,
    frequencia VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Ativo',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_habitos_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE CASCADE,
    INDEX idx_habitos_usuario (usuario_id),
    INDEX idx_habitos_categoria (categoria),
    INDEX idx_habitos_status (status)
) ENGINE=InnoDB;
