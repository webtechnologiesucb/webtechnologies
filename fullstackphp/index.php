<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Tarea</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Registrar Nueva Tarea</h1>
        <form method="POST">
            <div class="form-group">
                <label for="tarea">Tarea:</label>
                <input type="text" class="form-control" id="tarea" name="tarea" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Lista de Tareas</h2>
        <ul>
            <?php
            // URL de la API para listar tareas
            $url = 'http://localhost/webtechnologies/fullstackphp/server.php';

            // Realizar una solicitud GET a la API
            $response = file_get_contents($url);

            // Decodificar la respuesta JSON
            $tareas = json_decode($response, true);

            // Mostrar las tareas en una lista HTML
            echo '<ul>';
            foreach ($tareas as $tarea) {
                echo '<li>' . $tarea . '</li>';
            }

            echo '</ul>';
            ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>