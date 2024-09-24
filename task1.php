<?php
if (isset($_GET['font'])) {
    $fontSize = $_GET['font'];
    setcookie('fontSize', $fontSize, time() + (86400 * 30), "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$fontSize = isset($_COOKIE['fontSize']) ? $_COOKIE['fontSize'] : '16px';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>

<h1>Виберіть розмір шрифту:</h1>
<ul>
    <li><a href="?font=24px">Великий</a></li>
    <li><a href="?font=18px">Сереедній</a></li>
    <li><a href="?font=12px">Маленький</a></li>
</ul>

<p>Цей текст змінюватиме свій розмір в залежності від вибору користувача. Розмір шрифту буде збережений у cookie.</p>

</body>
</html>
