<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="autenticar.php" method="POST">
        
        <div>    
            <label>
            Email: 
            </label>
            <input type="email" name="email" required> <br> </br>

            <label>
            Senha: 
            </label>
            <input type="password" name="password" required> <br> </br>

            <button type="subtmit">
            Entrar
            </button> <br> </br>
        </div>
    
    </form>
</body>
</html>