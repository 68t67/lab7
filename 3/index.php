<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка типа пути</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        .result {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Проверка типа файла или директории</h1>

        <form method="post">
            <div class="form-group">
                <label for="path">Введите путь:</label>
                <input type="text" name="path" id="path" class="form-control" placeholder="Например, /var/www/html или C:/test/file.txt" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Проверить</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $path = $_POST['path'];

            echo '<div class="result text-center">';
            if (is_file($path)) {
                echo "<p class='alert alert-success'>Путь <strong>" . htmlspecialchars($path) . "</strong> является файлом.</p>";
            } elseif (is_dir($path)) {
                echo "<p class='alert alert-info'>Путь <strong>" . htmlspecialchars($path) . "</strong> является директорией.</p>";
            } else {
                echo "<p class='alert alert-danger'>Путь <strong>" . htmlspecialchars($path) . "</strong> не является файлом или директорией, или такого пути не существует.</p>";
            }
            echo '</div>';
        }
        ?>

    </div>

    <!-- Подключение Bootstrap JS и jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>