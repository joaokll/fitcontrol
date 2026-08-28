<?php

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM fichas_treino WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: fichas_listar.php?msg=' . urlencode('Ficha excluída com sucesso.'));
exit;
