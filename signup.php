<?php
include("Database/config.php");

?>
<?php
include("include/head.php");
?>
<!-----Reg form---->

<div class="account">


    <div class="login">


        <form action="signup.php" method="post">

        <?php include('Database/errror.php'); ?>
     
            <h2>Sing Up</h2>
            <input type="text" name="username" placeholder="Your Username"required>
            <input type="email" name="email" placeholder=" Enter your E-mail"required>
            <input type="number" name="phone" placeholder=" Enter your Number"required>
            <input type="text" name="address" placeholder="Enter your Address"required>
            <input type="password" name="password_1" placeholder=" Enter new Password"required> 
            <input type="password" name="password_2" placeholder=" Re-Enter Password" required>
            <button type="submit" name="reg" value="submit"><b>Register</b></button>

            <a href="./signin.php">Already have an account?</a>
        </form>
    </div>
    <div>

        <img src="img/cover.jpg">
    </div>


</div>

<!---------footer--->
<?php
include("include/foot.php")
?>