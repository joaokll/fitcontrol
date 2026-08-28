<?php

session_start();

require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['password'] ?? '';

    if (!$email || empty($senha)) {
        die("E-mail ou senha inválidos.");
    }

    try {
        $stmt = $pdo->prepare(
            "SELECT * FROM usuarios WHERE email = :email"
        );

        $stmt->execute([
            ':email' => $email
        ]);

        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            header("Location: ../app/dashboard.php");
            exit;
        } else {
            echo "E-mail ou senha incorretos.";
        }
    } catch (PDOException $e) {
        die("Erro na autenticação: " . $e->getMessage());
    }
}
