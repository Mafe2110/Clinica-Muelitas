<?php
$pageTitle = 'Cancelar Cita - Sistema de Gestion Odontologica';
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
    <h2>Cancelar Cita</h2>

    <table>
        <tr>
            <td>Documento del paciente</td>
            <td><input type="text" name="cancelarDocumento" id="cancelarDocumento"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" value="Cancelar" id="btnCancelar">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="paciente3"></div>
            </td>
        </tr>
    </table>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>