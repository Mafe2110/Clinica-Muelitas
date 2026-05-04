<?php
$pageTitle = 'Registro de Médicos';
$error = $_GET['error'] ?? '';
require_once __DIR__ . '/parcial/header.php';
?>
<div id="contenido">
    <h2>Registro de Nuevo Médico</h2>
    
    <?php if ($error === 'correo') { ?>
        <p style="color:red;">Error: El correo electrónico ya está registrado. Intenta con otro o inicia sesión.</p>
    <?php } elseif ($error === '1') { ?>
        <p style="color:red;">Ocurrió un error al registrar en la base de datos.</p>
    <?php } ?>

    <form action="index.php?accion=guardarMedico" method="POST">
       <!-- (Aquí va la misma tabla del formulario que te pasé en la respuesta anterior) -->
       <table>
            <tr><td>Identificación:</td><td><input type="text" name="medIdentificacion" required></td></tr>
            <tr><td>Nombres:</td><td><input type="text" name="medNombres" required></td></tr>
            <tr><td>Apellidos:</td><td><input type="text" name="medApellidos" required></td></tr>
            <tr><td>Correo Electrónico:</td><td><input type="email" name="medCorreo" required></td></tr>
            <tr><td>Contraseña:</td><td><input type="password" name="medPassword" required></td></tr>
            <tr><td colspan="2"><input type="submit" value="Registrar Médico"></td></tr>
        </table>
    </form>
    <p style="text-align: center;"><a href="index.php?accion=login" class="boton-suave">Volver al inicio de sesión</a></p>
</div>
<?php require_once __DIR__ . '/parcial/footer.php'; ?>