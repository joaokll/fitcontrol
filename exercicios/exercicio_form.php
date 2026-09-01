<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
$ficha_id = $_GET['ficha_id'] ?? null;

$exercicio = ['nome' => '', 'series' => '', 'repeticoes' => '', 'carga' => '', 'observacao' => ''];
$erro = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM exercicios WHERE id = ?');
    $stmt->execute([$id]);
    $exercicio = $stmt->fetch();
    if (!$exercicio) {
        header('Location: ../fichas/fichas_list.php');
        exit;
    }
    $ficha_id = $exercicio['ficha_id'];
}

if (!$ficha_id) {
    header('Location: /fitcontrol-master/fichas/fichas_list.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM fichas_treino WHERE id = ?');
$stmt->execute([$ficha_id]);
$ficha = $stmt->fetch();
if (!$ficha) {
    header('Location: /fitcontrol-master/fichas/fichas_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $series = $_POST['series'] ?: null;
    $repeticoes = trim($_POST['repeticoes'] ?? '');
    $carga = trim($_POST['carga'] ?? '');
    $observacao = trim($_POST['observacao'] ?? '');

    if ($nome === '') {
        $erro = 'Informe o nome do exercício.';
    } else {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE exercicios SET nome=?, series=?, repeticoes=?, carga=?, observacao=? WHERE id=?');
            $stmt->execute([$nome, $series, $repeticoes, $carga, $observacao, $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO exercicios (ficha_id, nome, series, repeticoes, carga, observacao) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$ficha_id, $nome, $series, $repeticoes, $carga, $observacao]);
        }
        header('Location: /fitcontrol-master/fichas/fichas_view.php?id=' . $ficha_id . '&msg=' . urlencode('Exercício salvo com sucesso!'));
        exit;
    }
    $exercicio = compact('nome', 'series', 'repeticoes', 'carga', 'observacao');
}

require __DIR__ . '/../header.php';
?>

<p><a href="../fichas/fichas_view.php?id=<?= $ficha_id ?>">← Voltar para a ficha</a></p>

<h1><?= $id ? 'Editar Exercício' : 'Novo Exercício' ?></h1>
<p>Ficha: <?= htmlspecialchars($ficha['nome_ficha']) ?></p>

<div>
    <?php if ($erro) : ?>
        <div <?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Nome do exercício *</label>
            <input type="text" name="nome" required value="<?= htmlspecialchars($exercicio['nome']) ?>" placeholder="Ex: Supino reto">
        </div>
        <div>
            <label>Séries</label>
            <input type="number" name="series" min="1" value="<?= htmlspecialchars($exercicio['series'] ?? '') ?>">
        </div>
        <div>
            <label>Repetições</label>
            <input type="text" name="repeticoes" value="<?= htmlspecialchars($exercicio['repeticoes'] ?? '') ?>" placeholder="Ex: 10-12">
        </div>
        <div>
            <label>Carga</label>
            <input type="text" name="carga" value="<?= htmlspecialchars($exercicio['carga'] ?? '') ?>" placeholder="Ex: 20kg">
        </div>
        <div>
            <label>Observação</label>
            <textarea name="observacao" rows="3"><?= htmlspecialchars($exercicio['observacao'] ?? '') ?></textarea>
        </div>

        <div>
            <button type="submit">Salvar</button>
            <a href="/fitcontrol-master/fichas/fichas_view.php?id=<?= $ficha_id ?>">Cancelar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
