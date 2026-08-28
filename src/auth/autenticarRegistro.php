<?php

require_once '../config/conexao.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($nome) || empty($email) || empty($password)) {
    die("Preencha todos os campos.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("E-mail inválido.");
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare(
        "SELECT id FROM usuarios WHERE email = :email"
    );

    $stmt->execute([
        ':email' => $email
    ]);

    if ($stmt->fetch()) {
        die("Este e-mail já está cadastrado.");
    }

    $sql = "
        INSERT INTO usuarios (nome, email, senha)
        VALUES (:nome, :email, :senha)
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $passwordHash
    ]);

    echo "Registro concluido<br>";
    echo '<a href="login.php">Fazer login</a>';
} catch (PDOException $e) {
    die("Erro ao cadastrar usuário: " . $e->getMessage());
}
