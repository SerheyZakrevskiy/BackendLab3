<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h3 {
            color: #333;
        }
    </style>
</head>
<body>

<?php
$filenames = ['only_in_first.txt', 'in_both.txt'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedFile = $_POST['filename'];

    function readWordsFromFile($filename) {
        if (!file_exists($filename)) {
            return [];
        }
        $content = file_get_contents($filename);
        return explode(' ', trim($content));
    }
    function sortWords($words) {
        sort($words, SORT_STRING);
        return $words;
    }


    $words = readWordsFromFile($selectedFile);
    

    if (!empty($words)) {
        $sortedWords = sortWords($words);
        echo "<h3>Відсортовані слова з файлу '$selectedFile':</h3>";
        echo "<p>" . implode(', ', $sortedWords) . "</p>";
    } else {
        echo "<p>Не знайдено слів у файлі або файл порожній.</p>";
    }
}
?>

<h3>Виберіть файл для сортування:</h3>
<form method="post" action="">
    <select name="filename">
        <?php foreach ($filenames as $file): ?>
            <option value="<?= $file ?>"><?= $file ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Сортувати</button>
</form>

</body>
</html>
