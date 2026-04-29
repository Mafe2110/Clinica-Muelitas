<?php
$pageTitle = 'Asignar Cita - Sistema de Gestion Odontologica';
$extraHead = '
<link rel="stylesheet" type="text/css" href="vista/jquery/jquery-ui.css">
';
$extraScripts = '
<script src="vista/jquery/jquery-1.11.3.min.js"></script>
<script src="vista/jquery/jquery-ui.js"></script>
<script src="vista/js/script.js"></script>
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

<div id="frmPaciente" title="Agregar nuevo Paciente" style="display:none;">
    <form id="agregarPaciente">
        <table>
            <tr>
                <td>Documento</td>
                <td><input type="text" name="pacDocumento" id="pacDocumento" readonly="readonly"></td>
            </tr>

            <tr>
                <td>Nombres</td>
                <td><input type="text" name="pacNombres" id="pacNombres"></td>
            </tr>

            <tr>
                <td>Apellidos</td>
                <td><input type="text" name="pacApellidos" id="pacApellidos"></td>
            </tr>

            <tr>
                <td>Fecha de nacimiento</td>
                <td><input type="text" name="pacNacimiento" id="pacNacimiento"></td>
            </tr>

            <tr>
                <td>Sexo</td>
                <td>
                    <select name="pacSexo" id="pacSexo">
                        <option selected="">--- Seleccione el sexo ---</option>
                        <option>M</option>
                        <option>F</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Telefono</td>
                <td><input type="text" name="pacTelefono" id="pacTelefono"></td>
            </tr>
        </table>
    </form>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>