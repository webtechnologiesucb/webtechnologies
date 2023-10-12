<?php

// Función para realizar solicitudes HTTP
function httpRequest($url, $method, $data = [])
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    print(curl_setopt($curl, CURLOPT_RETURNTRANSFER, true));

    if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

// URL del servicio API
$apiUrl = 'server.php';

// Alta de tarea
$data = ['task' => 'Nueva tarea'];
$response = httpRequest($apiUrl, 'POST', $data);
echo "Alta de tarea: $response <br />";

// Obtener todas las tareas
$response = httpRequest($apiUrl, 'GET');
$tareas = json_decode($response, true);
echo "Todas las tareas: <br />";
print_r($tareas);

// Modificar una tarea (debes proporcionar un ID válido)
$id = 0; // Cambia esto al ID de la tarea que deseas modificar
$data = ['id' => $id, 'task' => 'Tarea modificada'];
$response = httpRequest($apiUrl, 'PUT', $data);
echo "Modificación de tarea: $response <br />";

// Eliminar una tarea (debes proporcionar un ID válido)
$id = 0; // Cambia esto al ID de la tarea que deseas eliminar
$data = ['id' => $id];
$response = httpRequest($apiUrl, 'DELETE', $data);
echo "Eliminación de tarea: $response <br />";
