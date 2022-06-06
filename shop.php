<?php
    require_once('config/settings.php');
    require_once('config/db.php');
    require_once('config/function.php');
    require_once('config/session.php');

    $categoryid2 = $_GET['categoryID2'];
    
    mysqli_select_db($conn, 'id18159895_adproject');
    if(isset($_POST['add_to_cart'])){
        $pid = $_POST['hidden_id'];
        $sql = "SELECT * FROM `id18159895_adproject`.`tbl_cart` WHERE `productID`='".$pid."' AND `UserID` = '".$userid."'";
        $cart=mysqli_query($conn,$sql);
        $rowcart = mysqli_fetch_assoc($cart);
            if($rowcart['productID']==$pid){
                $sqlstock = "SELECT * FROM `id18159895_adproject`.`tblproduct` WHERE `productID`='".$pid."'";
                $checkstock = mysqli_query($conn,$sqlstock);
                $rowstock = mysqli_fetch_assoc($checkstock);
                $pname=$rowstock['productName'];
                $stock=$rowstock['stock'];
                $quan=$rowcart['orderQuantity'];
                if($quan==$stock){
                    goto2("shop.php?categoryID2=$categoryid2", "$pname has only left $stock ! You have added $quan in your cart.");
                }
                else{
                    $quan = $quan+1;
                    $update = "UPDATE `id18159895_adproject`.`tbl_cart` set `orderQuantity`='".$quan."' WHERE `productID`='".$pid."' AND `UserID` = '".$userid."'";
                    if (mysqli_query($conn, $update)){
                        goto2("cart.php","Add Successfully!");
                    }
                    else{
                        echo 'Error: '.mysqli_error($conn);
                    }
                }
            }
            else if($rowcart['productID']!=$pid){
                $cartid = countCart($userid)+1;
        
                $insert = "INSERT INTO `id18159895_adproject`.`tbl_cart` (`productID`,`UserID`, `orderQuantity`,`cartID`) VALUES('".$pid."','".$userid."', 1, '".$cartid."')";

                mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
                if (mysqli_query($conn, $insert)){
                    goto2("cart.php","Add Successfully!");
                }
                else{
                    echo 'Error: '.mysqli_error($conn);
                }
            }
        
    }
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

    <style>
    .cart{
        background: #c3b092;
        position: absolute;
        bottom: 0;
        right: 0px;
        padding: 10px 20px;
        font-weight: 700;
        color: #ffffff;
    }

    .cart:hover{
        background: #010101;
        color: #ffffff;
    }
    </style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js%22%3E</script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js%22%3E</script>
    <![endif]-->

</head>

