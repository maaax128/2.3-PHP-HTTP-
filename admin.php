<?php

$warning = '';
$uploaddir = './data/';
if (isset($_POST['addfile']))
{
    if(!empty($_FILES['jsonfile']['name'] == ''))
    { $warning ='Вы не выбрали файл!';}
    elseif ($_FILES['jsonfile']['type'] !== 'application/octet-stream')
    {echo ('Вы выбрали не json файл. Выберите файл с расширением json.');}
    else    
    if (!file_exists($uploaddir)) {
        mkdir($uploaddir,0777);
    }

    $uploadfile = $uploaddir.basename($_FILES['jsonfile']['name']);
    $tmp_name = $_FILES['jsonfile']['tmp_name'];
    if (move_uploaded_file($tmp_name, $uploadfile))
    {
        header('location: ./list.php');
        echo '<h3>Файл '. $_FILES['jsonfile']['name']. ' успешно загружен на сервер</h3>';
    }
    else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";  }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Генератор тестов на PHP и JSON</title>
</head>
<body>
<form action="admin.php" enctype="multipart/form-data" method="post">
    <?php if ($warning !== ''){echo $warning;}?>
    <div><input name="jsonfile" type="file" accept="application/json">
    <input type="submit" name="addfile" value="Загрузить"></div>
    <div><p><a href="list.php">Перейти к списку тестов</a></p></div>
</form>

</body>
</html>