<?php
if ($result && $result->num_rows > 0) {
    $fila = $result->fetch_object();
?>
    <table>
        <tr>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Sexo</th>
            <th>Teléfono</th>
        </tr>
        <tr>
            <td><?php echo $fila->PacIdentificacion; ?></td>
            <td><?php echo $fila->PacNombres . " " . $fila->PacApellidos; ?></td>
            <td><?php echo $fila->PacSexo; ?></td>
            <td><?php echo $fila->PacTelefono; ?></td>
        </tr>
    </table>
<?php
} else {
?>
    <p>El paciente no existe en la base de datos.</p>
    <a href="index.php?accion=registrarPaciente&documento=<?php echo urlencode($documento ?? ''); ?>" class="boton-suave">
        Registrar paciente
    </a>
<?php
}
?>