<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

// Array para almacenar las tareas (simulado en memoria, en un escenario real usarías una base de datos)
$tareas = ["Trabajar proyecto", "Desarrollar codigo"];

// Ruta para obtener todas las tareas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($tareas);
}

// Ruta para agregar una nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    array_push($tareas, $data);

    echo json_encode(['message' => 'Tarea agregada']);
}

// Ruta para modificar una tarea existente
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    if (isset($tareas[$id])) {
        $tareas[$id] = $data;
        echo json_encode(['message' => 'Tarea modificada']);
    } else {
        echo json_encode(['message' => 'Tarea no encontrada']);
    }
}

// Ruta para eliminar una tarea
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    if (isset($tareas[$id])) {
        unset($tareas[$id]);
        echo json_encode(['message' => 'Tarea eliminada']);
    } else {
        echo json_encode(['message' => 'Tarea no encontrada']);
    }
}
