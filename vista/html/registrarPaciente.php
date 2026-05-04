<?php
$pageTitle = 'Registrar Paciente - Sistema de Gestion Odontologica';
$documento = $_GET['documento'] ?? '';
$msg = $_GET['msg'] ?? '';

require_once __DIR__ . '/parcial/header.php';
require_once __DIR__ . '/parcial/menu.php';
?>

<div id="contenido">
    <h2>Registrar paciente</h2>

    <?php if ($msg === 'ok') { ?>
        <p>Paciente registrado correctamente.</p>
    <?php } elseif ($msg === 'error') { ?>
        <p>No se pudo registrar el paciente.</p>
    <?php } ?>

    <form action="index.php?accion=guardarPaciente" method="POST">
        <table>
            <tr>
                <td>Documento</td>
                <td>
                    <input type="text" name="pacDocumento" id="pacDocumento"
                        value="<?php echo htmlspecialchars($documento ?? ''); ?>">
                </td>
            </tr>

            <tr>
                <td>Nombres</td>
                <td><input type="text" name="pacNombres" id="pacNombres" required></td>
            </tr>

            <tr>
                <td>Apellidos</td>
                <td><input type="text" name="pacApellidos" id="pacApellidos" required></td>
            </tr>

            <tr>
                <td>Fecha de nacimiento</td>
                <td><input type="date" name="pacNacimiento" id="pacNacimiento" required></td>
            </tr>

            <tr>
                <td>Sexo</td>
                <td>
                    <select name="pacSexo" id="pacSexo" required>
                        <option value="">--- Seleccione el sexo ---</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Teléfono</td>
                <td><input type="text" name="pacTelefono" id="pacTelefono"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" value="Guardar">
                    <a href="index.php?accion=asignar" class="boton-suave">Volver a asignar</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>