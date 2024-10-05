<?php
// Parámetros de conexión a la base de datos
$host = 'localhost';
$dbname = 'clinica_dental';
$user = 'postgres'; // Cambia al usuario adecuado si es necesario
$password = 'cesar3627'; // Cambia por la contraseña correspondiente

// Función para conectarse a la base de datos usando PDO
function conectarDB() {
    global $host, $dbname, $user, $password;

    try {
        // Crear la conexión PDO
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Mostrar el error en caso de fallo de conexión
        die("Error en la conexión a la base de datos: " . $e->getMessage());
    }
}
?>
