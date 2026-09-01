<?php
require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: alunos_list.php?msg=' . urlencode('Aluno excluído com sucesso.'));
exit;
