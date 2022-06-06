<?php 
session_start();
unset($_SESSION['UserID']);
unset($_SESSION['Interface']);
unset($_SESSION['UserType']);
session_destroy();
?>