<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');

$email = $_SESSION['UserID'];
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
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
    .add-product-main {
        background: #ebebeb;
        padding: 20px 220px;
    }

    input[type="file"] {
        background: white;
        width: 100%;
    }

    .add-pr input {
        width:100px; 
        color: white; 
        font-weight: 700;
    }

    .add-pr input:hover {
        background: black;
    }

</style>
</head>

<body>

    <?php include('header2.php'); ?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Add Product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="product-home.php">Manage Product</a></li>
                        <li class="breadcrumb-item active">Add Product </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <?php
        $number=1;
        
        if(isset($_POST['prname']) && isset($_POST['price'])) {
            
            $prname=mysqli_real_escape_string($conn, $_POST['prname']);
            $price=$_POST['price'];
            $prcategory2=$_POST['prcategory2'];
            //$prcategory1 = filter_input(INPUT_POST, 'prcategory2', FILTER_DEFAULT);
            $sql_cat1="SELECT categoryID FROM tblproduct_category2 WHERE categoryID2 = '".$prcategory2."'";
            mysqli_select_db($conn, "id18159895_adproject");
            $result_cat1=mysqli_query($conn, $sql_cat1);
            $row_cat1=mysqli_fetch_assoc($result_cat1);
            $prcategory1=$row_cat1['categoryID'];

            $brand=mysqli_real_escape_string($conn, $_POST['brand']);
            $shipsfrom=mysqli_real_escape_string($conn, $_POST['shipsfrom']);
            $postage=$_POST['postage'];
            $prbox=mysqli_real_escape_string($conn, $_POST['prbox']);
            $prdesc=mysqli_real_escape_string($conn, $_POST['description']);

            $check = "SELECT * FROM `tblproduct`";
            mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
            $c=mysqli_query($conn,$check);
            while($rowB=mysqli_fetch_assoc($c)) {
                if($rowB['productID'] == $number) {
                    $number++;
                }
            }

            $sql ="INSERT INTO `id18159895_adproject`.`tblproduct` (`productID`, `productName`, `price`, `productCategory1`, `productCategory2`, `productBrand`, `productOrigin`, `postage`, `productBox`, `productDescription`, `productOwner`) 
            VALUES ('".$number."', '".$prname."', '".$price."', '".$prcategory1."', '".$prcategory2."', '".$brand."', '".$shipsfrom."', '".$postage."', '".$prbox."', '".$prdesc."', '".$email."')";  // sql command
            mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
            $result=mysqli_query($conn, $sql);   

            // upload product images
            $target_dir = "products/".$number."/";
            if(!file_exists($target_dir))  mkdir($target_dir, 0777, true);
            $allowTypes = array('jpg','png','jpeg','gif'); 
            for ($i = 0; $i < count($_FILES['primages']['name']); $i++) {
                $status = 1;
                $target_file = $target_dir . basename($_FILES['primages']['name'][$i]);       
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if (file_exists($target_file)) {
                    alert1("Sorry, file already exists.");
                    $status = 0;
                }
                if ($_FILES['primages']['size'][$i] > 500000) {
                    alert1("Sorry, your file is too large.");
                    $status = 0;
                }
                if(!in_array($imageFileType, $allowTypes)) {
                    alert1("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $status = 0;
                }

                if ($status == 0) {
                    $sqldel1 = "DELETE FROM tblproduct WHERE productID = '".$number."'";
                    mysqli_select_db($conn,"id18159895_adproject"); 
                    $resultdel1=mysqli_query($conn, $sqldel1);
                    
                    foreach(scandir($target_dir) as $file) {
                        if ('.' === $file || '..' === $file) continue;
                        if (is_dir("$target_dir/$file")) rmdir_recursive("$target_dir/$file");
                        else unlink("$target_dir/$file");
                    }
                    rmdir($target_dir);

                    alert1("Sorry, your file was not uploaded.");
                } else {
                    // if everything is ok, try to upload file
                    if (move_uploaded_file($_FILES['primages']['tmp_name'][$i], $target_file)) {
                        $no = 1;
                        $check = "SELECT * FROM `tblproduct_image`";
                        mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
                        $c=mysqli_query($conn,$check);
                        while($rowB=mysqli_fetch_assoc($c)) {
                            if($rowB['imageID'] == $no) {
                                $no++;
                            }
                        }

                        $sqlimg ="INSERT INTO `id18159895_adproject`.`tblproduct_image` (`productID`, `image1`, `imageID`)
                        VALUES ('".$number."', '".$target_file."', '".$no."')";
                        mysqli_select_db($conn,"id18159895_adproject"); 
                        $imgresult=mysqli_query($conn, $sqlimg);
                        echo $imgresult['image1'];

                        goto2("product-home.php", "Your product has been successfully added.");

                    } else {
                        alert1("Sorry, there was an error uploading your file.");
                    }
                }
            }
        } else {
            
    ?>

    <div class="add-product-main">
        <div class="container">
            <form name="addProductForm" action="add-product.php" method="POST" enctype="multipart/form-data">
                <br>
            
                <div class="form-group">
                    <label for="Product Name">Product Name:</label>
                    <input type="text" class="form-control" id="prname" name="prname" required><br>
                </div>

                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="text" class="form-control" id="price" name="price" required><br>
                </div>

                <div class="form-group">
                    <label for="Product Category">Product Category:</label><br>
                    <select name="prcategory2" id="prcategory2" class="form-control" required>
                    <option value="0"> Select the Category</option>
                    <?php 
                        $prcategoryid1 = $_GET['categoryID'];
                        $sql1 ="select * from `tblproduct_category2`";
                        mysqli_select_db($conn, "id18159895_adproject");//select database as default
                        $result1 = mysqli_query($conn, $sql1); // this command sql cmd to sent to mysql
                    
                        while($row=mysqli_fetch_assoc($result1)) { ?>

                            <option value="<?php echo $row['categoryID2']; ?>"> <?php echo $row['productCategory2']; ?></option>
                            
                        <?php } ?>
                        
                    </select><br>
                </div>


                <div class="form-group">
                    <label for="Brand">Brand:</label>
                    <input type="text" class="form-control" id="brand" name="brand" required><br>
                </div>

                <div class="form-group">
                    <label for="Ships From">Ships From:</label>
                    <input type="text" class="form-control" id="shipsfrom" name="shipsfrom" placeholder="City, State" required><br>
                </div>

                <div class="form-group">
                    <label for="Shipping Fees">Shipping Fees:</label>
                    <input type="text" class="form-control" id="postage" name="postage" required><br>
                </div>

                <div class="form-group">
                    <label for="What's In The Box?">What's In The Box?:</label>
                    <textarea class="form-control" id="prbox" name="prbox"
                    placeholder="Tell us what you would include in the parcel." rows="3" cols="50" required></textarea><br>
                </div>
                
                <div class="form-group">
                    <label for="Description">Short Description:</label>
                    <textarea class="form-control" id="description" name="description" 
                    placeholder="Provide a short description for your product." rows="8" cols="50" required></textarea><br>
                </div>

                <div class="form-group">
                    <!-- <label for="Images">Upload your product images:</label> -->
                    <label class="btn-choosefile">Upload your product images:<br><input type="file" name="primages[]" id="primages" multiple required/></label>

                    <!-- <input class="form-control" type="file" name="primages[]" id="primages" multiple required> -->
                </div>
                
                <br><br>
                <div class="add-pr">
                    <input class="btn hvr-hover" type='submit' name='submit' value='Submit' onclick="checkField()">
                    &nbsp;
                    <input class="btn hvr-hover" type="reset" value="Clear">
                    <a href="product-home.php">
                        <input type="button" class="btn hvr-hover" style="float: right;" value="Back">
                    </a>
                </div>

            </form>
        </div>
        <?php } ?>
    </div>

    <?php include('footer.php'); ?>   


</body>

</html>