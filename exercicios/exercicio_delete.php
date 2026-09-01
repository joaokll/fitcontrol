<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
$ficha_id = $_GET['ficha_id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare('DELETE FROM exercicios WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: ../fichas/fichas_view.php?id=' . $ficha_id . '&msg=' . urlencode('Exercício excluído com sucesso.'));
exit;
