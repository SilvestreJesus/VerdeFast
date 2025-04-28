<?php
// model/usuarios.php

include_once(__DIR__ . '/../controller/auth/conexion.php');

class ModeloUsuarios {
    private Redis $redis;

    public function __construct() {
        
        $redisConnection = new RedisConnection();
        $this->redis = $redisConnection->getRedis(); 
    }

    // Método para verificar si el correo ya está registrado
    private function correoExistente(string $correo): bool {
        $ids = $this->redis->sMembers('usuarios');
        foreach ($ids as $id) {
            $usuario = $this->redis->hGetAll("usuario:$id");
            if (isset($usuario['correo']) && $usuario['correo'] == $correo) {
                return true; 
            }
        }
        return false;
    }

    public function crearUsuario(string $nombre, string $apellidos, string $correo, string $pass, string $telefono, string $genero, string $fecha_nacimiento, string $domicilio): int {
        // Verificar si el correo ya está registrado
        if ($this->correoExistente($correo)) {
            return -1; 
        }

        $id = $this->redis->incr('usuarios:id');
        $this->redis->hMSet("usuario:$id", [
            'id' => $id, 
            'nombre' => $nombre,
            'apellidos' =>$apellidos,
            'correo' => $correo,
            'pass_hash' => password_hash($pass, PASSWORD_DEFAULT),
            'telefono' => $telefono,
            'genero' => $genero,
            'fecha_nacimiento' => $fecha_nacimiento,
            'domicilio' => $domicilio,
            'rol' => "cliente",
        ]);
        $this->redis->sAdd('usuarios', $id);
        return $id;
    }

    public function obtenerUsuario(int $id): array {
        return $this->redis->hGetAll("usuario:$id");
    }

    public function actualizarUsuario(int $id, array $datos): bool {
        if (!$this->redis->exists("usuario:$id")) {
            return false;
        }
        return $this->redis->hMSet("usuario:$id", $datos);
    }

    public function eliminarUsuario(int $id): bool {
        $this->redis->del("usuario:$id");
        return $this->redis->sRem('usuarios', $id) > 0;
    }

    public function listarUsuarios(): array {
        $ids = $this->redis->sMembers('usuarios');
        $usuarios = [];
        foreach ($ids as $id) {
            $usuarios[] = $this->redis->hGetAll("usuario:$id");
        }
        return $usuarios;
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $ids = $this->redis->sMembers('usuarios');
        foreach ($ids as $id) {
            $usuario = $this->redis->hGetAll("usuario:$id");
            if (isset($usuario['correo']) && $usuario['correo'] == $correo) {
                return $usuario;
            }
        }
        return null; 
    }

    public function obtenerUsuarioPorCorreoYTelefono($correo, $telefono) {
        $usuarios = $this->redis->keys('usuario:*');

        foreach ($usuarios as $key) {
            $usuario = $this->redis->hGetAll($key);
            if ($usuario['correo'] === $correo && $usuario['telefono'] === $telefono) {
                return [
                    'id' => $usuario['id_usuario'], // o 'id' según como lo guardes
                    'nombre' => $usuario['nombre'],
                ];
            }
        }
        return null;
    }
}
?>
