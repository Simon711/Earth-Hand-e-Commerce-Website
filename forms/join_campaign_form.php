<?php
// require_once("../admin/header2.php");
require_once("../config/db.php");
require_once("../config/function.php");


$event_id = $_GET['event_id'];

if (isset($_POST["submit"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$participant_type = $_POST["participant_type"];


	$sql = "INSERT INTO `id18159895_adproject`.`participant` (`event_id`, `name`, `email`, `participant_type`) VALUES ('".$event_id."','".$name."', '".$email."','".$participant_type."')";

	if (mysqli_query($conn, $sql))
		display("../user_index.php", "Your information have been stored into out database!");
	else
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>

<html>

<head>
	<style>
		body {
			background-image: url("../images/form_bg.jpg");
			background-repeat: no-repeat;
			background-size: cover
		}
	</style>
	<meta charset="utf-8">
	<title>Event Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Site Icons -->
    <link rel="shortcut icon" href="../images/project-logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../images/project-logo.png">

	<link rel="stylesheet" href="../css/simon/campaign_form_style.css">
</head>

<body>
	<div class="wrapper">
		<div class="inner">
			<form action="" method="POST" role="form">
				<h3>Registration Form</h3>
				<p>Fill up the form to record the number of seller and buyer will be joining</p>
				<label class="form-group">
					<input name="name" type="text" class="form-control" required>
					<span>Your Name</span>
					<span class="border"></span>
				</label>
				<label class="form-group">
					<input name="email" type="text" class="form-control" required>
					<span for="">Your Mail</span>
					<span class="border"></span>
				</label>

				<h1>
					<p>Are you BUYER or SELLER:</p>
				</h1>
				<div class="radioButton">
					  <input type="radio" id="buyer" name="participant_type" value="buyer">
					  <label for="buyer">Buyer</label> &nbsp &nbsp
					  <input type="radio" id="seller" name="participant_type" value="seller">
					  <label for="seller">Seller</label><br>
				</div>

				<button type="submit" name="submit">Submit
					<i class="zmdi zmdi-arrow-right"></i>
				</button>
			</form>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>