<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');

?>

<?php

if(isset($_GET['productID'])) {
    $productID=$_GET['productID'];

    $sql ="DELETE FROM `tblproduct` WHERE (`productID`='".$productID."')";  // sql command
    mysqli_select_db($conn,"id18159895_adproject"); //select database as default
    $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql

    $target_dir = "products/".$productID."/";
    if (is_dir($target_dir))
        $dir_handle = opendir($target_dir);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($target_dir."/".$file))
                unlink($target_dir."/".$file);
            else
                delete_directory($target_dir.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($target_dir);
    goto2("product-home.php", "Product is successfully deleted");
    
    

}

?>