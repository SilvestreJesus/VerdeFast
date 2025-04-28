<?php
session_start();
require_once '../../model/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $correo = $_POST['correo'] ?? '';
  $password = $_POST['password'] ?? '';

  $model = new ModeloUsuarios();
  $usuario = null;

  // Buscar usuario por correo
  /*$keys = $model->redis->keys('usuario:*');
  foreach ($keys as $key) {
    $u = $model->redis->hGetAll($key);
    if (isset($u['email']) && $u['email'] === $correo) {
      $usuario = $u;
      break;
    }
  }*/

  if ($usuario && password_verify($password, $usuario['password_hash'])) {
    $_SESSION['user'] = $usuario;
    header('Location: ../../view/principal/index.php?ok=1');
    exit;
  } else {
    header('Location: ../../view/principal/login.php?error=1');
    exit;
  }
}
