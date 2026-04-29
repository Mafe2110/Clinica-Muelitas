<?php

class Controlador
{
    public function verPagina($ruta)
    {
        require_once __DIR__ . '/../' . $ruta;
    }

    public function cargarAsignar()
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicos();
        $result2 = $gestorCita->consultarConsultorios();
        require_once __DIR__ . '/../vista/asignar.php';
    }

    public function agregarCita($doc, $med, $fec, $hor, $con)
    {
        $cita = new Cita(null, $fec, $hor, $doc, $med, $con, 'Solicitada', 'Ninguna');
        $gestorCita = new GestorCita();
        $id = $gestorCita->agregarCita($cita);
        $result = $gestorCita->consultarCitaPorId($id);
        require_once __DIR__ . '/../vista/confirmarCita.php';
    }

    public function consultarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorDocumento($doc);
        require_once __DIR__ . '/../vista/fragmentos/consultarCitas.php';
    }

    public function cancelarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorDocumento($doc);
        require_once __DIR__ . '/../vista/fragmentos/cancelarCitas.php';
    }

    public function consultarPaciente($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPaciente($doc);
        require_once __DIR__ . '/../vista/fragmentos/consultarPaciente.php';
    }

    public function agregarPaciente($doc, $nom, $ape, $fech, $sex, $tel = '')
    {
        $paciente = new Paciente($doc, $nom, $ape, $fech, $sex);
        $gestorCita = new GestorCita();
        $registro = $gestorCita->agregarPaciente($paciente);

        if ($registro > 0) {
            echo "Paciente insertado con exito";
        } else {
            echo "Error al insertar el nuevo paciente";
        }
    }

    public function consultarHorasDisponibles($med, $fech)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarHorasDisponibles($med, $fech);
        require_once __DIR__ . '/../vista/fragmentos/consultarHoras.php';
    }

    public function verCita($cita)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorId($cita);
        require_once __DIR__ . '/../vista/confirmarCita.php';
    }

    public function confirmarCancelarCita($cita)
    {
        $gestorCita = new GestorCita();
        $registros = $gestorCita->cancelarCita($cita);

        if ($registros > 0) {
            echo "La cita se ha cancelado con exito";
        } else {
            echo "Error al cancelar cita, intente de nuevo";
        }
    }
}