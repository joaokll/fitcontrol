<?php

require_once __DIR__ . '/../database/config.php';

if (!empty($_SESSION['usuario_id'])) {
    header('Location: ../dashboard.php');
    exit;
}

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $senha2 = $_POST['senha2'] ?? '';

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif ($senha !== $senha2) {
        $erro = 'As senhas não coincidem.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erro = 'Já existe uma conta com este e-mail.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
            $stmt->execute([$nome, $email, $hash]);
            $sucesso = 'Conta criada com sucesso você já pode entrar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar Conta - FITControl</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-wrap">
    <h1>FITControl</h1>
    <p>Criar nova conta de acesso</p>

    <?php if ($erro) : ?>
        <div><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
    <?php if ($sucesso) : ?>
        <div><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>
        <div>
            <label>E-mail</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>
        <div>
            <label>Confirmar senha</label>
            <input type="password" name="senha2" required>
        </div>
        <button type="submit">Cadastrar</button>
    </form>

    <div>
        Já tem conta? <a href="login.php">Entrar</a>
    </div>
</div>
</body>
</html>
