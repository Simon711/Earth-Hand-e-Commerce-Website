<?php
// Include the database configuration file
require_once('../config/db.php');
$statusMsg = '';



if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
  // File upload path
$targetDir = "../banner/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into image (banner) VALUES ('$fileName')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

$query = $conn->query("SELECT * FROM image");


// Include the database configuration file

// Get images from the database




// ---------------------------------------------------------- display  -----------------------------------
$query = $conn->query("SELECT * FROM image");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
      $imageURL = '../banner/'.$row["banner"];   

?>

<img src="<?php echo $imageURL; ?>" alt="" />

<?php
    }
  }
?>


<?php
// Display status message
?>

<form action="" method="POST" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>