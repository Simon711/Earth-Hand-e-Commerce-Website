
<?php 
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
?>

<?php 

if (isset($_GET['Email'])){
 //echo " you have try to save ";
        $email=$_GET['Email'];
        
        $sql ="DELETE FROM `id18159895_adproject`.`table_user` 
        WHERE (`Email`='".$email."') ";
             
//echo $sql;
        mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
        $result=mysqli_query($conn,$sql); 
        if($result){
                include('config/deletesession.php');
                goto2("../index.php","Account is successfully deleted");
        }
        else{
                goto2("my-account-profile.php","Error");
        }
      
} 

?>