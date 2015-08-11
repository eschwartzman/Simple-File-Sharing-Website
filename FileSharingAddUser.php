<!DOCTYPE html>
<html>
<head>
        <title>Login Page</title>
</head>
<body>
<form method="post">
 New Name:<br>
<input type="text" name="username"><br><br>
<input type="submit" name="submit" value="Add User">
</form>
<?php
session_start();
if(isset($_POST['submit'])){
       $_SESSION['newName']=$_POST['username'];
	if(!preg_match('/^[\w_\-]+$/',$_SESSION['newName'])){
        echo "Invalid Username";
        exit;
        }
	$h = fopen("users.txt", "r+");
        $linenum=1;
	$exists=FALSE;
        while( !feof($h) ){
                if(trim(fgets($h),"\t\n\r\0\x0B") == $_SESSION['newName']){
                $exists=TRUE;
		echo "Already Exists";
                }	
  		$linenum++;
		}
	 		if($exists==FALSE){
            $nameLine = $_SESSION['newName'] . "\n";
        	fwrite($h, $nameLine);        
		header("Location: loginPage.php");
				} 
}
?>
</html>