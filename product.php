<?php
include("Database/config.php");

?>

<?php
include("include/head.php");
?>

<div>
    <h2 class="name2">All Products</h2>
</div>

<?php

$res = mysqli_query($db, "SELECT *from product");
while ($row = mysqli_fetch_array($res)) {

?>
    <div class="row-sub">

        <div class="write">
            <a href="product/product.php?id=<?php echo $row["Product_ID"];?>">
                <img src="<?php echo $row["Product_Image"];?>" >
                <h4><?php echo $row["Product_NAME"];?></h4>
                <p>Price:$<?php echo $row["Product_Price"];?></p>
            </a>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>

        </div>
</div>
<?php
}
?>



<div class="nxt">

    <ul>
        <li><a href="product.php">1</a></li>
        <li><a href="more.php">2</a></li>
        <li><a href="more.php">4</a></li>
        <li><a href="more.php">&#10146;</a></li>
    </ul>
</div>

<!---------footer--->
<?php
include("include/foot.php")
?>