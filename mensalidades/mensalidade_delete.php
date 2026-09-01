<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM mensalidades WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: mensalidades_list.php?msg=' . urlencode('Mensalidade excluída com sucesso.'));
exit;
