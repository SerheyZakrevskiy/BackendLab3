<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab3</title>
</head>
<body>
    <h2>Завантажити зображення</h2>
    
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Виберіть зображення:</label>
        <input type="file" name="image" id="file" accept="image/*" required>
        <br><br>
        <input type="submit" value="Завантажити">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        if (isset($_FILES['image'])) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileType = mime_content_type($_FILES['image']['tmp_name']);
                if (strpos($fileType, 'image/') === 0) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        echo "Файл успішно завантажено: " . htmlspecialchars(basename($_FILES['image']['name']));
                    } else {
                        echo "Помилка при завантаженні файлу.";
                    }
                } else {
                    echo "Будь ласка, завантажте файл зображення.";
                }
            } else {
                echo "Помилка при завантаженні файлу: " . $_FILES['image']['error'];
            }
        } else {
            echo "Файл не був обраний.";
        }
    }
    ?>
</body>
</html>
