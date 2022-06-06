<?php
require_once('../config/settings.php');
require_once("../config/db.php");
require_once("../config/function.php");
require_once('../config/session.php');
include("header2.php");

?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .listth,
    .listtd {
        border: 1px solid #ccbca2;
        text-align: left;
        padding: 8px;
    }

    .listtr:nth-child(odd) {
        background-color: #ccbca2;
    }

    .listtr:nth-child(even) {
        background-color: #ffffff;
    }
</style>

<link href="../css/simon/style.css" rel="stylesheet">
<link href="../css/simon/btnstyle.css" rel="stylesheet">


<!------------------------------------------------------------------------- result of searched event --------------------------------------------------------------------------------------->

<?php
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
?>

<body>
    <section class="inner-page">
        <div style="background-color:#ccbca2;">

            <table style="border:2">
                <tr>
                    <th width="2%" scope="col" style="text-align:center">&nbspNo.</th>
                    <th width="20%" scope="col" style="text-align:center">&nbspParticipant's Name</th>
                    <th width="15%" scope="col" style="text-align:center">&nbspParticipant's Email</th>
                    <th width="10%" scope="col" style="text-align:center">&nbspParticipant Type</th>
                    <th width="30%" scope="col" style="text-align:center">&nbspTitle of Campaign</th>
                </tr>


                <?php
                $records = mysqli_query($conn, "select participant.name, participant.email, participant.participant_type, 
            event.title from `event`, `participant` WHERE event.event_id = participant.event_id AND event.title = $title");

                $j = 1;
                while ($data = mysqli_fetch_assoc($records)) {
                    $name = $data['name'];
                    $email = $data['email'];
                    $paticipant_type = $data['participant_type'];
                    $title = $data['title'];

                ?>
                    <tr class="listtr">
                        <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $j; ?></td>
                        <td class="listtd"><?php echo "&nbsp" . $name; ?></td>
                        <td class="listtd"><?php echo "&nbsp" . $email; ?></td>
                        <td class="listtd"><?php echo "&nbsp" . $paticipant_type; ?></td>
                        <td class="listtd"><?php echo "&nbsp" . $title; ?></td>
                    </tr>

                <?php
                    $j++;
                }
                ?>
    </section>
<?php
}
?>

<!------------------------------------------------------------------------- search event --------------------------------------------------------------------------------------->

<br><br>
<h1 style="text-align: center;">All campaign participant list</h1>
<br><br>
<form action="" method="POST" class="container">
    <label for="cars"><h2>Select the event that you want to view</h2></label><br>
    <select id="title" name="title">
        <?php
        $records = mysqli_query($conn, "select title from `event`");

        while ($data = mysqli_fetch_assoc($records)) {
            $title = $data['title'];
        ?>
            <option value="<?php echo $title ?>"><?php echo $title ?></option>

        <?php
        }
        ?>
    </select>
    <input class="button" style="width:63px; height:35px; background-color:green;" type="submit" name="submit">
</form>

<!------------------------------------------------------------------------- participant list --------------------------------------------------------------------------------------->

<br><br><br><br>
<section class="inner-page">
    <div style="background-color:#ccbca2;">

        <table style="border:2">
            <tr>
                <th width="2%" scope="col" style="text-align:center">&nbspNo.</th>
                <th width="20%" scope="col" style="text-align:center">&nbspParticipant's Name</th>
                <th width="15%" scope="col" style="text-align:center">&nbspParticipant's Email</th>
                <th width="10%" scope="col" style="text-align:center">&nbspParticipant Type</th>
                <th width="30%" scope="col" style="text-align:center">&nbspTitle of Campaign</th>
            </tr>


            <?php
            $records = mysqli_query($conn, "select participant.name, participant.email, participant.participant_type, 
            event.title from `event`, `participant` WHERE event.event_id = participant.event_id");

            $j = 1;
            while ($data = mysqli_fetch_assoc($records)) {
                $name = $data['name'];
                $email = $data['email'];
                $paticipant_type = $data['participant_type'];
                $title = $data['title'];

            ?>
                <tr class="listtr">
                    <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $j; ?></td>
                    <td class="listtd"><?php echo "&nbsp" . $name; ?></td>
                    <td class="listtd"><?php echo "&nbsp" . $email; ?></td>
                    <td class="listtd"><?php echo "&nbsp" . $paticipant_type; ?></td>
                    <td class="listtd"><?php echo "&nbsp" . $title; ?></td>
                </tr>

            <?php
                $j++;
            }
            ?>
</section>

</body>
