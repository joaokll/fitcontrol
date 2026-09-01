<?php

require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
$ficha = [
    'aluno_id' => $_GET['aluno_id'] ?? '',
    'nome_ficha' => '',
    'objetivo' => '',
    'data_criacao' => date('Y-m-d'),
];
$erro = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM fichas_treino WHERE id = ?');
    $stmt->execute([$id]);
    $ficha = $stmt->fetch();
    if (!$ficha) {
        header('Location: fichas_list.php');
        exit;
    }
}

$alunos = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome ASC')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = $_POST['aluno_id'] ?? '';
    $nome_ficha = trim($_POST['nome_ficha'] ?? '');
    $objetivo = trim($_POST['objetivo'] ?? '');
    $data_criacao = $_POST['data_criacao'] ?: date('Y-m-d');

    if ($aluno_id === '' || $nome_ficha === '') {
        $erro = 'Selecione o aluno e informe o nome da ficha.';
    } else {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE fichas_treino SET aluno_id=?, nome_ficha=?, objetivo=?, data_criacao=? WHERE id=?');
            $stmt->execute([$aluno_id, $nome_ficha, $objetivo, $data_criacao, $id]);
            header('Location: ficha_view.php?id=' . $id . '&msg=' . urlencode('Ficha atualizada com sucesso!'));
            exit;
        } else {
            $stmt = $pdo->prepare('INSERT INTO fichas_treino (aluno_id, nome_ficha, objetivo, data_criacao) VALUES (?, ?, ?, ?)');
            $stmt->execute([$aluno_id, $nome_ficha, $objetivo, $data_criacao]);
            $novoId = $pdo->lastInsertId();
            header('Location: ficha_view.php?id=' . $novoId . '&msg=' . urlencode('Ficha criada! Agora adicione os exercícios.'));
            exit;
        }
    }
    $ficha = compact('aluno_id', 'nome_ficha', 'objetivo', 'data_criacao');
}

require __DIR__ . '/header.php';
?>

<h1><?= $id ? 'Editar Ficha de Treino' : 'Nova Ficha de Treino' ?></h1>
<p >Defina os dados gerais da ficha</p>

<div>
    <?php if ($erro) : ?>
        <div><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Aluno *</label>
            <select name="aluno_id" required>
                <option value="">Selecione...</option>
                <?php foreach ($alunos as $a) : ?>
                    <option value="<?= $a['id'] ?>" <?= (string)$ficha['aluno_id'] === (string)$a['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Nome da ficha *</label>
            <input type="text" name="nome_ficha" required value="<?= htmlspecialchars($ficha['nome_ficha']) ?>" placeholder="Ex: Treino A - Superior">
        </div>
        <div>
            <label>Objetivo</label>
            <input type="text" name="objetivo" value="<?= htmlspecialchars($ficha['objetivo'] ?? '') ?>" placeholder="Ex: Hipertrofia, emagrecimento...">
        </div>
        <div>
            <label>Data de criação</label>
            <input type="date" name="data_criacao" value="<?= htmlspecialchars($ficha['data_criacao'] ?? date('Y-m-d')) ?>">
        </div>

        <div class="actions">
            <button type="submit">Salvar</button>
            <a href="fichas_list.php">Cancelar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>
