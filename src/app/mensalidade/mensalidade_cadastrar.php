<?php

require_once __DIR__ . '/auth.php';

$id = $_GET['id'] ?? null;
$mensalidade = [
    'aluno_id' => $_GET['aluno_id'] ?? '',
    'valor' => '',
    'vencimento' => date('Y-m-d'),
    'status' => 'pendente',
    'data_pagamento' => '',
];
$erro = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM mensalidades WHERE id = ?');
    $stmt->execute([$id]);
    $mensalidade = $stmt->fetch();
    if (!$mensalidade) {
        header('Location: /src/mensalidade/mensalidade_listar.php');
        exit;
    }
}

$alunos = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome ASC')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = $_POST['aluno_id'] ?? '';
    $valor = str_replace(',', '.', $_POST['valor'] ?? '');
    $vencimento = $_POST['vencimento'] ?? '';
    $status = $_POST['status'] ?? 'pendente';
    $data_pagamento = $_POST['data_pagamento'] ?: null;

    if ($aluno_id === '' || $valor === '' || $vencimento === '') {
        $erro = 'Preencha aluno, valor e o vencimento.';
    } else {
        if ($status === 'pago' && !$data_pagamento) {
            $data_pagamento = date('Y-m-d');
        }
        if ($id) {
            $stmt = $pdo->prepare('UPDATE mensalidades SET aluno_id=?, valor=?, vencimento=?, status=?, data_pagamento=? WHERE id=?');
            $stmt->execute([$aluno_id, $valor, $vencimento, $status, $data_pagamento, $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO mensalidades (aluno_id, valor, vencimento, status, data_pagamento) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$aluno_id, $valor, $vencimento, $status, $data_pagamento]);
        }
        header('Location: /src/mensalidade/mensalidade_listar.php?msg=' . urlencode('Mensalidade salva com sucesso!'));
        exit;
    }
    $mensalidade = compact('aluno_id', 'valor', 'vencimento', 'status', 'data_pagamento');
}

require __DIR__ . '/header.php';
?>

<h1><?= $id ? 'Editar Mensalidade' : 'Nova Mensalidade' ?></h1>
<p>Registre o pagamento mensal do aluno</p>

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
                    <option value="<?= $a['id'] ?>" <?= (string)$mensalidade['aluno_id'] === (string)$a['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Valor (R$) *</label>
            <input type="text" name="valor" required value="<?= htmlspecialchars($mensalidade['valor']) ?>" placeholder="Ex: 120.00">
        </div>
        <div>
            <label>Vencimento *</label>
            <input type="date" name="vencimento" required value="<?= htmlspecialchars($mensalidade['vencimento']) ?>">
        </div>
        <div>
            <label>Status</label>
            <select name="status">
                <option value="pendente" <?= $mensalidade['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="pago" <?= $mensalidade['status'] === 'pago' ? 'selected' : '' ?>>Pago</option>
                <option value="atrasado" <?= $mensalidade['status'] === 'atrasado' ? 'selected' : '' ?>>Atrasado</option>
            </select>
        </div>
        <div>
            <label>Data de pagamento</label>
            <input type="date" name="data_pagamento" value="<?= htmlspecialchars($mensalidade['data_pagamento'] ?? '') ?>">
        </div>

        <div>
            <button type="submit">Salvar</button>
            <a href="mensalidade_listar.php">Cancelar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>
