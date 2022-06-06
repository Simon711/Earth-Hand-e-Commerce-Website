<?php 
// require_once('connection.php'); 
// session_start();
require_once('config/settings.php');
require_once('config/db.php');
require_once('config/function.php');
require_once('config/session.php');

// echo "username:".$_SESSION['uname']."";
// echo "<br>";
// echo"uid:".$_SESSION['uid']."";
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- Site CSS -->
<link rel="stylesheet" href="css/style.css">
<style>

.qna-container
{
  border-top-style: solid;
  border-right-style: none;
  border-bottom-style: solid;
  border-left-style: none;
  border-color:#8B4513;
  height : 50%;
  background: none;
  margin : auto;
  overflow: scroll;
}

#askBu
{
    margin-top: 25px;
    padding :10px;  
    float : right;
    background-color: #ccbca2;
    border: none;
    color: white; 
    display: inline-block;
    font-size: 16px;
    cursor: pointer;

}

#askBu:hover , #myBtn:hover
{
    background-color: red;
}

#myBtn
{ 
    padding :10px;  
 
    background-color: black;
    border: none;
    color: white; 
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}



div.accordion {
    background-color: #ccbca2;
    color: #444;
    cursor: pointer;
    padding: 18px;
    text-align: left;
    border: none;
    outline: none;
    transition: 0.4s; 
    border-radius :10px;
    font-size: 18px; 
}

/* Add a background color to the accordion if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
div.accordion.active, div.accordion:hover {
    background-color: #ddd;
}

/* Unicode character for "plus" sign (+) */
div.accordion:after {
    content: '\2795';  
    color: #777;
    float: right;
    margin-left: 5px;
}

/* Unicode character for "minus" sign (-) */
div.accordion.active:after {
    content: "\2796"; 
}

/* Style the element that is used for the panel class */

p.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.4s ease-in-out;
    opacity: 0;
    margin-bottom:10px;
}

p.panel.show {
    opacity: 1;
    max-height: 1000px; /* Whatever you like, as long as its more than the height of the content (on all screen sizes) */
}

.qna-header
{
    background-color: #ccbca2;
    padding: 10px;
    style : bold;
}


</style>

</head>

<body>


    <div class="qna-container">
        <p>You can ask your question here</p>
        <button id="askBu"  onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">I Want to Ask !!! </button> 
        <!-- <h1>QNA SECTION</h1> -->
        

        <hr> <!--中间线-->

        <!--table-->
       
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <?php
                        $con = mysqli_connect("localhost", "root", "", "id18159895_adproject");
                        $sql = "select * from qna where productID = '".$productID."'";
                        $que = mysqli_query($con, $sql);

                        while( $row = mysqli_fetch_array($que) ) {
                            
                    ?>
                    <br>
                    <div class="accordion">
                    <i class="fa fa-question-circle" style="font-size:25px;color:red"></i>
                       
                        <?php echo $row['question']; 
                        $questionid = $row['questionID'];?>
                        <button id = "myBtn" onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">Answer</button> <!--我要回答--> 
                    </div>    

                    <p class = "panel">
                        <i class="fa fa-commenting" style="font-size:25px;color:green"></i>
                       
                        <?php echo $row['answer']; 
                        
                        ?>
                    </p> 
                    <?php } ?> <!--line 66的//} -->
                </div>
            </div>
    </div>
   

<!--model add question-->

<div id="id01" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4">
      <header class="qna-header"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h2>Please Post Your Question Here !!! </h2>
      </header>
      <div class="w3-container">
      <form method="POST" action="qnaadd_que.php?productID=<?php echo $productID; ?>" >   
      <?php if(isset($smsg)){ ?><div class="alert-success" role="alert"> 
      <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> 
      <?php echo $fmsg; ?> </div><?php } ?>	
      
   	  <label for="question"><br>
      <textarea rows="3" cols="90" type="text" placeholder="Post Your Question Here" name="question" required></textarea>
      <br> 
      <input type='submit' name='Submit' value='Submit' style="width:10%" class="button" >
      <!--class="btn btn-primary"--> &nbsp
      <input type="reset" style="width:10%" class="button1"  value="Clear">
      
      </form>
      </div>
    
    </div>
  </div>



  <div id="id02" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4">
      <header class="qna-header"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h2>Please Post Your Answer Here !!! </h2>
      </header>
      <div class="w3-container">
      <form method="POST" action="qnaadd_ans.php?productID=<?php echo $productID; ?>&questionID=<?php echo $questionid; ?>" >   
      <?php if(isset($smsg)){ ?><div class="alert-success" role="alert"> 
      <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> 
      <?php echo $fmsg; ?> </div><?php } ?>	
      
   	  <label for="answer"><br>
      <textarea rows="3" cols="90" type="text" placeholder="Post Your Answer Here" name="answer" required></textarea>
      <br> 
      <input type='submit' name='Submit' value='Submit' style="width:100px" class="button" >
      <!--class="btn btn-primary"--> &nbsp
      <input type="reset" style="width:100px" class="button1" style="width:100px" value="Clear">
      
      </form>
      </div>
    
    </div>
  </div>



<script>
document.addEventListener("DOMContentLoaded", function(event) { 


var acc = document.getElementsByClassName("accordion");
var panel = document.getElementsByClassName('panel');

for (var i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
        var setClasses = !this.classList.contains('active');
        setClass(acc, 'active', 'remove');
        setClass(panel, 'show', 'remove');

        if (setClasses) {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
}

function setClass(els, className, fnName) {
    for (var i = 0; i < els.length; i++) {
        els[i].classList[fnName](className);
    }
}

});
</script>


</body>
</html>
