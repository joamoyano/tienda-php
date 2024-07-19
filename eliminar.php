<?php
include 'db.php';

// Verificar que el ID se ha enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM datos WHERE idmateria = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo "No se proporcionó un ID válido";
}

// Cerrar la conexión
$conn->close();
?>
