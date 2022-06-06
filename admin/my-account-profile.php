<?php include("../config/settings.php");
require_once('../config/db.php');
require_once('../config/function.php');
require_once('../config/session.php');

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Earth Hand</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/project-logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../images/project-logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>

.avatar-xl img {
    width: 150px;
  
}
.rounded-circle {
    border-radius: 50% !important;
}
img {
    vertical-align: middle;
    border-style: none;
}

.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4d5154;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #eef0f3;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

td:first-child {
  background-color: #ccbca2;
  color: white;
}

.accountbutton{
    display:flex;
    justify-content: center;  
}
</style>

<script>
    function confirmationDelete(anchor)
    {
        var conf = confirm('Are you sure want to delete this record? All the account details will be deleted.');
        if(conf)
            window.location=anchor.attr("href");
    }
    </script>

</head>

<body>

<?php 

    include("header2.php");


?>
    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
                        <li class="breadcrumb-item"><a href="my-account.php">My Account</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <?php  if (isset($userid)){ ?>
    <?php  
        $email = $userid;   
        $sql1 = "select * from table_user INNER JOIN table_profile ON table_user.UserID = table_profile.Email
        WHERE (UserID='".$email."')";
        mysqli_select_db($conn,"id18159895_adproject");
        $result = mysqli_query($conn,$sql1);  //command allow sql cmd to be sent to mysql
        if (mysqli_num_rows($result) != 0)
        {
            $row=mysqli_fetch_assoc($result)
            ?>

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page">
                <div class="row">
                    
                <div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        
        <div class="my-4">
            
            <form>
              <!--  <div class="row mt-5 align-items-center">
                    <div class="col-md-12 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="images/avatar.png" alt="..." class="avatar-img rounded-circle" />
                        </div>
                    </div>        
                </div>-->
                <div class="avatar avatar-xl" style="margin-left: 285px;">
                            <img src="<?php echo $row['Avatar'] ?>" alt="..." class="avatar-img rounded-circle" />
                </div>
                <hr class="my-4" />
                <table width="100%">
                <tr>
                    <td width="25%">First Name</td>
                    <td width="75%"><?php echo $row["fName"]; ?></td>                  
                </tr>
                <tr>
                    <td width="25%">Last Name</td>
                    <td width="75%"><?php echo $row["lName"]; ?></td>                  
                </tr>
                <tr>
                    <td width="25%">Email</td>
                    <td width="75%"><?php echo $row["Email"]; ?></td>                  
                </tr>
              
                <tr>
                    <td width="25%">Phone No.</td>
                    <td width="75%"><?php echo $row["Phone"]; ?></td>                
                </tr>
                <tr>
                    <td width="25%">Address</td>
                    <td width="75%"><?php echo $row["Address"]; ?></td>                   
                </tr>
                <tr>
                    <td width="25%">Postcode</td>
                    <td width="75%"><?php echo $row["Postcode"]; ?></td>                   
                </tr>
                <tr>
                    <td width="25%">City</td>
                    <td width="75%"><?php echo $row["City"]; ?></td>                   
                </tr>
                <tr>
                    <td width="25%">State</td>
                    <td width="75%"><?php echo $row["State"]; ?></td>                   
                </tr>
                
                </table>
                <br><br>
                
            </form>
            <div class="accountbutton">
            <a href="my-profile-edit.php?UserID=<?php echo $row['UserID'];?>">
                <button style="border: 2px solid #c3b092; 
                color:#c3b092; background-color:white;
                 padding: 2px 50px;" 
                type="button" class="btn">Edit</button>
                </a>          
            </div>
        </div>
    </div>
</div>

<?php 
    } 
        
            ?>

</div>                   
                </div>
                
                <div class="bottom-box">
                    <div class="row">
                    
                    </div>
                </div>
                <div class="accountbutton">
                    <a onclick='javascript:confirmationDelete($(this));return false;' 
                    href="my-account-delete.php?Email=<?php echo $email;?>">
                <button style="border: 2px solid red; 
                color:red; background-color:white;
                padding: 2px 50px;" 
                type="button" class="btn">Delete Account</button>
                </a>
                </div>
            </div>
        </div>
    </div> 
    <!-- End My Account -->
    <?php
    }else{ ?>

<div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page">
                <div class="row">
                    
                <div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        
        <div class="my-4">
            
            <form>
              
                <div class="avatar avatar-xl" style="margin-left: 285px;">
                            <img src="../images/avatar1.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <hr class="my-4" />
                <table width="100%">
                <tr>
                    <td width="25%">First Name</td>
                    <td width="75%"> </td>                  
                </tr>
                <tr>
                    <td width="25%">Last Name</td>
                    <td width="75%"> </td>                  
                </tr>
                <tr>
                    <td width="25%">Email</td>
                    <td width="75%"> </td>                  
                </tr>
              
                <tr>
                    <td width="25%">Phone No.</td>
                    <td width="75%"> </td>                
                </tr>
                <tr>
                    <td width="25%">Address</td>
                    <td width="75%"> </td>                   
                </tr>
                <tr>
                    <td width="25%">Postcode</td>
                    <td width="75%"> </td>                   
                </tr>
                <tr>
                    <td width="25%">City</td>
                    <td width="75%"> </td>                   
                </tr>
                <tr>
                    <td width="25%">State</td>
                    <td width="75%"> </td>                   
                </tr>
                
                </table>
                <br><br>
                
            </form>
                     
            
        </div>
    </div>
</div>


</div>                   
                </div>
                
                <div class="bottom-box">
                    <div class="row">
                    
                    </div>
                </div>
                    
            </div>
        </div>
    </div> 
    <!-- End My Account -->
        
  <?php  } ?>

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="../images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Earth Hand</h4>
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
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
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

</html>