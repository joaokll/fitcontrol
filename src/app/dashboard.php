<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?restrito");
    exit;
}
