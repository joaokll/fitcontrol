<?php

require_once __DIR__ . '/../database/config.php';

if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
