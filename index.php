<?php
require_once __DIR__ . '/controlador/Controlador.php';
require_once __DIR__ . '/modelo/Conexion.php';
require_once __DIR__ . '/modelo/Cita.php';
require_once __DIR__ . '/modelo/Paciente.php';
require_once __DIR__ . '/modelo/GestorCita.php';

$controlador = new Controlador();

$accion = $_GET['accion'] ?? null;

if ($accion === null) {
    $controlador->verPagina('vista/inicio.php');
    exit;
}

if ($accion === 'asignar') {
    $controlador->cargarAsignar();
}
elseif ($accion === 'consultar') {
    $controlador->verPagina('vista/consultar.php');
}
elseif ($accion === 'cancelar') {
    $controlador->verPagina('vista/cancelar.php');
}
elseif ($accion === 'guardarCita') {
    $controlador->agregarCita(
        $_POST['asignarDocumento'] ?? '',
        $_POST['medico'] ?? '',
        $_POST['fecha'] ?? '',
        $_POST['hora'] ?? '',
        $_POST['consultorio'] ?? ''
    );
}
elseif ($accion === 'consultarCita') {
    $controlador->consultarCitas($_GET['consultarDocumento'] ?? '');
}
elseif ($accion === 'cancelarCita') {
    $controlador->cancelarCitas($_GET['cancelarDocumento'] ?? '');
}
elseif ($accion === 'consultarPaciente') {
    $controlador->consultarPaciente($_GET['documento'] ?? '');
}
elseif ($accion === 'ingresarpaciente') {
    $controlador->agregarPaciente(
        $_GET['pacDocumento'] ?? '',
        $_GET['pacNombres'] ?? '',
        $_GET['pacApellidos'] ?? '',
        $_GET['pacNacimiento'] ?? '',
        $_GET['pacSexo'] ?? '',
        $_GET['pacTelefono'] ?? ''
    );
}
elseif ($accion === 'consultarHoras') {
    $controlador->consultarHorasDisponibles(
        $_GET['medico'] ?? '',
        $_GET['fecha'] ?? ''
    );
}
elseif ($accion === 'verCita') {
    $controlador->verCita($_GET['numero'] ?? 0);
}
elseif ($accion === 'confirmarCancelar') {
    $controlador->confirmarCancelarCita($_GET['numero'] ?? 0);
}
else {
    $controlador->verPagina('vista/inicio.php');
}