<?php

class GestorUsuario
{
    private function esc($conexion, $valor)
    {
        return $conexion->obtenerMysqli()->real_escape_string(trim((string)$valor));
    }

    // En gestorusuarios.php
    public function validarLogin($correo, $clave) {
        $conexion = new Conexion();
        if (!$conexion->abrir()) return false;

        $correo = $this->esc($conexion, $correo);

        // Unimos las tablas para obtener los datos del médico al loguearse
        $sql = "SELECT u.UsuId, u.UsuCorreo, u.UsuPassword, 
                    m.MedIdentificacion, m.MedNombres, m.MedApellidos
                FROM usuarios u
                INNER JOIN medicos m ON m.MedUsuId = u.UsuId
                WHERE u.UsuCorreo = '$correo'
                LIMIT 1";

        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        if ($result && $result->num_rows === 1) {
            $usuario = $result->fetch_object();
            // Verificamos la contraseña (asumiendo que usas password_hash)
            if (password_verify($clave, $usuario->UsuPassword)) {
                return $usuario;
            }
        }
        return false;
    }

    public function correoExiste($correo) {
        $conexion = new Conexion();
        if (!$conexion->abrir()) return false;

        $correo = $this->esc($conexion, $correo);
        $sql = "SELECT UsuId FROM usuarios WHERE UsuCorreo = '$correo'";
        
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return ($result && $result->num_rows > 0); // Retorna true si ya existe
    }

    public function registrarMedico($identificacion, $nombres, $apellidos, $correo, $password) {
        // 1. PRIMERO VALIDAMOS EL CORREO
        if ($this->correoExiste($correo)) {
            return -1; // Devolvemos -1 para identificar que el error es por correo duplicado
        }

        $conexion = new Conexion();
        if (!$conexion->abrir()) return 0;

        $identificacion = $this->esc($conexion, $identificacion);
        $nombres = $this->esc($conexion, $nombres);
        $apellidos = $this->esc($conexion, $apellidos);
        $correo = $this->esc($conexion, $correo);
        $passHash = password_hash($password, PASSWORD_DEFAULT);

        $sqlUsu = "INSERT INTO usuarios (UsuCorreo, UsuPassword) VALUES ('$correo', '$passHash')";
        $conexion->consulta($sqlUsu);
        $usuId = $conexion->obtenerCitaId();

        if ($usuId > 0) {
            $sqlMed = "INSERT INTO medicos (MedIdentificacion, MedNombres, MedApellidos, MedUsuId) 
                       VALUES ('$identificacion', '$nombres', '$apellidos', $usuId)";
            $conexion->consulta($sqlMed);
            $resultado = $conexion->obtenerFilasAfectadas();
            $conexion->cerrar();
            return $resultado;
        }

        $conexion->cerrar();
        return 0;
    }
}