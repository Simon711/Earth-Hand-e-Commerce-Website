<?php
    require_once('config/settings.php');
    require_once('config/db.php');
    require_once('config/function.php');
?>
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
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js%22%3E</script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js%22%3E</script>
    <![endif]-->

</head>

<div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <!-- <div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
						<option>RM MYR</option>
						<option>$ USD</option>
						<option>€ EUR</option>
					</select>
                    </div> -->
                    <!-- <div class="right-phone-box">
                        <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                    </div> -->
                    <div class="our-link">
                        <ul>
                        <ul><img src="images/avatar1.jpg" alt="..." class="avatar-img rounded-circle" width="26"/>
                            <li>
                                <a href="my-account.php">My Account</a></li>
                            <li><a href="#">Our location</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="register.php">REGISTER</li>
                            <li><a href="login.php">LOGIN</li>
                        </ul>
                        
                    </div>
                    
                        
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

<header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width: 250px;" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="dropdown megamenu-fw">
                            <a href="#" class="nav-link" data-toggle="dropdown">Product</a>
                            <ul class="dropdown-menu megamenu-content" role="menu">
                                <li>
                                <div class="row">
                                        <?php
                                            $count_category = "SELECT COUNT(*) FROM tblproduct_category1";
                                            mysqli_select_db($conn, "id18159895_adproject");
                                            $result_count_category = mysqli_query($conn, $count_category); 
                                            $row_count_category=mysqli_fetch_row($result_count_category);
                                            $total_category=$row_count_category[0];
                                            
                                            for($i=0; $i<$total_category; $i++) 
                                            {
                                                $j=$i+1;
                                                $sql = "SELECT * FROM tblproduct_category1 WHERE categoryID = '".$j."'";
                                                mysqli_select_db($conn, "id18159895_adproject");
                                                $result = mysqli_query($conn, $sql); 
                                                $row=mysqli_fetch_assoc($result);
                                        
                                        ?>
                                            <div class="col-menu col-md-3">
                                                <h6 class="title"><?php echo $row['productCategory1']; ?> </h6>
                                                <div class="content">
                                                    <ul class="menu-col">
                                                    <?php
                                                        $sql = "SELECT * FROM tblproduct_category2 WHERE categoryID = '".$j."'";
                                                        mysqli_select_db($conn, "id18159895_adproject");
                                                        $result = mysqli_query($conn, $sql); 
                                                        while($row=mysqli_fetch_assoc($result)) {
                                                            
                                                    ?>
                                                        <li><a href="shop.php?categoryID2=<?php echo $row['categoryID2']; ?>"><?php echo $row['productCategory2']; ?></a></li>
                                                    <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        
                                    </div>
                                    <!-- end row -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown active">
                            <a href="#" class="nav-link" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
                                <li><a href="login.php">Cart</a></li>
                                <li><a href="login.php">Checkout</a></li>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="login.php">My Product</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="service.php">Our Service</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li><a href="login.php">
						<i class="fa fa-shopping-bag"></i>
                           
					</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <!-- <div class="side">
                <a href="login.php" class="close-side"><i class="fa fa-times"></i></a>
                
            </div> -->
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>