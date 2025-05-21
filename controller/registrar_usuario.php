<?php
require '../usuarios.php';

$controlador = new ControladorUsuarios();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fechaNacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$telefono = $_POST['telefono'];
$domicilio = $_POST['domicilio'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];

try {
    $controlador->crear([
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'fecha_nacimiento' => $fechaNacimiento,
        'genero' => $genero,
        'telefono' => $telefono,
        'domicilio' => $domicilio,
        'correo' => $correo,
        'pass' => $pass,
    ]);
    header('Location: ../../view/main/index.php?ok=2');
} catch (Exception $e) {
    header('Location: ../../view/form/registrar_usuario.php?error=1');
}
