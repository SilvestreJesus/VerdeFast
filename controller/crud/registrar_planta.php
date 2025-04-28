<?php
// controller/crud/registrar_planta.php

require '../planta.php'; 

$controlador = new GuardarPlanta();

$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$nombre_planta = $_POST['nombre_planta'];
$tipo = $_POST['tipo'];
$familia = $_POST['familia'];
$cantidad = $_POST['cantidad'];
$tamaño_largo = $_POST['tamaño_largo'];
$tamaño_ancho = $_POST['tamaño_ancho'];


// controller/iniciar_sesion.php
session_start();

require_once '../../model/usuarios.php';

$modeloUsuarios = new ModeloUsuarios();
$usuario = $modeloUsuarios->obtenerUsuarioPorCorreoYTelefono($_POST['correo'], $_POST['telefono']);

if ($usuario) {
    $_SESSION['correo'] = $_POST['correo'];
    header('Location: /view/tecnico/selec_planta.php');
} else {
    header('Location: /view/form/login.php?error=1');
}

if (!$usuario) {
    header('Location: ../../view/tecnico/registro_planta.php?invalido=1');
    exit;
}

// Si existe el usuario, ahora sí registra la planta
try {
    $resultado = $controlador->guardar([
        'correo' => $correo,
        'telefono' => $telefono,
        'nombre_planta' => $nombre_planta,
        'tipo' => $tipo,
        'familia' => $familia,
        'cantidad' => $cantidad,
        'tamaño_largo' => $tamaño_largo,
        'tamaño_ancho' => $tamaño_ancho
    ]);

    // Crear la carpeta especial si no existe
    $directorioUsuario = __DIR__ . '/../../plantas/' . $correo;

    if (!file_exists($directorioUsuario)) {
        mkdir($directorioUsuario, 0777, true);
    }

    // Guardar datos de la planta en un archivo dentro de esa carpeta
    $archivoPlanta = $directorioUsuario . '/planta_' . $resultado['id'] . '.json';
    file_put_contents($archivoPlanta, json_encode([
        'correo' => $correo,
        'telefono' => $telefono,
        'nombre_planta' => $nombre_planta,
        'tipo' => $tipo,
        'familia' => $familia,
        'cantidad' => $cantidad,
        'tamaño_largo' => $tamaño_largo,
        'tamaño_ancho' => $tamaño_ancho,
    ], JSON_PRETTY_PRINT));

    header('Location: ../../view/tecnico/registro_planta.php?ok=3');
    
} catch (Exception $e) {
    header('Location: ../../view/tecnico/registro_planta.php?invalido=1');
}
?>
