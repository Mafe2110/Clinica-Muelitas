<?php
if ($result && $result->num_rows > 0) {
    $fila = $result->fetch_object();
?>
    <table>
        <tr>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Sexo</th>
        </tr>
        <tr>
            <td><?php echo $fila->PacIdentificacion; ?></td>
            <td><?php echo $fila->PacNombres . " " . $fila->PacApellidos; ?></td>
            <td><?php echo $fila->PacSexo; ?></td>
        </tr>
    </table>
<?php
} else {
?>
    El paciente no existe en la base de datos<br>
    <input type="button" name="ingPaciente" value="Ingresar Paciente" id="ingPaciente">
<?php
}
?>