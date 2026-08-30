<?php $usuario_nome = $_SESSION['usuario_nome'] ?? ''; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Academia - Sistema de Gestão</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div>Academia</div>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="alunos_listar.php">Alunos</a>
        <a href="mensalidades_listar.php">Mensalidades</a>
        <a href="fichas_listar.php">Fichas de Treino</a>
    </nav>
    <div class="user-area">
        <?php if ($usuario_nome) : ?>
            <span>Olá, <?= htmlspecialchars($usuario_nome) ?></span>
            <a href="logout.php"">Sair</a>
        <?php endif; ?>
    </div>
</header>
<main>
