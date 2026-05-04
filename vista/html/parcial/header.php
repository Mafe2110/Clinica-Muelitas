<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Sistema de Gestion Odontologica';
}
if (!isset($extraHead)) {
    $extraHead = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" type="text/css" href="vista/css/estilos.css?v=2">
    <?php echo $extraHead; ?>
</head>
<body>
<div id="contenedor">
    <div id="encabezado">
        <h1></h1>
    </div>