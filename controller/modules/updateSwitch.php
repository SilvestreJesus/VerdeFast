<?php
include '../auth/conexion.php';
$conexionRedis = new RedisConnection();
$redis = $conexionRedis->getRedis();

if (isset($_POST['name']) && isset($_POST['value'])) {
    $name = $_POST['name'];
    $value = $_POST['value'];

    $redis->set($name, $value);
}
?>
