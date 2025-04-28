<?php
// model/redis_test.php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Autoincrementar ID de usuario
$userId = $redis->incr('usuarios:id');

// Crear usuario como hash
$redis->hMSet("usuario:$userId", [
    'name' => 'Juan Pérez',
    'email' => 'juan@verdefast.com',
    'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
]);

// Agregar ID al set general de usuarios
$redis->sAdd('usuarios', $userId);

// Leer el usuario
$usuario = $redis->hGetAll("usuario:$userId");

// Mostrar
echo "Usuario creado con ID $userId:\n";
print_r($usuario);
?>
