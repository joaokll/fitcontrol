# FitControl – Gestão de Alunos e Fichas de Treino

Sistema web desenvolvido em **PHP nativo + MySQL** para personal trainers gerenciarem alunos, fichas de treino e mensalidades.

Projeto Final de Curso – SESI

---

## Funcionalidades

- Login com níveis de acesso (Personal e Aluno)
- CRUD completo de **Alunos**
- CRUD completo de **Fichas de Treino**
- Dashboard com indicadores
- Controle de sessão e segurança básica

---

## Estrutura

├── README.md
├── banco.sql
├── composer.json
├── composer.lock
├── index.php
├── src
│   ├── app
│   │   ├── alunos_cadastrar.php
│   │   ├── alunos_deletar.php
│   │   ├── alunos_editar.php
│   │   ├── alunos_listar.php
│   │   ├── dashboard.php
│   │   ├── fichas_cadastrar.php
│   │   ├── fichas_deletar.php
│   │   ├── fichas_editar.php
│   │   └── fichas_listar.php
│   ├── conexao.php
│   ├── footer.php
│   ├── header.php
│   ├── login.php
│   ├── logout.php
│   └── trava_login.php
└── vendor
    ├── autoload.php
    └── composer
        ├── ClassLoader.php
        ├── InstalledVersions.php
        ├── LICENSE
        ├── autoload_classmap.php
        ├── autoload_files.php
        ├── autoload_namespaces.php
        ├── autoload_psr4.php
        ├── autoload_real.php
        ├── autoload_static.php
        ├── installed.json
        └── installed.php

4 directories, 32 files

---

## Tecnologias

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5 (CDN)
- HTML5 + CSS3 + JavaScript

---

## Como rodar o projeto

1. Clone o repositório:
```bash
git clone https://github.com/SEU-USUARIO/fitcontrol.git
