<?php

require_once('../config/settings.php');
require_once('../config/db.php');
require_once('../config/function.php');


if(isset($_POST["remove_selected_event"])) {
    $date = $_POST["date"];
    mysqli_query($conn,"DELETE FROM `event` WHERE `date`='$date'");
    display("admin_view_campaign.php", "All event on " . $date . " has been deleted");
}
?>