<?php

require_once("../config/db.php");
require_once("../config/function.php");

if(isset($_GET["contact"])) {
    $contact = $_GET['contact'];
    mysqli_query($conn,"DELETE FROM `id18159895_adproject`.`event` WHERE `contact` = '$contact'"); // delete query
    display("admin_view_campaign.php", "The record has been deleted");
}
?>