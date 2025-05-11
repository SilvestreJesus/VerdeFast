<?php
// iniciar_sesion.php

session_start();  
require_once __DIR__ . '/../../controller/usuarios.php';

$controlador = new ControladorUsuarios();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    $resultado = $controlador->iniciarSesion($correo, $pass);

    if (isset($resultado['success'])) {
        
        $rol = $_SESSION['rol'];  

        // Redirige según el rol del usuario
        if ($rol === 'administrador') {
            header('Location: /view/admin/registro_tecnico.php');
        } elseif ($rol === 'cliente') {
            header('Location: /view/form/selec_planta.php');
        } elseif ($rol === 'tecnico') {
            header('Location: /view/tecnico/registro_planta.php');
        } else {
            header('Location: /view/form/selec_planta.php');
        }
        exit;  
    } else {
        // Si el login falla, redirige al login con un error
        header('Location: /view/form/login.php?error=1');
        exit;
    }
}
?>
