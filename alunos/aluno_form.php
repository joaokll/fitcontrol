<?php
require_once __DIR__ . '/../autenticacao/auth.php';

$id = $_GET['id'] ?? null;
$aluno = ['nome' => '', 'email' => '', 'telefone' => '', 'data_nascimento' => '', 'data_matricula' => date('Y-m-d'), 'ativo' => 1];
$erro = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
    $stmt->execute([$id]);
    $aluno = $stmt->fetch();
    if (!$aluno) {
        header('Location: alunos_list.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $data_nascimento = $_POST['data_nascimento'] ?: null;
    $data_matricula = $_POST['data_matricula'] ?: date('Y-m-d');
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($nome === '') {
        $erro = 'O nome é obrigatório.';
    } else {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE alunos SET nome=?, email=?, telefone=?, data_nascimento=?, data_matricula=?, ativo=? WHERE id=?');
            $stmt->execute([$nome, $email, $telefone, $data_nascimento, $data_matricula, $ativo, $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO alunos (nome, email, telefone, data_nascimento, data_matricula, ativo) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$nome, $email, $telefone, $data_nascimento, $data_matricula, $ativo]);
        }
        header('Location: alunos_list.php?msg=' . urlencode('Aluno salvo com sucesso!'));
        exit;
    }
    $aluno = compact('nome', 'email', 'telefone', 'data_nascimento', 'data_matricula', 'ativo');
}

require __DIR__ . '/../header.php';
?>

<h1><?= $id ? 'Editar Aluno' : 'Novo Aluno' ?></h1>
<p>Preencha os dados do aluno</p>

<div>
    <?php if ($erro) : ?>
        <div><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Nome *</label>
            <input type="text" name="nome" required value="<?= htmlspecialchars($aluno['nome']) ?>">
        </div>
        <div>
            <label>E-mail</label>
            <input type="email" name="email" value="<?= htmlspecialchars($aluno['email'] ?? '') ?>">
        </div>
        <div>
            <label>Telefone</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($aluno['telefone'] ?? '') ?>">
        </div>
        <div>
            <label>Data de nascimento</label>
            <input type="date" name="data_nascimento" value="<?= htmlspecialchars($aluno['data_nascimento'] ?? '') ?>">
        </div>
        <div>
            <label>Data de matrícula</label>
            <input type="date" name="data_matricula" value="<?= htmlspecialchars($aluno['data_matricula'] ?? date('Y-m-d')) ?>">
        </div>
        <div>
            <label><input type="checkbox" name="ativo" <?= !empty($aluno['ativo']) ? 'checked' : '' ?>> Aluno ativo</label>
        </div>

        <div>
            <button type="submit">Salvar</button>
            <a href="alunos_list.php">Cancelar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
