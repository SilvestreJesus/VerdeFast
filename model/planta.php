<?php
// model/planta.php
include_once(__DIR__ . '/../controller/auth/conexion.php');
class ModeloPlanta {
    
    private Redis $redis;

    public function __construct() {
      
        $redisConnection = new RedisConnection();
        $this->redis = $redisConnection->getRedis(); 
    }

    public function guardarPlanta(string $correo, string $telefono, string $nombre_planta, string $tipo, string $familia, string $cantidad, string $tamaño_largo, string $tamaño_ancho): int {
        $id = $this->redis->incr('planta:id');
        $this->redis->hMSet("planta:$id", [
            'correo' => $correo,
            'telefono' => $telefono,
            'nombre_planta' => $nombre_planta,
            'tipo' => $tipo,
            'familia' => $familia,
            'cantidad' => $cantidad,
            'tamaño_largo' => $tamaño_largo,
            'tamaño_ancho' => $tamaño_ancho,
        ]);

        $this->redis->sAdd('planta', $id);
        // Guardar la planta del usuario específico
        $this->redis->sAdd("usuario:$correo:plantas", $id);
        return $id;
    }

    // Método para generar un nuevo ID para la planta basado en el número de plantas del usuario
    public function generarNuevoIdPlanta($id_usuario) {
        $plantas = $this->redis->sMembers("usuario:$id_usuario:plantas");
        $nuevoId = count($plantas) + 1;
        return $nuevoId;
    }

    public function obtenerPlantasPorCorreo(string $correo): array {
        $ids = $this->redis->keys('planta:*');
        $plantas = [];
    
        foreach ($ids as $id) {
            $planta = $this->redis->hGetAll($id);
            if (isset($planta['correo']) && $planta['correo'] == $correo) {
                $plantas[] = $planta;
            }
        }
        return $plantas;
    }
    

    public function obtenerTiposFamilias() {
        return [
            'tipo' => ['Tubercular', 'Xerófila', 'Criogénica', 'Extremófila', 'Rizoma','Capilar'],
            'familia' => ['árboles', 'arbustos', 'hierbas', 'leñosas', 'herbáceas','suculentas']
            
        ];
    }
}
?>
