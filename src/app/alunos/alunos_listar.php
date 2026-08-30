<?php
require_once __DIR__ . '/auth.php';

$alunos = $pdo->query("SELECT * FROM alunos ORDER BY nome ASC")->fetchAll();

require __DIR__ . '/header.php';
?>

<div>
    <div>
        <h1>Alunos</h1>
        <p>Gerencie os alunos cadastrados</p>
    </div>
    <a href="aluno_cadastrar.php">Novo Aluno</a>
</div>

<?php if (!empty($_GET['msg'])) : ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div>
    <?php if (count($alunos) === 0) : ?>
        <p class="empty-state">Nenhum aluno cadastrado ainda.</p>
    <?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Matrícula</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($alunos as $a) : ?>
            <tr>
                <td><?= htmlspecialchars($a['nome']) ?></td>
                <td><?= htmlspecialchars($a['email'] ?: '-') ?></td>
                <td><?= htmlspecialchars($a['telefone'] ?: '-') ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($a['data_matricula']))) ?></td>
                <td><?= $a['ativo'] ? '<span class="badge badge-pago">Ativo</span>' : '<span class="badge badge-atrasado">Inativo</span>' ?></td>
                <td class="actions">
                    <a href="mensalidade_listar.php?aluno_id=<?= $a['id'] ?>">Mensalidades</a>
                    <a href="fichas_listar.php?aluno_id=<?= $a['id'] ?>">Fichas</a>
                    <a href="alunos_cadastrar.php?id=<?= $a['id'] ?>">Editar</a>
                    <a href="alunos_deletar.php?id=<?= $a['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno? Todas as mensalidades e fichas dele também serão excluídas.')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
