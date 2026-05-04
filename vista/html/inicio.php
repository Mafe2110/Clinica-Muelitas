<?php
$pageTitle = 'Inicio - Sistema de Gestion Odontologica';
require_once __DIR__ . '/parcial/header.php';
require_once __DIR__ . '/parcial/menu.php';
?>

<div id="contenido">
    <h2>Información general</h2>
    <p>
        El sistema de gestión odontológica permite administrar la información
        de los pacientes y sus citas a través de una interfaz amigable.
    </p>

    <p>El sistema cuenta con las siguientes secciones para el medico:</p>

    <ul>
        <li>Registrar a un paciente</li>
        <li>Asignar cita a un paciente</li>
        <li>Consultar cita de un paciente</li>
        <li>Cancelar cita de un paciente</li>
    </ul>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>