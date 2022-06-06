<?php
require_once ("config/settings.php");
$sql = "SELECT * FROM `product`";
$result = mysqli_query($conn, $sql);
mysqli_select_db($conn,"id18159895_adproject");
while($row=mysqli_fetch_assoc($result)){
?>

<div>
    <div>
        <a href="#"><img src="images/<?php echo $row['product_image']; ?>" width="400px" height="200px" alt="image"></a>
    
        <div>
            <h4><?php echo $row['product_name']?></h4>
            <h5><?php echo number_format($row['product_price'],2); ?>/-</h5>
        </div>
    
        <div>
            <form action="">
                <input type="hidden" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" value="<?php echo $row['product_code']; ?>">
                <button >Add to cart</button>
            </form>
        </div>
    </div>


</div>


<?php
}
?>