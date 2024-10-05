<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'config.php';

// Verificar la conexión a la base de datos
try {
    $pdo = conectarDB();
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Consultar todas las citas de la base de datos
$sql = "SELECT nombre_paciente, telefono, correo, tratamiento, fecha, hora, notas FROM citas_tratamientos";
$stmt = $pdo->query($sql);

// Verificar si la consulta devolvió resultados
if ($stmt) {
    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $citas = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas Registradas</title>
    <link rel="stylesheet" href="lista.css">
</head>
<body>

<div class="navbar">
        <!-- Logo -->
        <img src="logo.png" alt="Logo" class="logo">
        
        <!-- Menú -->
        <div class="menu">
            <a href="index.html">Inicio</a>
            <a href="nosotros.html">Sobre Nosotros</a>
            <a href="servicios.html">Servicios</a>
            <a href="cita.html">Apartar cita</a>
            <a href="ver_citas.php">listado citas</a>
        </div>
    </div>  

    <h1>Citas Registradas</h1>

    <!-- Mostrar citas en una tabla -->
    <?php if (count($citas) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Paciente</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Tratamiento</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cita['nombre_paciente']); ?></td>
                        <td><?php echo htmlspecialchars($cita['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($cita['correo']); ?></td>
                        <td><?php echo htmlspecialchars($cita['tratamiento']); ?></td>
                        <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                        <td><?php echo htmlspecialchars($cita['notas']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay citas registradas.</p>
    <?php endif; ?>

</body>
</html>
