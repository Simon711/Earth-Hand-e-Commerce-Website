<?php
require_once('../config/settings.php');
require_once("../config/db.php");
require_once("../config/function.php");
require_once('../config/session.php');
include("header2.php");
?>

<style>
  table {
  /* font-family: arial, sans-serif; */
  border-collapse: collapse;
  width: 100%;
}

.listth, .listtd {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.listtr:first-child {
  background-color: #ccbca2;
}

/* .listtr:nth-child(odd) {
  background-color: #fff;
} */

.listtd{
  background-color:  #ffffff;
}

.listtr:nth-child(even) {
  background-color:  #ffffff;
}
</style>



<link href="../css/simon/style.css" rel="stylesheet">
<link href="../css/simon/btnstyle.css" rel="stylesheet">



<?php
if(isset($_POST["submit"])) {
  $_search = $_POST["date"];
?>

<!------------------------------------------------------------------------- search event --------------------------------------------------------------------------------------->
<body>
<section class="inner-page">
  <div style="background-color:#ccbca2;">
  <br>
  <h1 style="text-align: center;"><strong>Search by <?php echo "\"". $_search . "\""?> </strong></h1><br>
  <table style="border:2">
    <tr>
      <th width="2%" scope="col" style="text-align:center">&nbspNo.</th>
      <th width="30%" scope="col" style="text-align:center">&nbspTitle</th>
      <th width="12%" scope="col" style="text-align:center">&nbspLocation</th>
      <th width="7%" scope="col" style="text-align:center">&nbspDate</th>
      <th width="8%" scope="col" style="text-align:center">&nbspTime</th>
      <th width="10%" scope="col" style="text-align:center">&nbspContact</th>
      <th width="10%" scope="col" style="text-align:center">&nbspBanner</th>
      <th width="5%" scope="col" style="text-align:center">&nbspDelete</th>
    </tr>
  
  <?php

  $records = mysqli_query($conn,"select * from `event` WHERE `date`='$_search'"); // fetch data from database
  $j=0;
  while($data = mysqli_fetch_assoc($records))
  {
    $title = $data['title'];
    $location = $data['location'];
    $date = $data['date'];
    $time = $data['time'];
    $contact = $data['contact'];
    $imageURL = '../banner/'.$data["banner"]; 
    ?>
    
    <tr >
      <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $j+1; ?></td>
      <td class="listtd" ><?php echo "&nbsp" . $title; ?></td>
      <td class="listtd" ><?php echo "&nbsp" . $location; ?></td>
      <td class="listtd"  style="text-align:center"><?php echo "&nbsp" . $date; ?></td> 
      <td class="listtd"  style="text-align:center"><?php echo "&nbsp" . $time; ?></td>
      <td class="listtd"  style="text-align:center"><?php echo "&nbsp" . $contact; ?></td>
      <td class="listtd"  style="text-align:center"><img src="<?php echo $imageURL; ?>" alt="" width="50%" height="50%"/></td>
      <td class="listtd"  style="text-align:center"><a href="remove_campaign.php?contact=<?php echo $data['contact']; ?>"
      onclick="return confirm('DO YOU CONFIRM TO DELETE ALL SELECTED EVENT? NO REDO CAN BE DONE AFTER THIS')">&nbspDelete</a></td>
    </tr>	
 
  
  <?php

  $j++;
    
  }
  ?>
  </table>
<br>

  
<form action="remove_selected_event.php" method="POST" class="container">
  <label for="data"><h3>You can delete all these records</h3></label>
    <input style="background-color:pink;" type="text" id="date" name="date" value="<?php echo $_search ?>" readonly>
    <button style="width:100px; height:38px; background-color:red; border-radius:10px; color:white;" type="submit" name="remove_selected_event" 
      onclick="return confirm('DO YOU CONFIRM TO DELETE? NO REDO CAN BE DONE AFTER THIS')">Delete All</button>
</form> 

<br>
  </div>
  
</section>


<?php   
}
?>


<br><br>
<form action="" method="POST" class="container">
<label for="date"><h2>Select the date that you want to view</h2></label><br>
<input type="date" id="date" name="date">
<input class="button" style="width:63px; height:35px; background-color:green;" type="submit" name="submit" value="Search">
</form> 




<!------------------------------------------------------------------------- event list --------------------------------------------------------------------------------------->
  <br><br><br><br>
  <div>
        <h1 style="text-align: center;"><strong>Viewing all event list</strong></h1><br>
        <table style="border:20">
          <tr class="listtr">
            <th class="listth" width="2%" scope="col" style="text-align:center">&nbspNo.</th>
            <th class="listth" width="30%" scope="col" style="text-align:center">&nbspTitle</th>
            <th class="listth" width="12%" scope="col" style="text-align:center">&nbspLocation</th>
            <th class="listth" width="7%" scope="col" style="text-align:center">&nbspDate</th>
            <th class="listth" width="8%" scope="col" style="text-align:center">&nbspTime</th>
            <th class="listth" width="10%" scope="col" style="text-align:center">&nbspContact</th>
            <th class="listth" width="10%" scope="col" style="text-align:center">&nbspBanner</th>
            <th class="listth" width="5%" scope="col" style="text-align:center">&nbspDelete</th>
          </tr>

          <?php

          $records = mysqli_query($conn,"select * from `event`"); // fetch data from database
          $j=1;
          while($data = mysqli_fetch_assoc($records))
          {
            $title = $data['title'];
            $location = $data['location'];
            $date = $data['date'];
            $time = $data['time'];
            $contact = $data['contact'];
            $imageURL = '../banner/'.$data["banner"]; 
          ?>
      
          <tr class="listtr">
          <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $j; ?></td>
            <td class="listtd"><?php echo "&nbsp" . $title; ?></td>
            <td class="listtd"><?php echo "&nbsp" . $location; ?></td>
            <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $date; ?></td> 
            <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $time; ?></td>
            <td class="listtd" style="text-align:center"><?php echo "&nbsp" . $contact; ?></td>
            <td class="listtd" style="text-align:center"><img src="<?php echo $imageURL; ?>" alt="" width="50%" height="50%"/></td>
            <td class="listtd" style="text-align:center"><a href="remove_campaign.php?contact=<?php echo $data['contact']; ?>"onclick="return confirm('DO YOU CONFIRM TO DELETE THIS EVENT? NO REDO CAN BE DONE AFTER THIS')">&nbspDelete</a></td>
          </tr>

          <?php
          $j++;
          }
          ?>

        </table>
  </div><br><br>

  
  <!-- Start Footer  -->
  <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About ThewayShop</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas nothing fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas nothing fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas nothing fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2021 <a href="#">Earth Hand</a> Design By :
            ZHAZHA</p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../js/jquery.superslides.min.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    <script src="../js/inewsticker.js"></script>
    <script src="../js/bootsnav.js."></script>
    <script src="../js/images-loded.min.js"></script>
    <script src="../js/isotope.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/baguetteBox.min.js"></script>
    <script src="../js/form-validator.min.js"></script>
    <script src="../js/contact-form-script.js"></script>
    <script src="../js/custom.js"></script>
  </body>

 