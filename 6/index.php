<?php
$dsn = "pgsql:host=localhost;dbname=postgres";
$user = "postgres";
$password = "0086";

try {
    $pdo = new PDO($dsn, $user, $password);

    // Пример сложного запроса
    $query = "SELECT u.name, SUM(o.amount) AS total_amount
              FROM users u
              JOIN orders o ON u.id = o.user_id
              GROUP BY u.name";

    // Используем EXPLAIN для анализа
    $explainQuery = "EXPLAIN ANALYZE " . $query;

    // Выполнение запроса EXPLAIN
    $stmt = $pdo->query($explainQuery);
    $explainResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Выполнение основного запроса
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анализ запросов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .explain {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<h1>Результаты анализа запросов</h1>

<div class="explain">
    <h2>EXPLAIN ANALYZE</h2>
    <pre>
    <?php
    foreach ($explainResult as $row) {
        echo $row['QUERY PLAN'] . "\n";
    }
    ?>
    </pre>
</div>

<h2>Результаты запроса</h2>
<table>
    <thead>
        <tr>
            <th>Пользователь</th>
            <th>Общая сумма</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results as $result) {
            echo "<tr>";
            echo "<td>{$result['name']}</td>";
            echo "<td>{$result['total_amount']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>