<body>

    <?php 

    if (isset($_SESSION['UserID']) ) {
        include("header2.php");
    }else{
        include("header1.php");
    }

    ?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <?php 
                            
                        ?>
                        <div class="search-product">
                        <?php

                            $sqlp = "SELECT * FROM tblproduct a JOIN tblproduct_image b ON a.productID = b.productID WHERE productCategory2 = '".$categoryid2."' GROUP BY a.productID";
                            mysqli_select_db($conn, "id18159895_adproject");
                            $resultp = mysqli_query($conn, $sqlp); //command allows sql command to be sent to mysql

                            $query = "SELECT COUNT(*) FROM tblproduct WHERE productCategory2 = '".$categoryid2."'";     
                            $rs_result = mysqli_query($conn, $query);     
                            $rows = mysqli_fetch_row($rs_result);     
                            $total_records = $rows[0];
                            
                            if(isset($_POST['btn_search'])) {
                                $searchbox_field = mysqli_real_escape_string($conn, $_REQUEST['searchbox']);
                                $sqlp = "SELECT * FROM `tblproduct` a JOIN `tblproduct_image` b ON a.productID = b.productID WHERE 
                                (UPPER(`productName`) LIKE UPPER('%".$searchbox_field."%')) GROUP BY a.productID";
                                mysqli_select_db($conn, "id18159895_adproject");
                                $resultp = mysqli_query($conn, $sqlp); //command allows sql command to be sent to mysql

                                $query = "SELECT COUNT(*) FROM tblproduct WHERE UPPER(productName) LIKE UPPER('%".$searchbox_field."%')";     
                                $rs_result = mysqli_query($conn, $query);     
                                $rows = mysqli_fetch_row($rs_result);     
                                $total_records = $rows[0];
                            }
                        ?>
                        <form id="searchform" method="POST" enctype="multipart/form-data">
                            <input class="form-control" placeholder="Search here..." type="text" name="searchbox">
                            <button type="submit" name="btn_search"> <i class="fa fa-search"></i> </button>
                        </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">

                                <?php
                                    $count_category = "SELECT COUNT(*) FROM tblproduct_category1";
                                    mysqli_select_db($conn, "id18159895_adproject");
                                    $result_count_category = mysqli_query($conn, $count_category); 
                                    $row_count_category=mysqli_fetch_row($result_count_category);
                                    $total_category=$row_count_category[0];
                                    $x=1;

                                    for($i=0; $i<$total_category; $i++) 
                                    {
                                        $j=$i+1;
                                        $sql = "SELECT * FROM tblproduct_category1 WHERE categoryID = '".$j."'";
                                        mysqli_select_db($conn, "id18159895_adproject");
                                        $result = mysqli_query($conn, $sql); 
                                        $row=mysqli_fetch_assoc($result);
                                   
                                ?>

                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men<?php echo $j;?>" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men<?php echo $j;?>"><?php echo $row['productCategory1']; ?> 
                                    <?php 
                                        $count_category1 = "SELECT COUNT(*) FROM tblproduct WHERE productCategory1 = '".$j."'";
                                        mysqli_select_db($conn, "id18159895_adproject");
                                        $result_count_category1 = mysqli_query($conn, $count_category1); 
                                        $row_count_category1=mysqli_fetch_row($result_count_category1);
                                        $total_products1=$row_count_category1[0];
                                    ?>
                                    <small class="text-muted">(<?php echo $total_products1; ?>)</small>
								</a>
                                    <?php
                                        if($i==0) {
                                    ?>
                                    <div class="collapse show" id="sub-men<?php echo $j;?>" data-parent="#list-group-men">
                                    <?php } else { ?>
                                    <div class="collapse" id="sub-men<?php echo $j;?>" data-parent="#list-group-men">
                                    <?php } ?>
                                        <div class="list-group">
                                            <?php
                                               $sql = "SELECT * FROM tblproduct_category2 WHERE categoryID = '".$j."'";
                                               mysqli_select_db($conn, "id18159895_adproject");
                                               $result = mysqli_query($conn, $sql); 
                                               while($row=mysqli_fetch_assoc($result)) {
                                                   
                                            ?>
                                            <a href="shop.php?categoryID2=<?php echo $row['categoryID2']; ?>" class="list-group-item list-group-item-action"><?php echo $row['productCategory2']; ?> 
                                                <?php 
                                                    $count_category2 = "SELECT COUNT(*) FROM tblproduct WHERE productCategory2 = '".$x."'";
                                                    mysqli_select_db($conn, "id18159895_adproject");
                                                    $result_count_category2 = mysqli_query($conn, $count_category2); 
                                                    $row_count_category2=mysqli_fetch_row($result_count_category2);
                                                    $total_products2=$row_count_category2[0];
                                                ?>
                                            <small class="text-muted">(<?php echo $total_products2; ?>)</small></a>
                                            <?php $x++; } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                        </div>

                        <?php
                            
                            if(isset($_POST['btn_filter_price'])) {
                                $price = $_POST['amount'];
                                $min = $_POST['min'];
                                $max = $_POST['max'];
                                $sqlp = "SELECT * FROM tblproduct a JOIN tblproduct_image b ON a.productID = b.productID WHERE (`productCategory2` = '".$categoryid2."' 
                                AND (`price` BETWEEN '".$min."' AND '".$max."')) GROUP BY a.productID";
                                mysqli_select_db($conn, "id18159895_adproject");
                                $resultp = mysqli_query($conn, $sqlp);

                                $query = "SELECT COUNT(*) FROM tblproduct WHERE (`productCategory2` = '".$categoryid2."' 
                                AND (`price` BETWEEN '".$min."' AND '".$max."'))";
                                $rs_result = mysqli_query($conn, $query);     
                                $rows = mysqli_fetch_row($rs_result);     
                                $total_records = $rows[0];
                            } 

                        ?>

                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <form method="POST">
                                <div class="price-box-slider">
                                    <div id="slider-range"></div>
                                    <p>
                                        <input type="text" id="amount" name="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                        <input type="hidden" id="min" name="min" value="<?php if (isset($price)) echo $min; ?>">
                                        <input type="hidden" id="max" name="max" value="<?php if (isset($price)) echo $max; ?>">
                                        <button class="btn hvr-hover" name="btn_filter_price" type="submit">Filter</button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <?php 
                                        if(isset($_POST['basic'])) {
                                            $option_number = $_POST['basic']; 
                                        }
                                    ?>
                                    <form id="form_filter" method="POST">
                                        <span>Sort by </span>
                                        <select id="basic" name="basic" class="selectpicker show-tick form-control" data-placeholder="RM" onchange="form_filter.submit()">
                                            <option data-display="Select">Nothing</option>
                                            <option <?php if (isset($option_number) && $option_number==2) echo "selected";?> value="2">High Price → Low Price</option>
                                            <option <?php if (isset($option_number) && $option_number==3) echo "selected";?> value="3">Low Price → High Price</option>
                                        </select>
                                    </form>
                                </div>
                                <?php
                                    if(isset($_POST['basic'])) {
                                        if($option_number == 2) {
                                            $sqlp = "SELECT * FROM tblproduct a JOIN tblproduct_image b ON a.productID = b.productID WHERE `productCategory2` = '".$categoryid2."' 
                                            GROUP BY a.productID ORDER BY `price` DESC";
                                            mysqli_select_db($conn, "id18159895_adproject");
                                            $resultp = mysqli_query($conn, $sqlp);
                                        } else if($option_number == 3) {
                                            $sqlp = "SELECT * FROM tblproduct a JOIN tblproduct_image b ON a.productID = b.productID WHERE `productCategory2` = '".$categoryid2."' 
                                            GROUP BY a.productID ORDER BY `price` ASC";
                                            mysqli_select_db($conn, "id18159895_adproject");
                                            $resultp = mysqli_query($conn, $sqlp);
                                        }
                                    }
                                ?>
                                <p>Showing all <?php echo $total_records; ?> result(s)</p>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        <?php
                                            while($rowp=mysqli_fetch_assoc($resultp)) {
                                        ?>
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <form role="form" id="cart_form" method="post" action="">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="sale">Sale</p>
                                                        </div>
                                                        <img src="<?php echo $rowp['image1']; ?>" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="shop-detail.php?productID=<?php echo $rowp['productID']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <!-- <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li> -->
                                                                <input type="hidden" name="hidden_id" value="<?php echo $rowp['productID']; ?>" />
                                                            </ul>
                                                            <button class="cart btn hvr-hover" data-fancybox-close="" name="add_to_cart" type="submit">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <div class="why-text">
                                                        <h4><?php echo $rowp['productName']; ?></h4>
                                                        <h5>RM <?php echo $rowp['price']; ?></h5>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    <?php
                                        $resultp = mysqli_query($conn, $sqlp);
                                        while($rowp=mysqli_fetch_assoc($resultp)) {
                                    ?>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="new">Sale</p>
                                                        </div>
                                                        <img src="<?php echo $rowp['image1']; ?>" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="shop-detail.php?productID=<?php echo $rowp['productID']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4><?php echo $rowp['productName']; ?></h4>
                                                    <h5>RM <?php echo $rowp['price']; ?></h5>
                                                    <p><?php echo $rowp['productDescription']; ?></p>
                                                    <form role="form" id="cart_form" method="post" action="">
                                                        <input type="hidden" name="hidden_id" value="<?php echo $rowp['productID']; ?>" />
                                                        <button class="btn hvr-hover" name="add_to_cart" type="submit" style="color: white; font-weight: 700; padding: 0px 20px; height: 44px;">Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
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
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
