<?php
if (isset($_POST['add']) && empty($_FILES['testfile']['name'])) {
    header("Location:admin.php");
    exit;
}
elseif (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $fileName = $_FILES['testfile']['name'];
    $tmpFile = $_FILES['testfile']['tmp_name'];
    $uploadsDir = 'uploads/';
    $pathInfo = pathinfo($uploadsDir . $fileName);
    if ($pathInfo['extension'] === 'json') {
        move_uploaded_file($tmpFile, $uploadsDir . $fileName);
        header("Location:list.php");
        exit;
    } else {
        header("Location:admin.php");
        exit;
    }        
} 
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
     <style>
        div {
            width: 400px;
            border: 1px solid black;
            padding: 30px;
        }
    </style>
    <title>Загрузить тест</title>
</head>
<body>

    <div>
        <p>Загрузите ваш тест - файл с расширением JSON</p>


        <form method="post" enctype="multipart/form-data">
            <input type="file" name="testfile">
            <input type="submit" name="add" value="Загрузить">
        </form>

        <ul>
            <li><a href="list.php">Список тестов</a></li>
        </ul>
    </div>

</body>
</html>