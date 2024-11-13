<?php
// Crear o abrir base de datos SQLite
$db = new PDO('sqlite:/var/www/html/proyectofinal/database.db');

// Crear una tabla
$db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT)");

// Insertar un registro
$db->exec("INSERT INTO users (name) VALUES ('User1')");

// Leer los datos
$result = $db->query("SELECT * FROM users");
foreach ($result as $row) {
    echo $row['id'] . ' - ' . $row['name'] . "<br>";
}
?>
