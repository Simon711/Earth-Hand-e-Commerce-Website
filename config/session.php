<?php
if (file_exists('config/function.php')==1){ 
  require_once('config/function.php');
}
else{
  require_once('../config/function.php');
}

session_start();
if (isset($_SESSION['UserID'])){
  $userid=$_SESSION['UserID']; 
    //echo  $_SESSION['mylogin'];
  //  goto2("index.php","You have login");

}else{
   // echo " no value defined";
   if (file_exists('login.php')==1){ 
    $int='login.php';
  }
  else{
    $int='../login.php';
  }
   goto2($int,"Please log on before using");

}


?>