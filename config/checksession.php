<?php

session_start();
if (isset($_SESSION['Interface'])&&(isset($_SESSION['UserID']))){
    goto2($_SESSION['Interface'],"Welcome back to the Portal");

}

?>