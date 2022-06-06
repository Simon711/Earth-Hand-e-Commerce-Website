<?php

function goto2 ($to,$Message){
	echo "<script language=\"JavaScript\">alert(\"".$Message."\") \n window.location = \"".$to."\"</script>";
}

function alert1 ($str){
	print "<script>alert(\"".$str."\")</script>";
}

function logincheck($u,$p){
    include('variable.php');
    $conn=new mysqli($servername,$user,$passw);
    mysqli_select_db($conn,"id18159895_adproject");
    $sql=" SELECT count(UserID) as L FROM `table_user`  where UserID='".$u."'  and Password='".$p."'";
    //echo $sql;
    $stmt = mysqli_query($conn,$sql);
    if ($stmt===false){
       // return 0;
    }
    $row=mysqli_fetch_assoc($stmt); //i can call L or i can call using mysqli_fetch_row ,
    // when call $row[0]x 
    //echo $row[0];
    if ($row['L']==1){
        return 1;
    } 
    else {
        return 0;
    }
}

function hold($uid){
    
    include("forgotpw2.php");
}

function countCart($u){
    include('variable.php');
    $conn=new mysqli($servername,$user,$passw);
    mysqli_select_db($conn,"id18159895_adproject");
    $sql=" SELECT count(cartID) as L FROM `tbl_cart`  where UserID='".$u."'";
    //echo $sql;
    $stmt = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($stmt);
    return $row['L'];
}

function questioncheck($u,$ans){
    include('variable.php');
    $conn=new mysqli($servername,$user,$passw);
    mysqli_select_db($conn,"id18159895_adproject");
    $sql=" SELECT count(UserID) as L FROM `table_user`  where UserID='".$u."'  and answer='".$ans."'";
    //echo $sql;
    $stmt = mysqli_query($conn,$sql);
    if ($stmt===false){
       // return 0;
    }
    $row=mysqli_fetch_assoc($stmt); //i can call L or i can call using mysqli_fetch_row ,
    // when call $row[0]x 
    //echo $row[0];
    if ($row['L']==1){
        return 1;
    } 
    else {
        return 0;
    }
}

function checkUType($u,$type=1){
    include('variable.php');
        $conn=new mysqli($servername,$user,$passw);
        mysqli_select_db($conn,"id18159895_adproject");
        $sql=" SELECT
        table_category.Interface,table_category.UserType,table_user.fName
        FROM
        table_category
        INNER JOIN table_user ON table_user.UserType = table_category.UserType
         where UserID='".$u."' ";
         $result=mysqli_query($conn,$sql);
        $rowtype=mysqli_fetch_assoc($result);
        //echo $sql;
        if ($type==1){
            return $rowtype['UserType'];
        }else if ($type==2)
        {
            return $rowtype['Interface'];
         }
         else      if ($type==3){
        return $rowtype['fName'];
        }
};

function display($destination, $message){
    echo "<script> language=\"JavaScript\">alert(\"".$message."\") \n window.location = \"".$destination. "\"</script>";
}

?>