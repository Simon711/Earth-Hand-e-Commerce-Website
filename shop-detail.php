<?php
    require_once('config/settings.php');
    require_once('config/db.php');
    require_once('config/function.php');
    require_once('config/session.php');
    
    mysqli_select_db($conn, 'id18159895_adproject');
    if(isset($_POST['add_to_cart'])) {
        $pid = $_GET['productID'];
        $userid = $_SESSION['UserID'];
        $sql = "SELECT * FROM `id18159895_adproject`.`tbl_cart` WHERE `productID`='".$pid."' AND `UserID` = '".$userid."'";
        $cart=mysqli_query($conn,$sql);
        $rowcart = mysqli_fetch_assoc($cart);
            if($rowcart['productID']==$pid) {
                $sqlstock = "SELECT * FROM `id18159895_adproject`.`tblproduct` WHERE `productID`='".$pid."'";
                $checkstock = mysqli_query($conn,$sqlstock);
                $rowstock = mysqli_fetch_assoc($checkstock);
                $pname=$rowstock['productName'];
                $stock=$rowstock['stock'];
                $quan=$rowcart['orderQuantity'];
                if($quan==$stock){
                    goto2("cart.php", "$pname has only left $stock ! You have added $quan in your cart.");
                    //goto2("shop-detail.php?productID=$pid&UserID=$userid", "$pname has only left $stock ! You have added $quan in your cart.");
                }
                else{
                    $quan = $quan+1;
                    $update = "UPDATE `id18159895_adproject`.`tbl_cart` set `orderQuantity`='".$quan."' WHERE `productID`='".$pid."' AND `UserID` = '".$userid."'";
                    if (mysqli_query($conn, $update)){
                        goto2("cart.php","Update Successfully!");
                    }
                    else{
                        echo 'Error: '.mysqli_error($conn);
                    }
                }
            }
            else{
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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<style>
.qna-box {
    background-color: #efe7de;
    border-style: outset;
    color: black;
    font-size: 15px;
    padding: 5px 0px 5px 10px;
}

.cart-and-bay-btn{
    margin-top: 40px;
}

.quantity-box {
    margin-left: 8px;
    margin-top: 10px;
}

.pr-specs th{
    padding: 5px 24px 18px 10px; 
}

.pr-specs td{
    padding: 5px 0px 18px 0px;
}

.pr-container{
    background-color: #f5f5f5;
}

.cart{
    background: #d33b33;
    position: absolute;
    bottom: 0;
    right: 0px;
    padding: 10px 20px;
    font-weight: 700;
    color: #ffffff;
}

.cart:hover{
    background: #ff0000;
    color: #ffffff;
}

</style>
</head>
<body>
    <?php 

    if (isset($_SESSION['UserID'])) {
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
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                                $productID = $_GET['productID'];
                                $sql = "select * from tblproduct a join tblproduct_image b on a.productID = b.productID where a.productID = '".$productID."'";
                                mysqli_select_db($conn, "id18159895_adproject");
                                $result = mysqli_query($conn, $sql); //command allows sql command to be sent to mysql
                                $row=mysqli_fetch_assoc($result);
    
                                $target_dir = "products/".$productID."/";
                                $images = glob($target_dir."*.{jpg,png,jpeg,gif}", GLOB_BRACE);
                                
                            ?>
                            <div class="carousel-item active"> <img class="d-block w-100" src="<?php echo $row['image1']; ?>" alt="First slide"> </div>
                            <?php 
                                foreach($images as $image) {
                                    if($image != $row['image1']) {
                            ?>
                            <div class="carousel-item"> <img class="d-block w-100" src="<?php echo $image; ?>" alt=""> </div>
                            <?php }} ?>
                            
                                
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid" src="<?php echo $row['image1']; ?>" alt="" />
                            </li>
                            <?php foreach($images as $image) { 
                                if($image != $row['image1']) {
                                    $i=1;
                            ?>
                                
                                <li data-target="#carousel-example-1" data-slide-to="$i" class="active">
                                    <img class="d-block w-100 img-fluid" src="<?php echo $image; ?>" alt="" />
                                </li>

                            <?php $i++; }} ?>
                        </ol>
                        
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">

                        <h2><?php echo $row['productName']; ?></h2>
                        <h5> RM <?php echo $row['price']; ?> </h5>
                        
                            <h4>Short Description:</h4>
                            <p><?php echo $row['productDescription']; ?></p>
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" value="1" min="0" max="<?php echo $row['stock']; ?>" type="number">
                                    </div>
                                </li>
                                <li>
                                    <form role="form" method="post" action="">
                                        <div class="form-group price-box-bar">
                                            <div class="cart-and-bay-btn">
                                                    <!-- <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a> -->
                                                    <!-- <input type="submit" name="add_to_cart"  class="cart btn hvr-hover" value="Add to Cart" /> -->
                                                    <button class="btn hvr-hover" data-fancybox-close="" name="add_to_cart" type="submit" style="color: white; font-weight: 700; padding: 0px 20px; height: 43px;">Add to Cart</button>
                                                    &nbsp;
                                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy Now</a>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>

                            <!-- <div class="add-to-btn">
                                <div class="add-comp">
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                </div>
                                
                            </div> -->
                    </div>
                </div>
            </div>


            <br>
            <div class="pr-specs">
                <div class="single-product-details">
                    <h4>Product Specifications</h4>
                    <hr>

                    <?php
                        $categoryID2 = $row['productCategory2'];
                        $sql2 = "select * from tblproduct_category2 c1 join tblproduct_category1 c2 on c1.categoryID = c2.categoryID where categoryID2 = '".$categoryID2."'";
                        mysqli_select_db($conn, "id18159895_adproject");
                        $result2 = mysqli_query($conn, $sql2); //command allows sql command to be sent to mysql
                        $row2=mysqli_fetch_assoc($result2);
                    ?>

                    <div class="pr-container">
                        <table>
                            <tr>
                                <th>Category</th>
                                <td><?php echo $row2['productCategory1']; ?> <strong style="font-size: 22px;">&gt;</strong> <?php echo $row2['productCategory2']; ?></td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td><?php echo $row['productBrand']; ?></td>
                            </tr>
                            <tr>
                                <th>Ships from</th>
                                <td><?php echo $row['productOrigin']; ?></td>
                            </tr>
                            <tr>
                                <th>Shipping fees</th>
                                <td>RM <?php echo $row['postage']; ?></td>
                            </tr>
                            <tr>
                                <th>What's in the box?</th>
                                <td><?php echo $row['productBox']; ?></td>
                            </tr>
                            
                        </table>
                    </div>
                    
                </div>
            </div>


            
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Questions & Answers</h1>
                    </div>
                    <!-- <div class="qna-box">
                        <p><b>Question </b>: Will this shirt decolorise?</p>
                        <p>3 replies</p>
                    </div>
                    <br>
                    <div class="qna-box">
                        <p><b>Question </b>: Will this shirt decolorise?</p>
                        <p>3 replies</p>
                    </div>
                    <br>
                    <div class="qna-box">
                        <p><b>Question </b>: Will this shirt decolorise?</p>
                        <p>3 replies</p>
                    </div> -->

                    <?php include('qna.php'); ?>
                </div>
            </div>

        </div>
    </div>
    

    <?php include('footer.php'); ?>
</body>

</html>