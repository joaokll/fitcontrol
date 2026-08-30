<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="post" action="authRegistrar.php">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>
        <div>
            <label>E-mail</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>
        <div>
            <label>Confirmar senha</label>
            <input type="password" name="senha2" required>
        </div>
        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>


