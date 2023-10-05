<?php
// category.php
include_once('config.php'); // Incluye la conexión a la base de datos
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
/** Enciende el reporteador de errores */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configura la conexión a la base de datos aquí
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Leer categorías
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);

    $categories = array();

    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    echo json_encode($categories);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva categoría
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];

    $sql = "INSERT INTO category (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Categoría creada con éxito"));
    } else {
        echo json_encode(array("error" => $conn->error));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Actualizar una categoría
    $data = json_decode(file_get_contents('php://input'), true);
    $category_id = $data['id'];
    $name = $data['name'];

    $sql = "UPDATE category SET name = '$name' WHERE category_id = $category_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Categoría actualizada con éxito"));
    } else {
        echo json_encode(array("error" => $conn->error));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Eliminar una categoría
    $data = json_decode(file_get_contents('php://input'), true);
    $category_id = $data['id'];

    $sql = "DELETE FROM category WHERE category_id = $category_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Categoría eliminada con éxito"));
    } else {
        echo json_encode(array("error" => $conn->error));
    }
}

// Cierra la conexión a la base de datos
$conn->close();
