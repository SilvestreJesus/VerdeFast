<?php
// controller/auth/conexion.php

class RedisConnection {
    private $redis;

    public function __construct() {
        $this->redis = new Redis();

        // Verificar la conexión a Internet
        if ($this->esConexiónInternetDisponible()) {
            error_log("🌐 Conexión a Internet detectada. Usando Redis en la nube.");
            $this->redis->connect('redis-14432.c9.us-east-1-2.ec2.redns.redis-cloud.com', 14432);
            $this->redis->auth('verdefast'); 
        } else {
            error_log("🚫 Sin Internet. Usando Redis local.");
            $this->redis->connect('localhost', 6379);
        }
    }

    // Método para verificar si la conexión a Internet está disponible
    private function esConexiónInternetDisponible(): bool {
        $conexión = @fsockopen('www.google.com', 80, $errno, $errstr, 5);
        if ($conexión) {
            fclose($conexión);
            return true; 
        }
        return false; 
    }

    // Método para obtener la instancia de Redis
    public function getRedis() {
        return $this->redis;
    }
}
?>
