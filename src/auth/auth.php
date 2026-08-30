<?php

require_once __DIR__ . '/src/database/config.php';

if (empty($_SESSION['usuario_id'])) {
    header('Location: /src/auth/login.php');
    exit;
}
