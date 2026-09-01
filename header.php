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
<header class="barra-superior">
    <div class="logo">FITControl</div>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="alunos/alunos_list.php">Alunos</a>
        <a href="mensalidades/mensalidades_list.php">Mensalidades</a>
        <a href="fichas/fichas_list.php">Fichas de Treino</a>
    </nav>
    <div class="area-usuario">
        <?php if ($usuario_nome) : ?>
            <span>Olá, <?= htmlspecialchars($usuario_nome) ?></span>
            <a href="logout.php"">Sair</a>
        <?php endif; ?>
    </div>
</header>
<main class="container">
