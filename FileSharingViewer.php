<?php
session_start();
$fileName= $_SESSION['viewFile'];

if(strpos($fileName, 'txt') !==false){
$file = fopen("/home/jeremy/uploads/" . $fileName , "r");
 $content = fread($file, filesize("/home/jeremy/uploads/" . $fileName ));
 fclose ($file);
 echo $content;
}else{
$nameSize =strlen( $_SESSION['name']);
$tempName = substr($fileName, 0, -$nameSize);
header('content-type: image/jpeg');
rename("/home/jeremy/uploads/" . $fileName, "/home/jeremy/uploads/" .$tempName . ".jpg");
readfile("/home/jeremy/uploads/". $tempName . ".jpg");
rename("/home/jeremy/uploads/" . $tempName . ".jpg" , "/home/jeremy/uploads/" . $fileName);
}
?>