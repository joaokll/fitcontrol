<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>FitControl</h1>
        <h1>Bem-vindo ao FitControl. Acesse seus treinos e evolução.</h1>
    </div>
    <div>
        <h1>Inscreva-se no FitControl</h1>
        <div>
            <form method="POST">
                <label for="email">Email*</label><br>
                <input type="email" name="email" id="email" placeholder="E-mail" ><br><br>

                <label for="senha">Senha*</label><br>
                <input type="password" name="senha" id="senha" placeholder="Senha"><br><br>

                <label for="nome-usuario">Nome de usuário*</label><br>
                <input type="text" name="nome-usuario" id="nome-usuario" placeholder="Nome de usuário"><br><br>

                <label for="cpf">CPF</label><br>
                <input type="text" name="cpf" id="cpf" placeholder="123.456.789.10"><br><br>

                <button class="butao-criar-conta" type="submit">Enviar Dados</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

$email = $_POST["email"] ?? '';
$senha = $_POST["senha"] ?? '';
$nome_aluno = $_POST["nome-usuario"] ?? '';
$cpf = $_POST['cpf'] ?? '';

?> 