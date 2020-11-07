
<?php
include("./Database/config.php");

?>

<?php
include("./include/head.php");
?>

<div class="admin">

    <h2>Admin Dashboard</h2>
    <div class="block">

        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <tr>
                    <td>Product name:</td>
                    <td><input type="text" name="pnm"></td>
                </tr>
                <tr>
                    <td>Product price:</td>
                    <td><input type="text" name="ppr"></td>
                </tr>
               
                <tr>
                    <td>Product Image:</td>
                    <td><input type="file" name="pimg"></td>
                </tr>
                <tr>
                    <td>Product Catagory:</td>
                    <td>
                        <select name="pcat">
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Product Discription:</td>
                    <td><textarea cols="15"rows="10" name="pdes"></textarea></td>
                </tr>
                <tr>
                    
                    <td><button type="submit"  name="admin"><b>Upload</b></button></td>
                </tr>
            </table>


        </form>



    </div>
</div>
<?php
include("./include/foot.php")
?>