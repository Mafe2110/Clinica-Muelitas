<?php
$pageTitle = 'Confirmar Cita - Sistema de Gestion Odontologica';
require_once __DIR__ . '/parcial/header.php';
require_once __DIR__ . '/parcial/menu.php';
?>

<div id="contenido">
    <?php
    if ($result && $result->num_rows > 0) {
        $fila = $result->fetch_object();
    ?>
        <h2>Información de la cita</h2>

        <table>
            <tr>
                <th colspan="2">Datos del Paciente</th>
            </tr>
            <tr>
                <td>Documento</td>
                <td><?php echo $fila->PacIdentificacion; ?></td>
            </tr>
            <tr>
                <td>Nombres</td>
                <td><?php echo $fila->PacNombres . " " . $fila->PacApellidos; ?></td>
            </tr>

            <tr>
                <th colspan="2">Datos del Médico</th>
            </tr>
            <tr>
                <td>Documento</td>
                <td><?php echo $fila->MedIdentificacion; ?></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><?php echo $fila->MedNombres . " " . $fila->MedApellidos; ?></td>
            </tr>

            <tr>
                <th colspan="2">Datos de la cita</th>
            </tr>
            <tr>
                <td>Fecha</td>
                <td><?php echo $fila->CitFecha; ?></td>
            </tr>
            <tr>
                <td>Hora</td>
                <td><?php echo $fila->CitHora; ?></td>
            </tr>
            <tr>
                <td>Número de consultorio</td>
                <td><?php echo $fila->ConNumero; ?></td>
            </tr>
            <tr>
                <td>Nombre del consultorio</td>
                <td><?php echo $fila->ConNombre; ?></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td><?php echo $fila->CitEstado; ?></td>
            </tr>
            <tr>
                <td>Observaciones</td>
                <td><?php echo $fila->CitObservaciones; ?></td>
            </tr>
        </table>
    <?php
    } else {
        echo "<p>No se encontró la cita.</p>";
    }
    ?>
</div>

<?php require_once __DIR__ . '/parcial/footer.php'; ?>