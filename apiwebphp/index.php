<?php
include_once('db_connect.php'); // Incluye la conexión a la base de datos
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
/** Enciende el reporteador de errores */
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Leer todas las categorías
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);
    $categories = array();

    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($categories);
}

// Crear una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name; // Asumiendo que hay un campo 'name' en la tabla 'category'
    
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "Categoria creada con exito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Actualizar una categoría existente
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $name = $data->name;
    $sql = "UPDATE category SET name='$name' WHERE category_id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Categoría actualizada con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Eliminar una categoría
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM category WHERE category_id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Categoría eliminada con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
