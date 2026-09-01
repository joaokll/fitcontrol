<?php

require_once __DIR__ . '/../database/config.php';

if (!empty($_SESSION['usuario_id'])) {
    header('Location: ../dashboard.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Preencha e-mail e senha.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('Location: ../dashboard.php');
            exit;
        } else {
            $erro = 'E-mail ou senha inválidos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - FITControl</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <h1>FITControl</h1>
    <p>Entre com sua conta</p>

    <?php if ($erro) : ?>
        <div><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
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
        Não tem conta? <a href="register.php">Cadastre-se</a>
    </div>
</div>
</body>
</html>
