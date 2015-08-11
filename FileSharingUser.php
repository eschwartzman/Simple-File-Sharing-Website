<!DOCTYPE html>
<html>
<head>
        <title>User Files</title>
</head>
<body>
	<form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p>
	<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
	<label for="file">Select a file to upload:</label> 
	<input name="file" type="file" id="file" />
	</p>
	<p>
	<input type="submit" name="upload" value="Upload File" />
	</p>
</form>
<?php
session_start(); 
$userName=$_SESSION['name'];
echo "Hello " . $userName .  "<br/>\n";

?>

<?php
//create array of files for logged in user
	$path = "/home/jeremy/uploads";
	$dir = opendir($path);
	$userFiles = array();
		while (false !== ($file = readdir($dir))){
		$filesArray[] = $file;
		}
		foreach($filesArray as $val){
		if(strpos($val, $userName) !==false){
		$userFiles[]=$val;
		}
	}	

?>
<form method="POST">
<select name="files">
<?php
	echo'<option>Choose a File  </option>';
	//display option for each file in array
	foreach($userFiles as $file){
	    echo'<option value="'.$file.'">'.$file.'</option>';
	}
?>
	</select>
	<input type="submit" name="view" value="View File">	
	<input type="submit" name="delete"   value="Delete">
	<br/>
<?php
echo $_SESSION['message'];
?>


	</form>
<?php
//if view button selected
if(isset($_POST['view']) && !($_POST['files']=='Choose a File')){
	$_SESSION['viewFile']=$_POST['files'];
	header("Location: fileViewer.php");
	}
//if delete button selected
if(isset($_POST['delete']) && !($_POST['files']=='Choose a File')){
	unlink('/home/jeremy/uploads/' . $_POST['files']);
	$_SESSION['message']="deleted";
	header("Location: user.php");
	}

//if no file from drop down is selected
if((isset($_POST['view']) || isset($_POST['delete'])) && ($_POST['files']=='Choose a File')){
	$_SESSION['message']="Select a File First";
	}
?>


<!-- Button for Logging Out !-->
<form method="post">
<input type="submit" name="submit" value="Logout">
</form>
<?php
if(isset($_POST['submit'])){
	header("Location: loginPage.php");
	session_destroy();
	exit();
	}
?>

</body>
</html>