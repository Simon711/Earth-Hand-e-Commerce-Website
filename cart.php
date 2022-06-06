<?php
    require_once('config/settings.php');
    require_once('config/db.php');
    require_once('config/function.php');
    require_once('config/session.php');
    
    mysqli_select_db($conn, 'id18159895_adproject');
    if(isset($_POST['update_cart'])) {
        $array = array_combine($_POST['hidden_id'], $_POST['quantity']);
        foreach($array AS $pid=>$quan) {
            $update = "UPDATE `id18159895_adproject`.`tbl_cart` 
            set `orderQuantity`='".$quan."' WHERE `productID`='".$pid."' AND `UserID` = '".$userid."'";

            $sqlstock = "SELECT * FROM `id18159895_adproject`.`tblproduct` WHERE `productID`='".$pid."'";
            $checkstock = mysqli_query($conn,$sqlstock);
            $rowstock = mysqli_fetch_assoc($checkstock);
            $pname=$rowstock['productName'];
            $stock=$rowstock['stock'];
            mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
            if($quan > $stock) {
                goto2("cart.php", "$pname has only left $stock !");
            }
            else{
                if (mysqli_query($conn, $update)) {
                    // goto2("cart.php","Update Successfully!");
                }
                else{
                    echo 'Error: '.mysqli_error($conn);
                }
            }
        }
        goto2("cart.php","Update Successfully!");
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
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js%22%3E</script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js%22%3E</script>
    <![endif]-->

    <style>
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <?php 

    if (isset($_SESSION['UserID'])){
        include("header2.php");
    }else{
        include("header1.php");
    }

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
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    
    <div class="cart-box-main">
        <div class="container">
        <?php
                            
            //$sql = "SELECT * FROM (`id18159895_adproject`.`cart` as cart Join `id18159895_adproject`.`tblproduct` as product on cart.productID=product.productID)";
            $sql = "SELECT * FROM ((`id18159895_adproject`.`tbl_cart` INNER JOIN `id18159895_adproject`.`tblproduct` ON tbl_cart.productID = tblproduct.productID AND tbl_cart.UserID = '".$userid."') INNER JOIN `id18159895_adproject`.`tblproduct_image` ON tblproduct.productID = tblproduct_image.productID) GROUP BY tblproduct.productID" ;
            mysqli_select_db($conn, "id18159895_adproject");
            
            $result = mysqli_query($conn, $sql);
            
            ?>
            <?php
            if(is_null(mysqli_fetch_assoc($result))){
                    ?> 
                    <img style="margin-left: 200px;" class="img-fluid" src="images/empty_cart_new.png" alt="" />
                    <h2 style="margin-left: 360px;"><b>Oopss...There is nothing in your cart yet...</b><br></h2>
                    <h2 style="margin-left: 385px;"><b>Add something to make me happy!</b></h2>
            <?php
            }
            else{

            ?>
        <form role="form" method="post" action="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            
                            <?php                         
                           
                            $sum = 0;
                            $totalsf = 0;
                            $result2 = mysqli_query($conn, $sql);
                            while( $row = mysqli_fetch_assoc($result2)){
                                ?>
                            <tbody>
                            
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="shop-detail.php?productID=<?php echo $row['productID']; ?>">
									<img class="img-fluid" src="<?php echo $row["image1"]; ?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="shop-detail.php?productID=<?php echo $row['productID']; ?>">
                                        <?php echo $row['productName'];?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>RM <?php echo $row['price'];?></p>
                                    </td>
                                    <td class="quantity-box"><input type="number" name="quantity[]" value="<?php echo $row['orderQuantity']; ?>" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p>RM <?php echo number_format(($row['price']*$row['orderQuantity']),2)?></p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="deletecart.php?cartID=<?php echo $row['cartID'] ?>">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <input type="hidden" name="hidden_id[]" value="<?php echo $row["productID"]; ?>" />
                                <?php
                                
                                $sum = $sum + ($row['price']*$row['orderQuantity']);
                                $sum = number_format($sum, 2);

                                $totalsf = $totalsf + $row['postage'];
                                $totalsf = number_format($totalsf, 2);
                                
                                
                            ?>
          
                            </tbody>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                        <div class="update-box">
                            <input href="cart.php" value="Update Cart" name="update_cart" type="submit">
                        </div>
                    </div>
                
            </div>
                            </form>
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> RM <?php echo $sum;?> </div>
                        </div>
            
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> RM <?php echo $totalsf;?> </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5">RM <?php echo number_format(($sum + $totalsf),2);?> </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.php" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <!-- End Cart -->


    <!-- Start Footer  -->
    
    <?php include('footer.php'); ?>

</body>

</html>

<?php
    }
?>

