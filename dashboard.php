<?php
require_once __DIR__ . '/autenticacao/auth.php';

$totalAlunos = $pdo->query("SELECT COUNT(*) c FROM alunos WHERE ativo = 1")->fetch()['c'];
$totalPendentes = $pdo->query("SELECT COUNT(*) c FROM mensalidades WHERE status IN ('pendente','atrasado')")->fetch()['c'];
$totalFichas = $pdo->query("SELECT COUNT(*) c FROM fichas_treino")->fetch()['c'];
$receitaMes = $pdo->query("SELECT COALESCE(SUM(valor),0) s FROM mensalidades WHERE status = 'pago' AND MONTH(data_pagamento) = MONTH(CURRENT_DATE) AND YEAR(data_pagamento) = YEAR(CURRENT_DATE)")->fetch()['s'];

require __DIR__ . '/header.php';
?>

<h1>Dashboard</h1>
<p>Visão geral da academia</p>

<div>
    <div>
        <div><?= (int)$totalAlunos ?></div>
        <div>Alunos ativos</div>
    </div>
    <div>
        <div><?= (int)$totalPendentes ?></div>
        <div>Mensalidades pendentes</div>
    </div>
    <div>
        <div><?= (int)$totalFichas ?></div>
        <div>Fichas de treino</div>
    </div>
    <div>
        <div>R$ <?= number_format($receitaMes, 2, ',', '.') ?></div>
        <div>Recebido este mês</div>
    </div>
</div>

<div>
    <h2>Acesso rápido</h2>
    <div>
        <a href="alunos/alunos_list.php">Gerenciar Alunos</a>
        <a href="mensalidades/mensalidades_list.php">Gerenciar Mensalidades</a>
        <a href="fichas/fichas_list.php">Gerenciar Fichas de Treino</a>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
