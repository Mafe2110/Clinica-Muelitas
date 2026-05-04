<?php
$pageTitle = 'Iniciar sesión - Sistema de Gestion Odontologica';
$error = $_GET['error'] ?? '';
$registro = $_GET['registro'] ?? ''; // Para atrapar el mensaje de éxito
require_once __DIR__ . '/parcial/header.php';
?>

<div id="contenido">
    <h2>Iniciar sesión</h2>

    <?php if ($error === '1') { ?>
        <p style="color:red;">Correo o contraseña incorrectos.</p>
    <?php } ?>
    <?php if ($registro === 'success') { ?>
        <p style="color:green;">Médico registrado con éxito. Ya puedes iniciar sesión.</p>
    <?php } ?>

    <form action="index.php?accion=validarLogin" method="POST">
        <table>
            <tr>
                <td>Correo</td>
                <td><input type="email" name="correo" required></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Entrar">
                </td>
            </tr>
        </table>
    </form>
    
    <!-- Aquí agregamos el botón/enlace para registrarse -->
    <div style="text-align: center; margin-top: 20px;">
        <p>¿Eres un nuevo médico?</p>
        <a href="index.php?accion=registrarMedico" class="boton-suave">Regístrate aquí</a>
    </div>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>