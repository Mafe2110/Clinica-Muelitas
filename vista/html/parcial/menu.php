<?php if (isset($_SESSION['usuario_id'])) { ?>
<ul id="menu">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="index.php?accion=registrarPaciente">Registrar paciente</a></li>
    <li><a href="index.php?accion=asignar">Asignar</a></li>
    <li><a href="index.php?accion=consultar">Consultar</a></li>
    <li><a href="index.php?accion=cancelar">Cancelar</a></li>
    <li><a href="index.php?accion=logout">Salir</a></li>
</ul>
<?php } ?>