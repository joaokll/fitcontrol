<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="authLogin.php" method="POST">
        <div>
            <label>E-mail</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit">Entrar</button>
    </form>

    <div>
        Ainda não tem conta? <a href="registrar.php">Entre agora</a>
    </div>
</body>
</html>