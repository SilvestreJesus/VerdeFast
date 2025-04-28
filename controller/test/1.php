<?php
// controller/test/1.php

require '../usuarios.php';

$controlador = new ControladorUsuarios();

$controlador->crear([
    'nombre' => 'admin',
    'apellidos' => 'admin',
    'correo' => 'admin@verdefast.com',
    'pass' => 'admin123', 
    'telefono' => '1234567890',
    'genero' => 'Masculino',
    'fecha_nacimiento' => '01/01/1980',
    'domicilio' => 'Calle Ficticia 123',
    'rol' => 'administrador'
]);

header('Location: ../../view/main/index.php?ok=2');
?>