
    switch ($entrarOpcao) {
        case 'login':
            echo"Você escolheu a opção de se logar!";
            ?>
            <div class="container1">
                <form method="POST">
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario1"> <br>
                    <label>Senha:</label>
                    <input type="password" name="senha" id="senha1"> <br>
                    <button type="submit">Login</button>
                </form>
            </div>
            <?php
            break;
        case 'registrar':
            echo"Você escolheu a opção de se registrar!";
            ?>
            <div class="container1">
                <form method="POST">
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario2"> <br>
                    <label>Senha:</label>
                    <input type="password" name="senha" id="senha2"> <br>
                    <button type="submit">Registrar</button>
                    </form>
            </div>
            <?php
            break;
        default:
            # code...
            break;
    }

