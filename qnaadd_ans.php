<?php 
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');

$productID = $_GET['productID'];

if (isset($_POST['Submit']))
{  
	$answer = $_POST['answer'];  
	$questionid = $_GET['questionID'];
	
	$sql = "SELECT 1 FROM `id18159895_adproject`.`qna` WHERE `answer` = '$answer'";
	$select = mysqli_query($conn, $sql);
	$compare = mysqli_num_rows($select);

	if ($compare == 0){
		$insert = "UPDATE `id18159895_adproject`.`qna` SET `answer` = '".$answer."' WHERE `questionID` = '".$questionid."'";
		$result = mysqli_query($conn, $insert); 
		if (!$result) {
			echo "<script>alert('ERROR !!!!! '); location='shop-detail.php?productID=$productID';</script>";
		}
		else {
			echo "<script>alert('Successful Post'); location='shop-detail.php?productID=$productID'; </script>";
		}
	}

	
	else {
		echo"<script>alert('ERROR');  location='shop-detail.php?productID=$productID';</script>";
	} 

}
?>

