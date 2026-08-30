<?php
require_once __DIR__ . '/auth.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: alunos_listar.php?msg=' . urlencode('Aluno excluído com sucesso.'));
exit;
