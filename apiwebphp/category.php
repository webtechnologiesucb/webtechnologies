<?php
// category.php
include_once('config.php'); // Incluye la conexión a la base de datos
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Credentials: true");
/** Enciende el reporteador de errores */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Leer categorías
    $result = $conn->query("SELECT * FROM category");
    $categories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    echo json_encode($categories);
} elseif ($method === 'POST') {
    // Crear una nueva categoría
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $stmt = $conn->prepare("INSERT INTO category (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        echo "Categoría creada con éxito.";
    } else {
        echo "Error al crear la categoría: " . $stmt->error;
    }
} elseif ($method === 'PUT') {
    // Actualizar una categoría
    $data = json_decode(file_get_contents("php://input"), true);
    $categoryId = $data['category_id'];
    $name = $data['name'];
    $stmt = $conn->prepare("UPDATE category SET name = ? WHERE category_id = ?");
    $stmt->bind_param("si", $name, $categoryId);
    if ($stmt->execute()) {
        echo "Categoría actualizada con éxito.";
    } else {
        echo "Error al actualizar la categoría: " . $stmt->error;
    }
} elseif ($method === 'DELETE') {
    // Eliminar una categoría
    $categoryId = $_GET['category_id'];
    $stmt = $conn->prepare("DELETE FROM category WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    if ($stmt->execute()) {
        echo "Categoría eliminada con éxito.";
    } else {
        echo "Error al eliminar la categoría: " . $stmt->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
