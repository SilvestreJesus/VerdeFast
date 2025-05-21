<?php
// controller/usuarios.php

require '/home/jgn1022/Proyectos/VerdeFast/model/usuarios.php';

class ControladorUsuarios {
    private ModeloUsuarios $model;

    public function __construct() {
        $this->model = new ModeloUsuarios();
    }

    public function crear($datos) {
        if (!isset($datos['nombre'], $datos['correo'], $datos['pass'], $datos['telefono'], $datos['genero'], $datos['fecha_nacimiento'], $datos['domicilio'])) {
            return ['error' => 'Faltan campos requeridos'];
        }
        $id = $this->model->crearUsuario($datos['nombre'], $datos['correo'], $datos['pass'], $datos['telefono'], $datos['genero'], $datos['fecha_nacimiento'], $datos['domicilio']);
        return ['success' => true, 'id' => $id];
    }

    public function ver($id) {
        $usuario = $this->model->obtenerUsuario($id);
        return $usuario ?: ['error' => 'Usuario no encontrado'];
    }

    public function actualizar($id, $datos) {
        if ($this->model->actualizarUsuario($id, $datos)) {
            return ['success' => true];
        }
        return ['error' => 'No se pudo actualizar'];
    }

    public function eliminar($id) {
        if ($this->model->eliminarUsuario($id)) {
            return ['success' => true];
        }
        return ['error' => 'No se pudo eliminar'];
    }

    public function listar() {
        return $this->model->listarUsuarios();
    }

    public function iniciarSesion($correo, $pass) {
        $usuario = $this->model->obtenerUsuarioPorCorreo($correo);
        
        if (!$usuario) {
            return ['error' => 'Correo no encontrado'];
        }
        
        if (password_verify($pass, $usuario['pass_hash'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['rol'] = $usuario['rol']; 
            return ['success' => true, 'rol' => $usuario['rol']];

        } else {
            return ['error' => 'Contraseña incorrecta'];
        }
    }
}
?>
