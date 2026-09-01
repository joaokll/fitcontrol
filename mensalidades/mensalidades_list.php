<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$pdo->exec("UPDATE mensalidades SET status = 'atrasado' WHERE status = 'pendente' AND vencimento < CURDATE()");

$aluno_id = $_GET['aluno_id'] ?? null;

if ($aluno_id) {
    $stmt = $pdo->prepare("SELECT m.*, a.nome AS aluno_nome FROM mensalidades m
                            JOIN alunos a ON a.id = m.aluno_id
                            WHERE m.aluno_id = ?
                            ORDER BY m.vencimento DESC");
    $stmt->execute([$aluno_id]);
    $mensalidades = $stmt->fetchAll();

    $stmtAluno = $pdo->prepare('SELECT nome FROM alunos WHERE id = ?');
    $stmtAluno->execute([$aluno_id]);
    $alunoFiltro = $stmtAluno->fetch();
} else {
    $mensalidades = $pdo->query("SELECT m.*, a.nome AS aluno_nome FROM mensalidades m
                                  JOIN alunos a ON a.id = m.aluno_id
                                  ORDER BY m.vencimento DESC")->fetchAll();
}

require __DIR__ . '/../header.php';

$badges = [
    'pago' => 'badge-pago',
    'pendente' => 'badge-pendente',
    'atrasado' => 'badge-atrasado',
];
$labels = [
    'pago' => 'Pago',
    'pendente' => 'Pendente',
    'atrasado' => 'Atrasado',
];
?>

<div>
    <div>
        <h1>Mensalidades <?= $aluno_id && !empty($alunoFiltro) ? '- ' . htmlspecialchars($alunoFiltro['nome']) : '' ?></h1>
        <p>Controle de pagamentos dos alunos</p>
    </div>
    <a href="mensalidade_form.php<?= $aluno_id ? '?aluno_id=' . $aluno_id : '' ?>">+ Nova Mensalidade</a>
</div>

<?php if ($aluno_id) : ?>
    <p><a href="mensalidades_list.php">← Ver todas as mensalidades</a></p>
<?php endif; ?>

<?php if (!empty($_GET['msg'])) : ?>
    <div><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div>
    <?php if (count($mensalidades) === 0) : ?>
        <p>Nenhuma mensalidade cadastrada ainda.</p>
    <?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Data pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($mensalidades as $m) : ?>
            <tr>
                <td><?= htmlspecialchars($m['aluno_nome']) ?></td>
                <td>R$ <?= number_format($m['valor'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($m['vencimento']))) ?></td>
                <td><span class="badge <?= $badges[$m['status']] ?>"><?= $labels[$m['status']] ?></span></td>
                <td><?= $m['data_pagamento'] ? htmlspecialchars(date('d/m/Y', strtotime($m['data_pagamento']))) : '-' ?></td>
                <td>
                    <a href="mensalidade_form.php?id=<?= $m['id'] ?>">Editar</a>
                    <a href="mensalidade_delete.php?id=<?= $m['id'] ?>" onclick="return confirm('Excluir esta mensalidade?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
