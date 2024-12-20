// Criação de banco de dados
CREATE DATABASE gerenciador_tarefas;

//Uso de banco de dados para criação de tabelas
USE gerenciador_tarefas;

//criação de tabelas após o comando USE
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(10) NOT NULL
);

CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id)
);

CREATE TABLE Status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    projeto_id INT,
    status_id INT,
    tempo_estimado INT,
    tempo_gasto INT,
    responsavel_id INT,
    agendamento DATETIME,
    localizacao VARCHAR(255),
    FOREIGN KEY (projeto_id) REFERENCES Projetos(id),
    FOREIGN KEY (status_id) REFERENCES Status(id),
    FOREIGN KEY (responsavel_id) REFERENCES Usuarios(id)
);

CREATE TABLE Lembretes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT,
    lembrete DATETIME,
    FOREIGN KEY (tarefa_id) REFERENCES Tarefas(id)
);

CREATE TABLE Anexos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT,
    caminho VARCHAR(255),
    FOREIGN KEY (tarefa_id) REFERENCES Tarefas(id)
);

CREATE TABLE Dependencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT,
    dependencia_id INT,
    FOREIGN KEY (tarefa_id) REFERENCES Tarefas(id),
    FOREIGN KEY (dependencia_id) REFERENCES Tarefas(id)
);

CREATE TABLE Tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Tarefa_Tags (
    tarefa_id INT,
    tag_id INT,
    PRIMARY KEY (tarefa_id, tag_id),
    FOREIGN KEY (tarefa_id) REFERENCES Tarefas(id),
    FOREIGN KEY (tag_id) REFERENCES Tags(id)
);

CREATE TABLE Recursos_Necessarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT,
    recurso VARCHAR(255),
    FOREIGN KEY (tarefa_id) REFERENCES Tarefas(id)
);