# ERROS:

1. Gerenciar Alunos
após fazer login normalmente, entrar no dashboard, e então clicar em Gerenciar Alunos acontece um erro:

Warning: require(C:\xampp\htdocs\fitcontrol\alunos/header.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\fitcontrol\alunos\alunos_list.php on line 6
Fatal error: Uncaught Error: Failed opening required 'C:\xampp\htdocs\fitcontrol\alunos/header.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\fitcontrol\alunos\alunos_list.php:6 Stack trace: #0 {main} thrown in C:\xampp\htdocs\fitcontrol\alunos\alunos_list.php on line 6

1.1. Gerenciar Mensalidades
após fazer login normalmente, entrar no dashboard, e então clicar em Gerenciar Mensalidades acontece um erro:

Warning: require(C:\xampp\htdocs\fitcontrol\mensalidades/header.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\fitcontrol\mensalidades\mensalidades_list.php on line 26
Fatal error: Uncaught Error: Failed opening required 'C:\xampp\htdocs\fitcontrol\mensalidades/header.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\fitcontrol\mensalidades\mensalidades_list.php:26 Stack trace: #0 {main} thrown in C:\xampp\htdocs\fitcontrol\mensalidades\mensalidades_list.php on line 26


1.2. Gerenciar Fichas de Treino
após fazer login normalmente, entrar no dashboard, e então clicar em Gerenciar Fichas de treino acontece um erro:

Warning: require(C:\xampp\htdocs\fitcontrol\fichas/header.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\fitcontrol\fichas\fichas_list.php on line 24
Fatal error: Uncaught Error: Failed opening required 'C:\xampp\htdocs\fitcontrol\fichas/header.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\fitcontrol\fichas\fichas_list.php:24 Stack trace: #0 {main} thrown in C:\xampp\htdocs\fitcontrol\fichas\fichas_list.php on line 24

## CORREÇÃO

O erro estava por que em todas as linhas no require_once __DIR__ "/header.php"
porém eu estava fazendo isso dentro de uma pasta ou seja ele estava procurando o header.php dentro da propria pasta, mas ele estava num diretorio acima, a forma que fiz pra resolver foi: require_once __DIR__ "/../header.php" assim ele ia pra um nivel pra cima e achava o header.php
---


2. Redirecionamente da nav bar dando erro de pagina não encontrada
<a href="/dashboard.php">Dashboard</a>
<a href="/alunos/alunos_list.php">Alunos</a>
<a href="/mensalidades/mensalidades_list.php">Mensalidades</a>
<a href="/fichas/fichas_list.php">Fichas de Treino</a>

## CORREÇÃO

o erro estava nessa linha, e a forma certa é: já que ele estava procurando o arquivo na mesma pasta, enves de subir pra raiz e entrar, como eu queria que acontecesse

<a href="/fitcontrol-master/dashboard.php">Dashboard</a>
<a href="/fitcontrol-master/alunos/alunos_list.php">Alunos</a>
<a href="/fitcontrol-master/mensalidades/mensalidades_list.php">Mensalidades</a>
<a href="/fitcontrol-master/fichas/fichas_list.php">Fichas de Treino</a>

---

3. Exercicio

Após criar aluno, matricula tudo dando certo, ao criar um exercício, deu um erro de NOT found

## CORREÇÃO

No arquivo estava apontando pra fichas_view.php mas o certo é ficha_view.php

---

4. Logout

### CORREÇÃO

falha no redirecionamento.

--
