<?php

require_once __DIR__ . '/../database/config.php';
session_unset();
session_destroy();
header('Location: /fitcontrol-master/autenticacao/login.php');
exit;
