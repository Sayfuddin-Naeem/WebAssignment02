<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $note = $_POST['note'];
        $note = mysqli_real_escape_string($db->link,$note);
        $note = $fmt->validation($note);
        if(empty($note)){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }else{
            $footerUpsql = "UPDATE tbl_footer SET note = '$note' WHERE id = '1'";
            $footerUpdate = $db->update($footerUpsql);
            if($footerUpdate){
                echo "<span class='success'>Category Upadated Successfully !!.</span>";
            }else{
                echo "<span class='error'>Category Not Upadated !!.</span>";
            }
        }
    }
?>
                <div class="block copyblock">
<?php 
    $sqlfooter = "SELECT * FROM tbl_footer WHERE id = '1'";
    $footer = $db->select($sqlfooter);
    if($footer){
        while($footerResult = $footer->fetch_assoc()){
?>
                 <form action="copyright.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $footerResult['note'];?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php }}?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include "inc/footer.php";?>