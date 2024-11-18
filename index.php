<?php
// Conectar a la base de datos
$db = new SQLite3('/var/www/html/test.db');

// Crear la tabla si no existe
$db->exec("CREATE TABLE IF NOT EXISTS mensajes (id INTEGER PRIMARY KEY, contenido TEXT)");

// Comprobar si se ha enviado un mensaje a través del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])) {
    // Capturar el mensaje enviado
    $mensaje = $_POST['mensaje'];

    // Insertar el mensaje en la base de datos
    $stmt = $db->prepare("INSERT INTO mensajes (contenido) VALUES (:contenido)");
    $stmt->bindValue(':contenido', $mensaje, SQLITE3_TEXT);
    $stmt->execute();
}

// Mostrar los mensajes de la base de datos
$result = $db->query("SELECT * FROM mensajes");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
</head>
<body>
    <!-- Formulario para enviar mensajes -->
    <form method="POST" action="index.php">
        <input type="text" name="mensaje" required>
        <input type="submit" value="Enviar">
    </form>

    <h2>Mensajes:</h2>
    <?php
    // Mostrar los mensajes
    while ($row = $result->fetchArray()) {
        echo $row['contenido'] . "<br>";
    }
    ?>
</body>
</html>

