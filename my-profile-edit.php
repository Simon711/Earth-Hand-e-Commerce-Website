<?php 
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');

mysqli_select_db($conn,"id18159895_adproject");

if(isset($_POST['submit'])){

    $email = $userid;   
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $address = $_POST['Address'];
    $postcode = $_POST['Postcode'];
    $state = $_POST['State'];
    $city = $_POST['City'];
    $phoneno = $_POST['Phone'];

    $filename = $_FILES['image']['name'];
  
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png");
    $avatar = 'images/avatar/'.$filename;


    if(move_uploaded_file($_FILES["image"]["tmp_name"],'images/avatar/'.$filename)){
        // Image db insert sql
                $sql = "UPDATE table_user INNER JOIN table_profile 
                on (table_user.UserID = table_profile.Email)
                SET `fName`= '".$fname."',`lName`='".$lname."',`Address`='".$address."',
                `Postcode`='".$postcode."',`State`='".$state."',`City`='".$city."',
                `Phone`='".$phoneno."',`Avatar`='".$avatar."'
                WHERE (table_user.UserID = '".$email."')"; 
            
            mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
            if (mysqli_query($conn,$sql)){
                goto2("my-account-profile.php","Update Successfully!");
            }
            else{
                echo 'Error: '.mysqli_error($conn);
            }
      
    }
    else{
 
        $sql = "UPDATE table_user INNER JOIN table_profile 
        on (table_user.UserID = table_profile.Email)
        SET `fName`= '".$fname."',`lName`='".$lname."',`Address`='".$address."',
        `Postcode`='".$postcode."',`State`='".$state."',`City`='".$city."',
        `Phone`='".$phoneno."'
        WHERE (table_user.UserID = '".$email."')"; 
            
            mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
            if (mysqli_query($conn,$sql)){
                goto2("my-account-profile.php","Update Successfully!");
            }
            else{
                echo 'Error: '.mysqli_error($conn);
            }
        
    }

        // $sql = "UPDATE table_user INNER JOIN table_profile 
        // on (table_user.UserID = table_profile.Email)
        // SET `fName`= '".$fname."',`lName`='".$lname."',`Address`='".$address."',
        // `Postcode`='".$postcode."',`State`='".$state."',`City`='".$city."',
        // `Phone`='".$phoneno."',`Avatar`='".$avatar."'
        // WHERE (table_user.UserID = '".$email."')"; 

        mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
        $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
        echo $result;
        if (!$result == TRUE){
           // echo $result;
            goto2("my-profile-edit.php","The profile is Failed to be Updated");
        }else {
            goto2("my-account-profile.php","Profile is successfully updated");
                //echo"<script> alert('The Photo is Successfully Updated');  </script>";
            }
}
else{
		
	

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
    <link rel="shortcut icon" href="images/project-logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/project-logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

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

.accountbutton{
    display:flex;
    justify-content: center;  
}
</style>

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

    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page">
                <div class="row">
                    
                <div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
    <?php
    $email=$userid;
    //echo $email;
    $sql =  "SELECT * FROM `id18159895_adproject`.`table_user` INNER JOIN `id18159895_adproject`.`table_profile` ON table_user.UserID = table_profile.Email
    WHERE (UserID='".$email."')";
    mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
    $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
    // goto2("../index.php","Photo details is successfully updated");
  
    $row=mysqli_fetch_assoc($result); 
    ?>
    <form action="my-profile-edit.php?UserID=<?php echo $email;?>" method="POST" enctype="multipart/form-data">
        
        <div class="my-4">
                    
                
                <div class="avatar avatar-xl" style="margin-left: 285px;">
                    <img src= "<?php echo $row['Avatar']; ?>" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="form-group">
                    <input type="file" name="image" id="file" multiple>
                </div> 

                <hr class="my-4" />
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" name="fName" class="form-control" value="<?php echo $row['fName']; ?>">       
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" name="lName" class="form-control" value="<?php echo $row['lName']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" disabled id="inputEmail4" name="Email" value="<?php echo $row['Email']; ?>" >
                </div>
                <div class="form-group">
                    <label for="inputAddress5">Address</label>
                    <input type="text" class="form-control" id="inputAddress5" name="Address" value="<?php echo $row['Address']; ?>">
                </div>
                <div class="form-group">
                        <label for="inputZip5">City</label>
                        <input type="text" class="form-control" id="City" name="City" value="<?php echo $row['City']; ?>" >
                    </div>
                <div class="form-row">                  
                    <div class="form-group col-md-4">
                        <label for="inputState5">State</label>
                        <select id="inputState5" name="State" class="form-control">
                            <?php echo "<option selected='selected'>".$row['State']."</option> " ?>
                            <option>Johor</option>
                            <option>Kedah</option>
                            <option>Kelantan</option>
                            <option>Melaka</option>
                            <option>Negeri Sembilan</option>
                            <option>Pahang</option>
                            <option>Penang</option>
                            <option>Perak</option>
                            <option>Perlis</option>
                            <option>Sabah</option>
                            <option>Sarawak</option>
                            <option>Selangor</option>
                            <option>Terengganu</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip5">Zip</label>
                        <input type="text" class="form-control" id="inputZip5" name="Postcode" value="<?php echo $row['Postcode']; ?>" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phonenumber">Phone number</label>
                        <input type="text" class="form-control" id="phonenumber" name="Phone" value="<?php echo $row['Phone']; ?>" >
                    </div>
                </div>                           
            
        </div>
                <div class="accountbutton">
                <button type="submit" name="submit" class="btn hvr-hover" style="color: white; font-weight: 700; padding: 0px 20px; height: 44px;">Submit</button> 
                </div>
                <br>
                <div class="accountbutton">            
                <a href="my-account-profile.php"><button type="button" class="btn hvr-hover" style="color: white; font-weight: 700; padding: 0px 20px; height: 44px;">Back</button>
                </div>
        </div>
    </div>
</div>   
</form>               
                </div>
                <div class="bottom-box">
                    <div class="row">
                      
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- End My Account -->

    
    <?php include("footer.php"); ?>

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>

<?php } ?>