<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
</head>
<body>
    <h2>Створити користувача</h2>
    <form action="" method="post">
        <label for="login">Логін:</label>
        <input type="text" name="login" id="login" required>
        <br><br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Створити користувача">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        
        $userDir = 'users/' . $login;

        if (!is_dir($userDir)) {
            mkdir($userDir, 0777, true);
            mkdir($userDir . '/video', 0777, true);
            mkdir($userDir . '/music', 0777, true);
            mkdir($userDir . '/photo', 0777, true);

            file_put_contents($userDir . '/video/sample_video.txt', 'Це файл у папці video.');
            file_put_contents($userDir . '/music/sample_music.txt', 'Це файл у папці music.');
            file_put_contents($userDir . '/photo/sample_photo.txt', 'Це файл у папці photo.');

            echo "Користувач $login успішно створений.";
        } else {
            echo "Помилка: папка для користувача $login вже існує.";
        }
    }
    ?>
</body>
</html>
