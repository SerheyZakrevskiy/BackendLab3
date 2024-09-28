<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
</head>
<body>
    <h2>Видалити користувача</h2>
    <form action="" method="post">
        <label for="login">Логін:</label>
        <input type="text" name="login" id="login" required>
        <br><br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Видалити користувача">
    </form>

    <?php
    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return false;
        }

        if (is_file($dir)) {
            return unlink($dir);
        }

        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            deleteDirectory($dir . DIRECTORY_SEPARATOR . $item);
        }

        return rmdir($dir);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        
        $userDir = 'users/' . $login;

        if (is_dir($userDir)) {
            if (deleteDirectory($userDir)) {
                echo "Папка користувача $login успішно видалена.";
            } else {
                echo "Не вдалося видалити папку користувача $login.";
            }
        } else {
            echo "Помилка: папка для користувача $login не існує.";
        }
    }
    ?>
</body>
</html>
