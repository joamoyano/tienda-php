<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Consulta preparada
    $stmt = $conn->prepare("INSERT INTO DATOS (materia, descripcion, estado) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $materia, $descripcion, $estado);

    if ($stmt->execute()) {
        echo "Nuevo registro creado exitosamente";
        // Redirección para evitar duplicidad
        header("Location: agregar.html?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
