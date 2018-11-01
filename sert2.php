<?php
$sert = imagecreatetruecolor(400, 200);
$backColor = imagecolorallocate($sert, 255, 255, 230);
$image = 'sert1.png';
$imImage = imagecreatefrompng($image);
imagefill($sert, 0, 0, $backColor);
imagecopy($sert, $imImage, 0, 0, 0, 0, 400, 200);
header("Content-type: image/png");
imagepng($sert);
?>