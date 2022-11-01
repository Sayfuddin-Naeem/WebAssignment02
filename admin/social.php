<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fb = mysqli_real_escape_string($db->link,$_POST['fb']);
        $tw = mysqli_real_escape_string($db->link,$_POST['tw']);
        $ln = mysqli_real_escape_string($db->link,$_POST['ln']);
        $ggp = mysqli_real_escape_string($db->link,$_POST['ggp']);
        $fb = $fmt->validation($fb);
        $tw = $fmt->validation($tw);
        $ln = $fmt->validation($ln);
        $ggp = $fmt->validation($ggp);

        if($fb == "" || $tw == "" || $ln == "" || $ggp == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        
        else{
            $sqlUpsocial = "UPDATE tbl_social
                                SET
                                fb    = '$fb',
                                tw    = '$tw',
                                ln= '$ln',
                                ggp  = '$ggp'
                                WHERE id = '1'";
            $socialupdate = $db->update($sqlUpsocial);
            if($socialupdate){
                echo "<span class='success'>Data Updated Successfully !!.</span>";
            }else{
                echo "<span class='error'>Data Not Updated !!.</span>";
            }
        }
    }
?>
                <div class="block">
                
<?php 
    $sqlsocaial = "SELECT * FROM tbl_social WHERE id = '1'";
    $socialmedia = $db->select($sqlsocaial);
    if($socialmedia){
        while($socialResult = $socialmedia->fetch_assoc()){
?>                
                 <form action="social.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $socialResult['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $socialResult['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $socialResult['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="ggp" value="<?php echo $socialResult['ggp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
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