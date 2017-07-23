<?php
$image_data = $_POST['image'];
$filename = 'example.png';
$fp = fopen($filename, 'w');
fwrite($fp, base64_decode($image_data));
fclose($fp);
