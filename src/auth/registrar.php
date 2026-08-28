<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="autenticarRegistro.php" method="POST">

    <div>

        <label>
            Email*
        </label>

        <input type="email" name="email" required>

        <br><br>

        <label>
            Senha*
        </label>

        <input type="password" name="password" required>

        <br><br>

        <label>
            Nome de usuário
        </label>

        <input type="text" name="nome" required>

        <br><br>

        <button type="submit">
            Registrar
        </button>

        <input type="reset" value="Cancelar">

    </div>

</form>

</body>
</html>


