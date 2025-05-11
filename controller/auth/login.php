<?php
// controller/auth/login.php

require '../../model/usuarios.php';

class LoginController {
    private ModeloUsuarios $modelo;

    public function __construct() {
        $this->modelo = new ModeloUsuarios();
    }

    public function iniciarSesion(string $correo, string $pass): bool {
        $ids = $this->modelo->listarUsuarios();
        foreach ($ids as $usuario) {
            if (isset($usuario['correo']) && $usuario['correo'] === $correo) {
                if (password_verify($pass, $usuario['pass_hash'])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }
}

$init = new LoginController();

if (isset($_POST['correo']) && isset($_POST['pass'])) {
    $datos = $init->iniciarSesion($_POST['correo'], $_POST['pass']);
    if (!$datos) {
        header('Location: ../../view/form/login.php?error=1');
    } else {
        header('Location: ../../view/main/panel.php');
    }
}
?>