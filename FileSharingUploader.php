<?php
session_start();
$userName = $_SESSION['name'];
$allowedFile = array("gif", "jpeg", "jpg", "png", "txt");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$_SESSION['message'] = "";

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "text/plain"))
&& ($_FILES["file"]["size"] < 50000)
&& in_array($extension, $allowedFile)) {
	if($_FILES["file"]["error"]>0){	
		header("Location: user.php"); 
		$_SESSION['message']="Error file for upload";	
	}else {
		header("Location:user.php");
 		$_SESSION['message']= "Uploaded!";

	if (file_exists("/home/jeremy/uploads/" . $_FILES["file"]["name"] . $_SESSION["name"])) {
		header("Location: user.php");	
	 $_SESSION['message']= $_FILES["file"]["name"] . " already exists. ";
    	} else {
      		move_uploaded_file($_FILES["file"]["tmp_name"],
      		"/home/jeremy/uploads/" . $_FILES["file"]["name"] . $_SESSION["name"] );	
		header("Location: user.php");
      		$_SESSION['message']=  $_FILES["file"]["name"] . " Uploaded!" ;   		
 }
	}
}else{
header("Location:user.php");
$_SESSION['message']="Choose a File First";
}


?>