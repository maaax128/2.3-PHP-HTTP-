<?php

$datadir = './data/';
$ArrFiles = [];
$ArrTests = [];
if($OpDir = opendir($datadir)){

    while(false !== ($file = readdir($OpDir))) {
        if($file != "." && $file != ".."){
            $ArrFiles[] = $file;

        }
    }
}

for ($i = 0; $i < count($ArrFiles);$i++){
$JsonFile = file_get_contents('./data/'.$ArrFiles[$i]);
$Arr = json_decode($JsonFile,true);
    $key = $ArrFiles[$i];
    $ArrTests[$key] = $Arr['title'];

}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список тестов</title>
</head>
<body>
<form action="list.php"  method="post">
    <div> <b>Список тестов</b>
        <ul>
    <?php foreach ($ArrTests as $id=>$key){
    echo "<li><a href=\"test.php?id=$id\">$key</a></li>";

    }
       ?>
     </ul>
    </div>
</form>

</body>
</html>