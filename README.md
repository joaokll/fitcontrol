# FitControl – Gestão de Alunos e Fichas de Treino

Sistema web desenvolvido em **PHP nativo + MySQL** para personal trainers gerenciarem alunos, fichas de treino e mensalidades.

Projeto Final de Curso – SESI

---

## Funcionalidades


- Login, Registro e Logout com senha criptografada
- Alunos: cadastro, edição, exclusão e listagem
- Mensalidades: vinculadas a um aluno, com valor, vencimento, status de pago, pendente ou atrasado
- Fichas de treino: vinculadas a um aluno, cada ficha pode ter vários exercícios.
- Dashboard com resumo do total de alunos ativos, mensalidades pendentes, fichas cadaastradas, valor recebido no mês


---

## Estrutura

```text
.
├── README.md
├── banco.sql
├── composer.json
├── composer.lock
├── index.php
├── src
│   ├── app
│   │   ├── alunos
│   │   │   ├── alunos_cadastrar.php
│   │   │   ├── alunos_deletar.php
│   │   │   ├── alunos_editar.php
│   │   │   └── alunos_listar.php
│   │   ├── dashboard.php
│   │   └── fichas
│   │       ├── fichas_cadastrar.php
│   │       ├── fichas_deletar.php
│   │       ├── fichas_editar.php
│   │       └── fichas_listar.php
│   ├── auth
│   │   ├── login.php
│   │   ├── logout.php
│   │   └── trava_login.php
│   ├── config
│   │   └── conexao.php
│   ├── template
│   │   ├── footer.php
│   │   └── header.php
│   └── trash.md
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
```
9 directories, 33 files

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
```

2. Crie o banco de dados
Importe o `schema.sql` no MySQL/MariaDB:

3. Suba o servidor PHP
Com o PHP instalado, na pasta do projeto rode:

```bash
php -S localhost:8000
```

Depois acesse **http://localhost:8000** no navegador.

4. Cria sua conta
Acesse `register.php` (ou clique em "Cadastre-se" na tela de login) para criar o primeiro usuário do sistema. Depois é só fazer login normalmente.