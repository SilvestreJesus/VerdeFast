<?php
session_start();
require_once '../../model/usuarios.php';

$model = new ModeloUsuarios();

// Si hay token de sesión, eliminarlo de Redis
/*if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];
    $model->redis->del("token:$token");
}*/

// Limpiar toda la sesión
session_unset();
session_destroy();

// Redirigir al login
header('Location: ../../view/main/index.php?logout=1');
exit;
