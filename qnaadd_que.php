<?php 
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');

$productID = $_GET['productID'];
 
if (isset($_POST['Submit']))
{  
	$question = $_POST['question']; 
	$username = $_SESSION['UserID'];
	
	$sql = "SELECT 1 FROM `id18159895_adproject`.`qna` WHERE `question` = '$question'";
	$select = mysqli_query($conn, $sql);
	$compare = mysqli_num_rows($select);

	if ($compare == 0){
		$insert = "INSERT INTO `id18159895_adproject`.`qna` (question, productID) VALUES ('".$question."', '".$productID."')";
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

