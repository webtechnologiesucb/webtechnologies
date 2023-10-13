<?php
// Obtiene la ruta de la solicitud
$request_uri = $_SERVER['REQUEST_URI'];

// Define la base de la URL (ruta de la API)
$api_base_path = '/api/category';

// Comprueba si la solicitud coincide con la ruta de la API
if (strpos($request_uri, $api_base_path) === 0) {
    // Ruta de la API: /api/category
    include('category.php');
    exit();
}

// Si no coincide con la ruta de la API, puedes manejar otras rutas aquí

// Mostrar un mensaje de error para rutas no reconocidas
http_response_code(404);
echo 'Ruta no encontrada';
