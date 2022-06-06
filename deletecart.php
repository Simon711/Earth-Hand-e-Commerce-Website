<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
?>
<?php
if (isset($_GET['cartID'])){
 //echo " you have try to save ";
        $cid=$_GET['cartID'];
      
        $sql ="DELETE FROM `id18159895_adproject`.`tbl_cart` 
        WHERE (`cartID`='".$cid."')";  // sql command
//echo $sql;
        mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
        //$result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
        $result=mysqli_query($conn,$sql);
        if($result){
                goto2("cart.php"," Item has been removed successfully from the cart");
        }
        else{
                goto2("cart.php"," Error");
        }
     
       
} 
?>