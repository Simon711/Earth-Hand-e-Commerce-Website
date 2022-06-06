<?php  
require_once("config/function.php");
require_once('config/db.php');

if(isset($_POST["submit"])) {

    $_email = $_POST["email"];
    $_new_password1 = $_POST["new_password1"];
    $_new_password2 = $_POST["new_password2"];
    
    if($_new_password1 == $_new_password2){
        $sql = "UPDATE `id18159895_adproject`.`table_user` SET `Password`='$_new_password1', `cPassword`='$_new_password1' WHERE `Email`='$_email'";
        
        if (mysqli_query($conn, $sql)){
        display("login.php", "Your new password has been updated");
        }
        else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else{
        //goto2("login.php","Failed to Reset! Password doesn't match");
        display("forgotpw.php", "Failed to Reset! Password doesn't match"); 
    }
}     
    

?>