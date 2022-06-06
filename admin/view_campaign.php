<?php
require_once('../config/db.php');

?>

<link href="../css/simon/style.css" rel="stylesheet">
<link href="../css/simon/btnstyle.css" rel="stylesheet">

        <h2>Viewing all event list</h2>
        <table style="border:20">
        <tr>
          <th width="2%" scope="col" style="text-align:center">&nbspNo.</th>
          <th width="40%" scope="col" style="text-align:center">&nbspTitle</th>
          <th width="12%" scope="col" style="text-align:center">&nbspLocation</th>
          <th width="7%" scope="col" style="text-align:center">&nbspDate</th>
          <th width="8%" scope="col" style="text-align:center">&nbspTime</th>
          <th width="10%" scope="col" style="text-align:center">&nbspContact</th>
          <th width="5%" scope="col" style="text-align:center">&nbspDelete</th>
        </tr>

      <?php
      require_once("../config/db.php");

      $records = mysqli_query($conn,"select * from `event`"); // fetch data from database
      $j=1;
      while($data = mysqli_fetch_assoc($records))
      {
      ?>
        <tr>
        <td style="text-align:center"><?php echo "&nbsp" . $j; ?></td>
          <td><?php echo "&nbsp" . $data['title']; ?></td>
          <td><?php echo "&nbsp" . $data['location']; ?></td>
          <td style="text-align:center"><?php echo "&nbsp" . $data['date']; ?></td> 
          <td style="text-align:center"><?php echo "&nbsp" . $data['time']; ?></td>
          <td style="text-align:center"><?php echo "&nbsp" . $data['contact']; ?></td>
          <td style="text-align:center"><a href="remove_campaign.php?contact=<?php echo $data['contact']; ?>"onclick="return confirm('DO YOU CONFIRM TO DELETE? Y/N')">&nbspDelete</a></td>
        </tr>	

      <?php
      $j++;
      }
      ?>