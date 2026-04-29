<?php
$pageTitle = 'Consultar Cita - Sistema de Gestion Odontologica';
$extraScripts = '
<script src="vista/jquery/jquery-1.11.3.min.js"></script>
<script src="vista/js/script.js"></script>
';
require_once __DIR__ . '/parcial/header.php';
require_once __DIR__ . '/parcial/menu.php';
?>

<div id="contenido">
    <h2>Consultar Cita</h2>

    <form action="#" method="post" id="frmConsultar">
        <table>
            <tr>
                <td>Documento del paciente</td>
                <td><input type="text" name="consultarDocumento" id="consultarDocumento"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" value="Consultar" onclick="consultarConsultar()">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="paciente2"></div>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>