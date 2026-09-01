<?php

require_once __DIR__ . '/database/config.php';

if (!empty($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
} else {
    header('Location: autenticacao/login.php');
}
exit;
