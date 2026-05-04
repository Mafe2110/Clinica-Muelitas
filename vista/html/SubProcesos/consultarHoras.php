<option disabled="disabled" selected="selected" value="-1">- Seleccione la hora -</option>
<?php
if ($result) {
    while ($fila = $result->fetch_object()) {
?>
        <option value="<?php echo $fila->hora; ?>"><?php echo $fila->hora; ?></option>
<?php
    }
}
?>