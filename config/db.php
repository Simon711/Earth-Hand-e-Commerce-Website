<?php
require_once("variable.php");
$conn=new mysqli($servername,$user,$passw);

if (!$conn){
    die("Connection failed".mysqli_connect_error());
}

?>
