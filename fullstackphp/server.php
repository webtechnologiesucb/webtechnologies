<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

// Array para almacenar las tareas
$tareas = array();
//$tareas = ['Caminar', 'Ejercitar'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ruta GET para obtener todas las tareas
    echo json_encode($tareas);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ruta POST para crear una nueva tarea
    $data = json_decode(file_get_contents("php://input"), true);
    $tareas[] = $data['tarea'];
    echo json_encode(['message' => 'Tarea agregada con éxito']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ruta DELETE para eliminar una tarea por índice
    $index = $_GET['index']; // Utilizamos un parámetro en la URL en lugar de un parámetro en la ruta
    if (isset($tareas[$index])) {
        array_splice($tareas, $index, 1);
        echo json_encode(['message' => 'Tarea eliminada con éxito']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Tarea no encontrada']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
