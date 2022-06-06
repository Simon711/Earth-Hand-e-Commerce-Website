

<?php
require_once('../config/settings.php');
require_once("../config/db.php");
require_once("../config/function.php");
require_once('../config/session.php');

$statusMsg = '';

if(isset($_POST["submit"])) {
    $title = $_POST["title"];
    $location = $_POST["location"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $contact = $_POST["contact"];
    $targetDir = "../banner/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    $sql = "INSERT INTO `event` (`title`, `location`, `date`, `time`, `contact`, `banner`) VALUES ('$title', '$location','$date', '$time', '$contact', '$fileName')";
     // File upload path
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    if (mysqli_query($conn, $sql))
        display("../index.php", "Event has been added successfully");
    else
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Earth Hand</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/simon/manage_campaign.css">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/project-logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../images/project-logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js%22%3E</script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js%22%3E</script>
    <![endif]-->

</head>

<body>
<?php 

   include("header2.php");

?>
    <div class="main-block">
      <div class="left-part">
        <i class="fas fa-envelope"></i>
        <i class="fas fa-at"></i>
        <i class="fas fa-mail-bulk"></i>
      </div>
      <form action="" enctype="multipart/form-data" name="add an event" method="POST" role="form">
        <h1>Add Campaign To Home Page</h1><br><br><br>
        <div class="info">
          <input type="text" name="title" placeholder="Title of event">
          <input type="text" name="location" placeholder="Location">
          <input type="date" id="date" name="date">
          <input type="text" name="time" placeholder="Time">
          <input type="text" name="contact" placeholder="Contact">
          <label for="banner"><strong>Choose your banner of the event</strong></label>
          <input type="file" name="file">
        </div>
        <button type="submit" name="submit">Add</button>      
      </form>
    </div>
  </body>
  </html>