<?php
include 'db.php';

$result = '';

if (isset($_POST['join_type'])) {
    $joinType = $_POST['join_type'];
    
    if ($joinType == 'inner') {
        $query = "
            SELECT users.username, users.email, orders.order_date, orders.amount
            FROM users
            INNER JOIN orders ON users.user_id = orders.user_id
        ";
    } elseif ($joinType == 'left') {
        $query = "
            SELECT users.username, users.email, orders.order_date, orders.amount
            FROM users
            LEFT JOIN orders ON users.user_id = orders.user_id
        ";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Таблицы</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Использование JOIN (INNER JOIN и LEFT JOIN)</h1>

        <form method="post" class="text-center">
            <button type="submit" name="join_type" value="inner" class="btn btn-primary">Выполнить INNER JOIN</button>
            <button type="submit" name="join_type" value="left" class="btn btn-secondary">Выполнить LEFT JOIN</button>
        </form>

        <?php if (!empty($result)): ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Имя пользователя</th>
                        <th>Email</th>
                        <th>Дата заказа</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['amount']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">Нажмите одну из кнопок, чтобы выполнить запрос.</p>
        <?php endif; ?>
    </div>

    <!-- Подключение Bootstrap JS и jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>