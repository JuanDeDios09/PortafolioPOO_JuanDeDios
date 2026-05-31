<?php
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $actividad = trim($_POST["actividad"]);
    $responsable = trim($_POST["responsable"]);
    $fecha = trim($_POST["fecha"]);

    if (empty($actividad) || empty($responsable) || empty($fecha)) {
        $mensaje = "<p style='color:red;'>Error: Todos los campos son obligatorios.</p>";
    } else {

        $registro = "Fecha: $fecha" . PHP_EOL;
        $registro .= "Actividad: $actividad" . PHP_EOL;
        $registro .= "Responsable: $responsable" . PHP_EOL;
        $registro .= "-------------------------------" . PHP_EOL;

        if (file_put_contents("bitacora.txt", $registro, FILE_APPEND)) {
            $mensaje = "<p style='color:green;'>Actividad guardada correctamente.</p>";
        } else {
            $mensaje = "<p style='color:red;'>Error al guardar la actividad.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácora de Actividades</title>
</head>
<body>

    <h1>Gestión de Bitácora</h1>

    <?php echo $mensaje; ?>

    <form method="POST">

        <label>Descripción de la actividad:</label><br>
        <input type="text" name="actividad"><br><br>

        <label>Responsable:</label><br>
        <input type="text" name="responsable"><br><br>

        <label>Fecha:</label><br>
        <input type="date" name="fecha"><br><br>

        <input type="submit" value="Guardar Actividad">

    </form>

    <hr>

    <h2>Bitácora Registrada</h2>

    <?php
    if (file_exists("bitacora.txt")) {

        $contenido = file_get_contents("bitacora.txt");

        echo "<pre>$contenido</pre>";

    } else {

        echo "<p>No existen registros todavía.</p>";
    }
    ?>

</body>
</html>