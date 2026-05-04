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
        require_once __DIR__ . '/../vista/html/asignar.php';
    }

    public function agregarCita($doc, $med, $fec, $hor, $con)
    {
        $cita = new Cita(null, $fec, $hor, $doc, $med, $con, 'Solicitada', 'Ninguna');
        $gestorCita = new GestorCita();
        $id = $gestorCita->agregarCita($cita);
        $result = $gestorCita->consultarCitaPorId($id);
        require_once __DIR__ . '/../vista/html/confirmarCita.php';
    }

    public function consultarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorDocumento($doc);
        require_once __DIR__ . '/../vista/html/SubProcesos/consultarCitas.php';
    }

    public function cancelarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorDocumento($doc);
        require_once __DIR__ . '/../vista/html/SubProcesos/cancelarCitas.php';
    }

    public function consultarPaciente($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPaciente($doc);
        $documento = $doc;
        require_once __DIR__ . '/../vista/html/SubProcesos/consultarPaciente.php';
    }

    public function agregarPaciente($doc, $nom, $ape, $fech, $sex, $tel = '')
    {
        $paciente = new Paciente($doc, $nom, $ape, $fech, $sex, $tel);
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
        require_once __DIR__ . '/../vista/html/SubProcesos/consultarHoras.php';
    }

    public function verCita($cita)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorId($cita);
        require_once __DIR__ . '/../vista/html/confirmarCita.php';
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

    public function cargarRegistrarPaciente($documento = '', $msg = '')
    {
        require_once __DIR__ . '/../vista/html/registrarPaciente.php';
    }

    public function guardarPaciente($doc, $nom, $ape, $fech, $sex, $tel = '')
    {
        $paciente = new Paciente($doc, $nom, $ape, $fech, $sex, $tel);
        $gestorCita = new GestorCita();
        $registro = $gestorCita->agregarPaciente($paciente);

        if ($registro > 0) {
            header('Location: index.php?accion=registrarPaciente&documento=' . urlencode($doc) . '&msg=ok');
            exit;
        } else {
            header('Location: index.php?accion=registrarPaciente&documento=' . urlencode($doc) . '&msg=error');
            exit;
        }
    }

    public function cargarLogin()
    {
        require_once __DIR__ . '/../vista/html/login.php';
    }

    // En Controlador.php
    public function validarLogin($correo, $clave) {
        $gestorUsuario = new GestorUsuario();
        $usuario = $gestorUsuario->validarLogin($correo, $clave);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario->UsuId;
            $_SESSION['usuario_correo'] = $usuario->UsuCorreo;
            // Guardamos los datos del médico en la sesión
            $_SESSION['medico_nombre'] = $usuario->MedNombres . " " . $usuario->MedApellidos;
            $_SESSION['medico_id'] = $usuario->MedIdentificacion;

            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php?accion=login&error=1');
            exit;
        }
    }

    public function cerrarSesion()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?accion=login');
        exit;
    }

    public function cargarRegistrarMedico() {
        require_once __DIR__ . '/../vista/html/registrarMedico.php';
    }

    public function guardarMedico($ide, $nom, $ape, $cor, $pas) {
        $gestorUsuario = new GestorUsuario();
        $registro = $gestorUsuario->registrarMedico($ide, $nom, $ape, $cor, $pas);

        if ($registro > 0) {
            header('Location: index.php?accion=login&registro=success');
        } elseif ($registro === -1) {
            // El correo ya existe
            header('Location: index.php?accion=registrarMedico&error=correo');
        } else {
            header('Location: index.php?accion=registrarMedico&error=1');
        }
        exit;
    }
}