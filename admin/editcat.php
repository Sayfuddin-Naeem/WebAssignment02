<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    if(!isset($_GET['editcatid']) || $_GET['editcatid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $catid = $_GET['editcatid'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link,$name);
        $name = $fmt->validation($name);
        if(empty($name)){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        
        $query = "UPDATE tbl_category SET name = '$name' WHERE id = $catid";
        $catupdate = $db->update($query);
        if($catupdate){
            echo "<span class='success'>Category Upadated Successfully !!.</span>";
        }else{
            echo "<span class='error'>Category Not Upadated !!.</span>";
        }
    }
?>

            <form action="editcat.php" method="POST">
                <table class="form">
<?php
    $query = "SELECT * FROM tbl_category WHERE id = '$catid'";
    $editcat = $db->select($query);
    if ($editcat) {
        $editresult = $editcat->fetch_assoc();
?>    
                    <tr>
                        <td>                            
                            <input type="text" name="name" value="<?php echo $editresult['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            
                        </td>
                    </tr>
<?php } else{ ?>                            
                            
             
                    <tr>
                        <td style="text-align: center;">
                            <p class="error">The Category Not Found !! <br> Please try Again.</p>
                        </td>
                    </tr>
<?php }?>                   
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include "inc/footer.php";?>