<?php

require_once __DIR__ . '/auth.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM mensalidades WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: /src/mensalidade/mensalidade_listar.php?msg=' . urlencode('Mensalidade excluída com sucesso.'));
exit;
