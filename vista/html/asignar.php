<?php
$pageTitle = 'Asignar Cita - Sistema de Gestion Odontologica';
$extraHead = '
<link rel="stylesheet" type="text/css" href="/clinica_muelitas/vista/jquery/jquery-ui.css">
';
$extraScripts = '
<script src="/clinica_muelitas/vista/jquery/jquery-1.11.3.min.js"></script>
<script src="/clinica_muelitas/vista/jquery/jquery-ui.js"></script>
<script src="/clinica_muelitas/vista/js/script.js"></script>
';
require_once __DIR__ . '/parcial/header.php';
require_once __DIR__ . '/parcial/menu.php';
?>

<div id="contenido">
    <h2>Asignar citas</h2>

    <form action="index.php?accion=guardarCita" method="POST" id="frmasignar">
        <table>
            <tr>
                <td>Documento del paciente</td>
                <td><input type="text" name="asignarDocumento" id="asignarDocumento"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="button" name="asignarConsultar" id="asignarConsultar" value="Consultar">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div id="paciente"></div>
                </td>
            </tr>

            <tr>
                <td>Médico</td>
                <td>
                    <select id="medico" name="medico" onchange="cargarHoras()">
                        <option selected="selected" value="-1">- Seleccione Médico -</option>
                        <?php while ($fila = $result->fetch_object()) { ?>
                            <option value="<?php echo $fila->MedIdentificacion; ?>">
                                <?php echo $fila->MedNombres . " " . $fila->MedApellidos; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Fecha</td>
                <td><input type="text" id="fecha" name="fecha" onchange="cargarHoras()"></td>
            </tr>

            <tr>
                <td>Hora</td>
                <td>
                    <select id="hora" name="hora" onmousedown="seleccionarHora()">
                        <option disabled="disabled" selected="selected" value="-1">- Seleccione la hora -</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Consultorio</td>
                <td>
                    <select id="consultorio" name="consultorio">
                        <option selected="selected" value="0">- Seleccione consultorio -</option>
                        <?php while ($fila2 = $result2->fetch_object()) { ?>
                            <option value="<?php echo $fila2->ConNumero; ?>">
                                <?php echo $fila2->ConNumero . " " . $fila2->ConNombre; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" value="Enviar" id="asignarEnviar" name="asignarEnviar">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>