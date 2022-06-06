<?php
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');


if (isset($_POST['userid'])){
    $uid=$_POST['userid'];
    $sql="SELECT 1 FROM `id18159895_adproject`.`table_user` WHERE UserID='".$uid."'";
    $result=mysqli_query($conn,$sql);
    $sql2="SELECT * FROM `id18159895_adproject`.`table_user` WHERE UserID='".$uid."'";

    $result2=mysqli_query($conn,$sql2);
    $row=mysqli_fetch_assoc($result2); 
    if(mysqli_num_rows($result)>0)
    { 

        if(isset($_POST['ans'])){
            
            //echo $_POST['ans'];
            $ans=$_POST['ans'];
            $uid=$_POST['userid'];
            $status=questioncheck(trim($uid),trim($_POST['ans']));
            
            
            if($status==1){ ?>
                <!-- echo "correct";
                goto2("login.php","your password is ".$row['Password']); -->
            
                <!-- <h2>Change Password</h2>

                <form action="change_password.php" method="POST">
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" value="<?php echo $uid ?>" readonly><br>
                <label for="new_password">New Password:</label><br>
                <input type="text" id="new_password" name="new_password"><br><br>
                <input type="submit" name="submit" value="Submit">
                </form>  -->

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Earth Hand</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/login.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <style>
            a:hover{
            color:pink;
            }
        </style>
        
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Earth Hand</strong> Reset Password Page</h1>
                            <div class="description">
                            	<p>
                                    powered by <a href="http://azmind.com"><strong style="color:green;">ZHAZHA</strong></a> 
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Reset Password</h3>
                            		<p>Enter your new password to reset:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="change_password.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="email">Username</label>
                                        <input style="color:black;" type="email" name="email" class="form-username form-control" value="<?php echo $uid ?>" readonly>	
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="new_password1">Password</label>
                                        <input style="color:black;" type="password" name="new_password1" class="form-password form-control" placeholder="New Password..">
			                        </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="new_password2">Password</label>
                                        <input style="color:black;" type="password" name="new_password2" class="form-password form-control" placeholder="Confirm New Password..">
			                        </div>
			                        <button type="submit" name="submit" class="btn">Reset Password</button>
                                    <hr>
                                    <div style="color:white;">
                                        Already have an account?
                                        <a href="login.php">Click</a> here to login
                                        </div>
                                    <div style="color: white;">
                                        New member?
                                        <a href="register.php">Register</a> here
                                        <br>
                                    <!--    Forgot Password?
                                        <a href="forgotpw.php">Click</a> here -->
                                    </div>
			                    </form>
                                
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>

            <?php }
            else{
                //echo "wrong";
                goto2("forgotpw.php","Wrong answer");
            }
        }else{
           
            $sql2="SELECT * FROM `id18159895_adproject`.`table_user` WHERE UserID='".$uid."'";
        
            $result2=mysqli_query($conn,$sql2);
            $row=mysqli_fetch_assoc($result2); 
            include("register.html");
        ?>
        <style>
                a:hover{
                color:pink;
                }
            </style>
        <body>
        
            <!-- Top content -->
            <div class="top-content">
                
                <div class="inner-bg">
                    <div class="container">
                        <div class="row">
                        <div class="coverpic">
                            <img src="images/logo.png" alt="cover photo" width="400" height="120">
                        </div>
                            <div class="col-sm-8 col-sm-offset-2 text">
                                
                                <div class="description">
                                    <p>
                                    powered by <a href="http://azmind.com"><strong style="color:green;">ZHAZHA</strong></a> 
                                    </p>
                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Forgot Password?</h3>
                                        <p>Please answer the following question:</p>
                                    </div>
                                    <div class="form-top-right">
                                        
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group" >
                                            <label class="sr-only" for="form-username">Email:</label>
                                            
                                            <input style="color:black;" type="hidden" name="userid" class="form-username form-control"  value="<?php echo $uid;?>">
                                            
                                        </div>
                                        <div class="form-group" style="color:white;">
                                        <label class="sr-only" for="form-username" >Security Question:</label>
                                        Security Question: 
                                        <br>
                                        <select class="form-username form-control" style="color:black;" name="securityquestion" >
                                        
                                    <?php
                                        $sql ="select * from security_question";  // sql command
                                        mysqli_select_db($conn,"id18159895_adproject"); ///select database as default
                                        $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
        
                                        while( $rowquestion=mysqli_fetch_assoc($result)) {   ?> 
                                               
                                            <?php 
                                            if($row["questionID"]==$rowquestion['questionID']){
                                                $id=$rowquestion['questionID'];
                                                $str=$rowquestion['question'];
                                                echo "Selected";
                                                break;?>
                                            
                                            <?php echo $rowquestion['question'];?>
                                            <?php
                                            
                                            break;
                                            }
                                            ?>
         
                                        <?php }  ?>
                                        <option  value="<?php echo $id;?>">
                                        <?php echo $str;?>
                                        </option>
                                    </select>
                                        </div>
                                        <div class="form-group" style="color:white;">
                                            <label class="sr-only" for="form-username">Answer:</label>
                                            Answer: 
                                            <input style="color:black;" type="text" name="ans" class="form-username form-control"  placeholder="Answer.." required>
                                            
                                        </div>
                                        
                                        <button type="submit" class="btn">Submit</button>
                                        <hr>
                                        <div style="color:white;">
                                        Already have an account?
                                        <a href="login.php">Click</a> here to login
                                        </div>
                                        <div style="color: white;">
                                        New member?
                                        <a href="register.php">Register</a> here
                                        </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
                
            </div>
        
            <!-- Javascript -->
            <script src="assets/js/jquery-1.11.1.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <script src="assets/js/jquery.backstretch.min.js"></script>
            <script src="assets/js/scripts.js"></script>
            
            <!--[if lt IE 10]>
                <script src="assets/js/placeholder.js"></script>
            <![endif]-->
        
        </body>
        <?php
        }
        
    
    }
    else{
        goto2("forgotpw.php","E-mail not exist");
    }

} else {
    include("register.html");
    ?>

<style>
            a:hover{
            color:pink;
            }
        </style>
    <body>
            
        <!-- Top content -->
        <div id="pw1" class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                    <div class="coverpic">
                            <img src="images/logo.png" alt="cover photo" width="400" height="120">
                        </div>
                        <div class="col-sm-8 col-sm-offset-2 text">
                            
                            <div class="description">
                            	<p>
                                powered by <a href="http://azmind.com"><strong style="color:green;">ZHAZHA</strong></a> 
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Forgot Password?</h3>
                            		<p>Enter your E-mail:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<!--<i class="fa fa-lock"></i>-->
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group" style="color:white;">
			                    		<label class="sr-only" for="email">Email</label>
                                        E-mail:
                                        <input type="email" name="userid" class="form-username form-control"  placeholder="Enter your E-mail" required>
			                        	
			                        </div>
                                    <button type="submit" class="btn">Submit</button>
                                    <hr>
			                        <div style="color:white;">
                                        Already have an account?
                                        <a href="login.php">Click</a> here to login
                                        </div>
                                        <div style="color: white;">
                                        New member?
                                        <a href="register.php">Register</a> here
                                        </div>
                                    </div>
                                    
			                    </form>
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>
<?php
}
?>
