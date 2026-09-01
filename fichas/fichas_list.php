<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$aluno_id = $_GET['aluno_id'] ?? null;

if ($aluno_id) {
    $stmt = $pdo->prepare("SELECT f.*, a.nome AS aluno_nome FROM fichas_treino f
                            JOIN alunos a ON a.id = f.aluno_id
                            WHERE f.aluno_id = ?
                            ORDER BY f.data_criacao DESC");
    $stmt->execute([$aluno_id]);
    $fichas = $stmt->fetchAll();

    $stmtAluno = $pdo->prepare('SELECT nome FROM alunos WHERE id = ?');
    $stmtAluno->execute([$aluno_id]);
    $alunoFiltro = $stmtAluno->fetch();
} else {
    $fichas = $pdo->query("SELECT f.*, a.nome AS aluno_nome FROM fichas_treino f
                            JOIN alunos a ON a.id = f.aluno_id
                            ORDER BY f.data_criacao DESC")->fetchAll();
}

require __DIR__ . '/../header.php';
?>

<div>
    <div>
        <h1>Fichas de Treino <?= $aluno_id && !empty($alunoFiltro) ? '- ' . htmlspecialchars($alunoFiltro['nome']) : '' ?> </h1>
        <p>Fichas de treino cadastradas para os alunos</p>
    </div>
    <a href="ficha_form.php<?= $aluno_id ? '?aluno_id=' . $aluno_id : '' ?>">+ Nova Ficha</a>
</div>

<?php if ($aluno_id) : ?>
    <p><a href="fichas_list.php">← Ver todas as fichas</a></p>
<?php endif; ?>

<?php if (!empty($_GET['msg'])) : ?>
    <div><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div>
    <?php if (count($fichas) === 0) : ?>
        <p>Nenhuma ficha de treino cadastrada ainda.</p>
    <?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Nome da ficha</th>
                <th>Objetivo</th>
                <th>Criada em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($fichas as $f) : ?>
            <tr>
                <td><?= htmlspecialchars($f['aluno_nome']) ?></td>
                <td><?= htmlspecialchars($f['nome_ficha']) ?></td>
                <td><?= htmlspecialchars($f['objetivo'] ?: '-') ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($f['data_criacao']))) ?></td>
                <td>
                    <a href="ficha_view.php?id=<?= $f['id'] ?>">Ver exercícios</a>
                    <a href="ficha_form.php?id=<?= $f['id'] ?>">Editar</a>
                    <a href="ficha_delete.php?id=<?= $f['id'] ?>" onclick="return confirm('Excluir esta ficha e todos os exercícios dela?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
