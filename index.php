<?php
session_start();

require_once __DIR__ . '/controlador/Controlador.php';
require_once __DIR__ . '/modelo/Conexion.php';
require_once __DIR__ . '/modelo/Cita.php';
require_once __DIR__ . '/modelo/Paciente.php';
require_once __DIR__ . '/modelo/GestorCita.php';
require_once __DIR__ . '/modelo/GestorUsuario.php';

$controlador = new Controlador();
$accion = $_GET['accion'] ?? null;

$accionesPublicas = ['login', 'validarLogin', 'registrarMedico', 'guardarMedico'];

if (!isset($_SESSION['usuario_id']) && !in_array($accion, $accionesPublicas, true)) {
    header('Location: index.php?accion=login');
    exit;
}

if ($accion === null) {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php?accion=login');
        exit;
    }

    $controlador->verPagina('vista/html/inicio.php');
    exit;
}

if ($accion === 'login') {
    $controlador->cargarLogin();
}
elseif ($accion === 'validarLogin') {
    $controlador->validarLogin($_POST['correo'] ?? '', $_POST['password'] ?? '');
}
elseif ($accion === 'logout') {
    $controlador->cerrarSesion();
}
elseif ($accion === 'asignar') {
    $controlador->cargarAsignar();
}
elseif ($accion === 'consultar') {
    $controlador->verPagina('vista/html/consultar.php');
}
elseif ($accion === 'cancelar') {
    $controlador->verPagina('vista/html/cancelar.php');
}
elseif ($accion === 'registrarPaciente') {
    $controlador->cargarRegistrarPaciente($_GET['documento'] ?? '', $_GET['msg'] ?? '');
}
elseif ($accion === 'guardarPaciente') {
    $controlador->guardarPaciente(
        $_POST['pacDocumento'] ?? '',
        $_POST['pacNombres'] ?? '',
        $_POST['pacApellidos'] ?? '',
        $_POST['pacNacimiento'] ?? '',
        $_POST['pacSexo'] ?? '',
        $_POST['pacTelefono'] ?? ''
    );
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
elseif ($accion === 'consultarHoras') {
    $controlador->consultarHorasDisponibles($_GET['medico'] ?? '', $_GET['fecha'] ?? '');
}
elseif ($accion === 'verCita') {
    $controlador->verCita($_GET['numero'] ?? 0);
}
elseif ($accion === 'confirmarCancelar') {
    $controlador->confirmarCancelarCita($_GET['numero'] ?? 0);
}
elseif ($accion === 'registrarMedico') {
    $controlador->cargarRegistrarMedico();
}
elseif ($accion === 'guardarMedico') {
    $controlador->guardarMedico(
        $_POST['medIdentificacion'] ?? '',
        $_POST['medNombres'] ?? '',
        $_POST['medApellidos'] ?? '',
        $_POST['medCorreo'] ?? '',
        $_POST['medPassword'] ?? ''
    );
}
else {
    $controlador->verPagina('vista/html/inicio.php');
}