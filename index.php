<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <label for="entrar">Escolha a opção pra entrar:</label>
    <select name="entrar" id="entrar">
    <option value="login">Login</option>
    <option value="registrar">Registrar</option>
    </select>
    <button type="submit">Confirmar</button>
    </form>

    
    <?php
    $entrarOpcao = $_GET['entrar'] ?? '';

    switch ($entrarOpcao) {
        case 'login':
            $botao = 'Login';
            break;
        case 'registrar':
            $botao = 'Registrar';
            break;
        default:
            $botao = null;
    }
    ?>

    <?php if ($botao) : ?>
    <div class="container1">
        <form method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario"> <br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha"> <br>

            <button type="submit"><?= $botao ?></button>
        </form>
    </div>
    <?php endif; ?>

    <?php

    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Teste pra ver se ta pegando
    echo" seu usuario é: {$usuario} e a senha é: {$senha}";
    ?>

</body>
</html>

