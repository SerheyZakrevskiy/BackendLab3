<?php
function readWordsFromFile($filename) {
    if (!file_exists($filename)) {
        return [];
    }
    
    $content = file_get_contents($filename);
    return explode(' ', trim($content));
}

function writeWordsToFile($filename, $words) {
    file_put_contents($filename, implode(' ', $words));
}

$file1Words = array_count_values(readWordsFromFile('file1.txt'));
$file2Words = array_count_values(readWordsFromFile('file2.txt'));

$onlyInFirstFile = array_diff_key($file1Words, $file2Words);
writeWordsToFile('only_in_first.txt', array_keys($onlyInFirstFile));

$inBothFiles = array_intersect_key($file1Words, $file2Words);
writeWordsToFile('in_both.txt', array_keys($inBothFiles));

$moreThanTwoTimes = array_filter($file1Words + $file2Words, function($count) {
    return $count > 2;
});
writeWordsToFile('more_than_two_times.txt', array_keys($moreThanTwoTimes));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = trim($_POST['filename']);

    if (!empty($filename) && file_exists($filename)) {
        unlink($filename);
        $message = "Файл '$filename' успішно видалено.";
    } else {
        $message = "Файл '$filename' не знайдено.";
    }
}





function sortWordsInFile($filename) {
    if (!file_exists($filename)) {
        echo "Файл не знайдено!";
        return;
    }


    $content = file_get_contents($filename);
    

    $words = explode(' ', trim($content));
    

    sort($words);
    

    file_put_contents($filename, implode(' ', $words));
    
    echo "Слова успішно відсортовані і збережені у файл!";
}


sortWordsInFile('words.txt');

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення файлів</title>
</head>
<body>
<h1>Видалити файл</h1>

<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<form method="POST" action="">
    <label for="filename">Ім'я файлу для видалення:</label>
    <input type="text" id="filename" name="filename" required><br><br>
    
    <button type="submit">Видалити файл</button>
</form>

<h2>Список доступних файлів:</h2>
<ul>
    <?php
    $files = ['only_in_first.txt', 'in_both.txt', 'comments.txt'];
    foreach ($files as $file) {
        if (file_exists($file)) {
            echo "<li>$file</li>";
        }
    }
    ?>
</ul>

</body>
</html>
