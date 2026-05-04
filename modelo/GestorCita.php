<?php

class GestorCita
{
    private function esc($conexion, $valor)
    {
        return $conexion->obtenerMysqli()->real_escape_string(trim((string)$valor));
    }

    public function agregarCita($cita)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return 0;
        }

        $fecha = $this->esc($conexion, $cita->obtenerFecha());
        $hora = $this->esc($conexion, $cita->obtenerHora());
        $paciente = $this->esc($conexion, $cita->obtenerPaciente());
        $medico = $this->esc($conexion, $cita->obtenerMedico());
        $consultorio = $this->esc($conexion, $cita->obtenerConsultorio());
        $estado = $this->esc($conexion, $cita->obtenerEstado());
        $observaciones = $this->esc($conexion, $cita->obtenerObservaciones());

        $sql = "INSERT INTO citas (CitFecha, CitHora, CitPaciente, CitMedico, CitConsultorio, CitEstado, CitObservaciones)
                VALUES ('$fecha', '$hora', '$paciente', '$medico', '$consultorio', '$estado', '$observaciones')";

        $conexion->consulta($sql);
        $citaId = $conexion->obtenerCitaId();
        $conexion->cerrar();

        return $citaId;
    }

    public function consultarCitaPorId($id)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $id = (int)$id;

        $sql = "SELECT pacientes.*, medicos.*, consultorios.*, citas.*
                FROM citas
                INNER JOIN pacientes ON citas.CitPaciente = pacientes.PacIdentificacion
                INNER JOIN medicos ON citas.CitMedico = medicos.MedIdentificacion
                INNER JOIN consultorios ON citas.CitConsultorio = consultorios.ConNumero
                WHERE citas.CitNumero = $id";

        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function consultarCitaPorDocumento($doc)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $doc = $this->esc($conexion, $doc);

        $sql = "SELECT *
                FROM citas
                WHERE CitPaciente = '$doc'
                AND LOWER(CitEstado) = 'solicitada'
                ORDER BY CitFecha, CitHora";

        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function consultarPaciente($doc)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $doc = $this->esc($conexion, $doc);

        $sql = "SELECT * FROM pacientes WHERE PacIdentificacion = '$doc'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function agregarPaciente($paciente)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return 0;
        }

        $identificacion = $this->esc($conexion, $paciente->obtenerIdentificacion());
        $nombres = $this->esc($conexion, $paciente->obtenerNombres());
        $apellidos = $this->esc($conexion, $paciente->obtenerApellidos());
        $fechaNacimiento = $this->esc($conexion, $paciente->obtenerFechaNacimiento());
        $sexo = $this->esc($conexion, $paciente->obtenerSexo());
        $telefono = $this->esc($conexion, $paciente->obtenerTelefono());

        $sql = "INSERT INTO pacientes (PacIdentificacion, PacNombres, PacApellidos, PacFechaNacimiento, PacSexo, PacTelefono)
                VALUES ('$identificacion', '$nombres', '$apellidos', '$fechaNacimiento', '$sexo', '$telefono')";

        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();

        return $filasAfectadas;
    }

    public function consultarMedicos()
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $sql = "SELECT * FROM medicos";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function consultarConsultorios()
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $sql = "SELECT * FROM consultorios";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function consultarHorasDisponibles($med, $fech)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return false;
        }

        $med = $this->esc($conexion, $med);
        $fech = $this->esc($conexion, $fech);

        $sql = "SELECT hora
                FROM horas
                WHERE hora NOT IN (
                    SELECT CitHora
                    FROM citas
                    WHERE CitMedico = '$med'
                    AND CitFecha = '$fech'
                    AND LOWER(CitEstado) = 'solicitada'
                )";

        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();

        return $result;
    }

    public function cancelarCita($cita)
    {
        $conexion = new Conexion();

        if (!$conexion->abrir()) {
            return 0;
        }

        $cita = (int)$cita;

        $sql = "UPDATE citas
                SET CitEstado = 'Cancelada'
                WHERE CitNumero = $cita";

        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();

        return $filasAfectadas;
    }
}