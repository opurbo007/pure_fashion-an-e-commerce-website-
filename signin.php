<?php
include("Database/config.php");

?>

<?php 
include("include/head.php");
?>

        <!-----Login & Reg form---->

        <div class="account">


            <div class="login">


                <form action="signin.php" method="POST">
                    <h2>Sing In as User</h2>

                    <?php include('Database/errror.php'); ?>

                    <input type="text" name="username" placeholder="Enter Your Username"required>
                    <input type="password" name="password" placeholder=" Enter new Password" required>
                    <button type="submit" name="log"><b>Login</b></button>
                    <a href="./admin_login.php">Login as Admin</a>
                    <p>or</p>
                    <a href="./signup.php">Create new Account</a>
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