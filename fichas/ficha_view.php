<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: fichas_list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT f.*, a.nome AS aluno_nome FROM fichas_treino f
                        JOIN alunos a ON a.id = f.aluno_id
                        WHERE f.id = ?");
$stmt->execute([$id]);
$ficha = $stmt->fetch();

if (!$ficha) {
    header('Location: fichas_list.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM exercicios WHERE ficha_id = ? ORDER BY id ASC');
$stmt->execute([$id]);
$exercicios = $stmt->fetchAll();

require __DIR__ . '/../header.php';
?>

<p><a href="fichas_list.php">← Voltar para fichas de treino</a></p>

<div>
    <div>
        <h1><?= htmlspecialchars($ficha['nome_ficha']) ?></h1>
        <p>
            Aluno: <?= htmlspecialchars($ficha['aluno_nome']) ?>
            <?php if ($ficha['objetivo']) : ?> 
            · Objetivo: 
                <?= htmlspecialchars($ficha['objetivo']) ?>
            <?php endif; ?>
        </p>
    </div>
    <a href="ficha_form.php?id=<?= $ficha['id'] ?>">Editar ficha</a>
</div>

<?php if (!empty($_GET['msg'])) : ?>
    <div><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div>
    <div>
        <h2>Exercícios</h2>
        <a href="../exercicios/exercicio_form.php?ficha_id=<?= $ficha['id'] ?>">+ Adicionar exercício</a>
    </div>

    <?php if (count($exercicios) === 0) : ?>
        <p>Nenhum exercício adicionado ainda.</p>
    <?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($exercicios as $e) : ?>
            <tr>
                <td><?= htmlspecialchars($e['nome']) ?></td>
                <td><?= htmlspecialchars($e['series'] ?? '-') ?></td>
                <td><?= htmlspecialchars($e['repeticoes'] ?: '-') ?></td>
                <td><?= htmlspecialchars($e['carga'] ?: '-') ?></td>
                <td><?= htmlspecialchars($e['observacao'] ?: '-') ?></td>
                <td>
                    <a href="../exercicios/exercicio_form.php?id=<?= $e['id'] ?>&ficha_id=<?= $ficha['id'] ?>">Editar</a>
                    <a href="../exercicios/exercicio_delete.php?id=<?= $e['id'] ?>&ficha_id=<?= $ficha['id'] ?>" onclick="return confirm('Excluir este exercício?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
