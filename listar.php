<?php
include 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] . '%' : '%';

$sql = "SELECT * FROM datos WHERE 
    idmateria LIKE ? OR 
    materia LIKE ? OR 
    descripcion LIKE ? OR 
    estado LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $search, $search, $search, $search);
$stmt->execute();
$result = $stmt->get_result();

$componentes = array();
while ($row = $result->fetch_assoc()) {
    $componentes[] = $row;
}
echo json_encode($componentes);

$stmt->close();
$conn->close();
?>
