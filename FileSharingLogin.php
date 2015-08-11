<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
<form method="post">
 Login Name:<br>
<input type="text" name="username"><br><br>
<input type="submit" name="submit" value="Login">
<input type="submit" name="newUser" value="Add User">
</form>
<?php
session_start();
$_SESSION['message']="";
if(isset($_POST['submit'])){
       $_SESSION['name']=$_POST['username']; 
       $userName = $_POST['username'];
       if(!preg_match('/^[\w_\-]+$/',$userName)){
	echo "Invalid Username";
	exit;
	}
	 $h = fopen("users.txt", "r");
        $linenum=1;
        while( !feof($h) ){
                if(trim(fgets($h),"\t\n\r\0\x0B") ==$userName){
                header("Location: user.php");
		exit();
                }
                else{
                if(feof($h)){
                echo "Incorrect Login. Try Again";} }
                $linenum++;
        }
fclose($h);
}
if(isset($_POST['newUser'])){
header("Location: addUser.php");
}


?>
</body>
</html>