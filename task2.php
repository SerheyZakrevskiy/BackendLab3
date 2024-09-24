<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = 'Admin';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Невірний логін або пароль";
    }
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<h1>Добрий день, " . htmlspecialchars($_SESSION['user']) . "!</h1>";
    echo '<a href="?logout=true">Вийти</a>';
} else {
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <h1>Форма авторизації</h1>
    <form method="POST" action="">
        <label for="login">Логін:</label>
        <input type="text" id="login" name="login" required><br><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Увійти</button>
    </form>

    <?php
}
?>
