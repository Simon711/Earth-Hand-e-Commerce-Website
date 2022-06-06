<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
    .button-right {
        float: right;
    }

    .button-right i {
        position: relative;
        margin-top: -7px;
      
    }

    .button-right img {
        width: 20px;
        margin-top: -3px;
    }

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
        require_once("header2.php");
        $email = $_SESSION['UserID'];
    }else{
        include("header1.php");
    }

    ?>


    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Manage Product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Product  -->
    <div class="wishlist-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="add-pr button-right">
                        <a class="btn hvr-hover" href="add-product.php"><img src="images/add.png">
                        
                        &nbsp;&nbsp;&nbsp;Add Product</a>
                    </div>
                    <br><br>
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price </th>
                                    <th>Stock</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Update Product</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Delete Product</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
    
                                    $sql = "SELECT * FROM `tblproduct` a JOIN `tblproduct_image` b ON a.productID = b.productID WHERE productOwner = '".$email."' GROUP BY a.productID";
                                    mysqli_select_db($conn, "id18159895_adproject");
                                    $result = mysqli_query($conn, $sql); //command allows sql command to be sent to mysql
                                    while($row=mysqli_fetch_assoc($result)) {
                            
                                ?>

                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="shop-detail.php?productID=<?php echo $row['productID']; ?>">
									<img class="img-fluid" src="<?php echo $row['image1']; ?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="shop-detail.php?productID=<?php echo $row['productID']; ?>">
                                        <?php echo $row['productName']; ?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>RM <?php echo $row['price']; ?></p>
                                    </td>
                                    <td class="quantity-box"><?php echo $row['stock']; ?></td>
                                    <td class="add-pr">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="btn hvr-hover" href="update-product.php?productID=<?php echo $row['productID']; ?>">Update Details</a>
                                        <!-- <a class="btn hvr-hover" href="#">Update Details</a> -->
                                    </td>
                                    <td class="add-pr">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="btn hvr-hover" href="delete-product.php?productID=<?php echo $row['productID']; ?>"
                                        onclick="return confirm('DO YOU CONFIRM TO DELETE? Y/N')">Delete Product</a> 
                                    </td>		
                                </tr>

                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product -->


    <?php include('footer.php'); ?>
</body>

</html>