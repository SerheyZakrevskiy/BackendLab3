<?php

$file = 'comments.txt';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if (!empty($name) && !empty($comment)) {

        $data = $name . '|' . $comment . "\n";


        $handle = fopen($file, 'a');
        fwrite($handle, $data);
        fclose($handle);


        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = "Будь ласка, введіть як ім'я, так і коментар.";
    }
}


function getComments($file) {
    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        echo '<table border="1">';
        echo '<tr><th>Ім’я</th><th>Коментар</th></tr>';


        while (($line = fgets($handle)) !== false) {

            $parts = explode('|', $line);


            if (count($parts) == 2) {
                $name = htmlspecialchars(trim($parts[0]));
                $comment = htmlspecialchars(trim($parts[1]));

                echo '<tr><td>' . $name . '</td><td>' . $comment . '</td></tr>';
            }
        }
        echo '</table>';
        fclose($handle);
    } else {
        echo 'Немає коментарів для відображення.';
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
</head>
<body>

<h1>Залиште свій коментар</h1>

<?php

if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>

<form method="POST" action="">
    <label for="name">Ім’я:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="comment">Коментар:</label>
    <textarea id="comment" name="comment" required></textarea><br><br>
    
    <button type="submit">Відправити</button>
</form>

<h2>Усі коментарі:</h2>
<?php

getComments($file);
?>

</body>
</html>
