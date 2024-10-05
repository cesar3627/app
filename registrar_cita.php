<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'config.php';

// Verificar si los datos del formulario fueron enviados correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre_paciente = $_POST['nombre_paciente'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $tratamiento = $_POST['tratamiento'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $notas = $_POST['notas'] ?? '';

    // Validar campos obligatorios
    if (!empty($nombre_paciente) && !empty($tratamiento) && !empty($fecha) && !empty($hora)) {
        // Conectar a la base de datos usando la función de config.php
        $pdo = conectarDB();

        // Preparar e insertar los datos en la base de datos
        $sql = "INSERT INTO citas_tratamientos (nombre_paciente, telefono, correo, tratamiento, fecha, hora, notas) 
                VALUES (:nombre_paciente, :telefono, :correo, :tratamiento, :fecha, :hora, :notas)";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la consulta
        $stmt->execute([
            ':nombre_paciente' => $nombre_paciente,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':tratamiento' => $tratamiento,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':notas' => $notas
        ]);

        // Confirmar registro exitoso
        echo "Cita registrada con éxito.";
    } else {
        echo "Por favor, complete los campos obligatorios.";
    }
} else {
    echo "Formulario no enviado correctamente.";
}
?>
