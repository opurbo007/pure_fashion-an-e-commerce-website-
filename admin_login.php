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
                    <h2>Sing In  As Admin</h2>

                    <input type="text" name="username" placeholder="Enter Your Username"required>
                    <input type="password" name="password" placeholder=" Enter new Password" required>
                    <button type="submit" name="admin_log"><b>Login</b></button>
                    <a href="./signin.php">Login as User</a>
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