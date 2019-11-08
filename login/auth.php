<?php
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("localhost","adil","221634adil","test");
	$result = mysqli_query($conn,"SELECT * FROM Users WHERE Username='" . $_POST["userName"] . "' and Password = '". $_POST["password"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
	} else {
		$message = "You are successfully authenticated!";

	}
}
echo $message;
header("Location: /")
 ?>
