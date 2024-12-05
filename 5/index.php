<?php
// Класс CustomArrayObject, наследующий от ArrayObject
class CustomArrayObject extends ArrayObject
{
    public function filter(callable $callback)
    {
        $filtered = array_filter($this->getArrayCopy(), $callback);
        return new self($filtered);
    }

    public function max()
    {
        return max($this->getArrayCopy());
    }

    public function min()
    {
        return min($this->getArrayCopy());
    }

    public function merge(array $array)
    {
        $merged = array_merge($this->getArrayCopy(), $array);
        return new self($merged);
    }

    public function __toString()
    {
        return implode(", ", $this->getArrayCopy());
    }
}

// Инициализация результата
$result = '';
$operation = '';

// Обработка данных из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $array = isset($_POST['array']) ? explode(',', $_POST['array']) : [];
    $array = array_map('trim', $array);
    $operation = $_POST['operation'];
    
    $customArray = new CustomArrayObject($array);

    switch ($operation) {
        case 'filter':
            $result = $customArray->filter(function($item) {
                return $item > 25;
            });
            break;
        case 'max':
            $result = $customArray->max();
            break;
        case 'min':
            $result = $customArray->min();
            break;
        case 'merge':
            $secondArray = isset($_POST['mergeArray']) ? explode(',', $_POST['mergeArray']) : [];
            $secondArray = array_map('trim', $secondArray);
            $result = $customArray->merge($secondArray);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomArrayObject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            font-size: 16px;
        }
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            text-align: center;
        }
        .merge-array {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Работа с массивом</h1>
    <form method="POST">
        <label for="array">Введите массив (через запятую):</label>
        <input type="text" id="array" name="array" placeholder="10, 20, 30, 40" required>

        <label for="operation">Выберите операцию:</label>
        <select id="operation" name="operation">
            <option value="filter">Фильтрация (больше 25)</option>
            <option value="max">Найти максимальное значение</option>
            <option value="min">Найти минимальное значение</option>
            <option value="merge">Объединить с другим массивом</option>
        </select>

        <div class="merge-array" id="merge-array-input">
            <label for="mergeArray">Введите второй массив (через запятую):</label>
            <input type="text" id="mergeArray" name="mergeArray" placeholder="60, 70, 80">
        </div>

        <button type="submit">Выполнить операцию</button>
    </form>

    <?php if (!empty($result)): ?>
        <div class="result">
            <h3>Результат:</h3>
            <p><?php echo htmlspecialchars($result); ?></p>
        </div>
    <?php endif; ?>
</div>

<script>
    document.getElementById('operation').addEventListener('change', function() {
        var mergeInput = document.getElementById('merge-array-input');
        if (this.value === 'merge') {
            mergeInput.style.display = 'block';
        } else {
            mergeInput.style.display = 'none';
        }
    });
</script>

</body>
</html>
