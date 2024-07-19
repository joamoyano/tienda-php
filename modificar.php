<?php
include 'db.php';

// Verificar el método de la solicitud
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Operación GET: Obtener datos para editar
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM DATOS WHERE idmateria='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(array("error" => "No se encontró el registro"));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Operación POST: Actualizar datos
    $id = $conn->real_escape_string($_POST['id']);
    $materia = $conn->real_escape_string($_POST['materia']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $estado = $conn->real_escape_string($_POST['estado']);

    $sql = "UPDATE DATOS SET materia=?, descripcion=?, estado=? WHERE idmateria=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssii", $materia, $descripcion, $estado, $id);
        if ($stmt->execute()) {
            echo json_encode(array("success" => "Registro actualizado exitosamente"));
        } else {
            echo json_encode(array("error" => "Error al actualizar: " . $stmt->error));
        }
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Error al preparar la consulta: " . $conn->error));
    }
}

$conn->close();
?>
