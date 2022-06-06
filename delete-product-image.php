<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
?>

<?php
    if(isset($_GET['imageID'])) {
        $imageID = $_GET['imageID'];

        $sql = "SELECT * FROM tblproduct_image WHERE imageID = '".$imageID."'";
        mysqli_select_db($conn,"id18159895_adproject"); 
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $productID = $row['productID'];

        if (array_key_exists('image1', $row)) {
            $filename = $row['image1'];
            if (file_exists($filename)) {
                unlink($filename);
                //echo 'File '.$filename.' has been deleted';
            } else {
                echo 'Could not delete '.$filename.', file does not exist';
            }
        }


        $sqldel1 = "DELETE FROM tblproduct_image WHERE imageID = '".$imageID."'";
        mysqli_select_db($conn,"id18159895_adproject"); 
        $resultdel1=mysqli_query($conn, $sqldel1);

        goto2("update-product.php?productID=$productID", "Image successfully deleted.");

    }        
?>