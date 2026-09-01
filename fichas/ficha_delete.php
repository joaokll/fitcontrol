<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM fichas_treino WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: fichas_list.php?msg=' . urlencode('Ficha excluída com sucesso.'));
exit;
