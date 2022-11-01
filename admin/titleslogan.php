<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
    <div class="grid_10">
    
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>

<?php 
    $sqlslogan = "SELECT * FROM tbl_slogan WHERE id = '1'";
    $sloganLogo = $db->select($sqlslogan);
    if($sloganLogo){
        while($sloganResult = $sloganLogo->fetch_assoc()){
?>
        <div class="block sloginblock">
            <div class="leftside">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $title = $fmt->validation($title);
        $slogan = mysqli_real_escape_string($db->link,$_POST['slogan']);
        $slogan = $fmt->validation($slogan);

        $permited  = array('png');
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $same_logo = 'Logo'.'.'.$file_ext;
        $uploaded_logo = "../images/logo/".$same_logo;

        if($title == "" || $slogan == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        } else{
            if($file_name){
                if ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } 
                elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } 
                else{
                    move_uploaded_file($file_temp, $uploaded_logo);
                    $sqlUpSlogan = "UPDATE tbl_slogan
                                    SET title  = '$title', slogan = '$slogan',
                                    logo   = '$uploaded_logo' WHERE id = '1'";
                                    
                    $upSlogan = $db->update($sqlUpSlogan);
                    if($upSlogan){
                        echo "<span class='success'>Data Updated Successfully !!.</span>";
                    }else{
                        echo "<span class='error'>Data Not Updated !!.</span>";
                    }
                }
            } else{
                $sqlUpSlogan = "UPDATE tbl_slogan
                                    SET
                                    title  = '$title',
                                    slogan = '$slogan'
                                    WHERE id = '1'";
                $upSlogan = $db->update($sqlUpSlogan);
                if($upSlogan){
                    echo "<span class='success'>Data Updated Successfully !!.</span>";
                }else{
                    echo "<span class='error'>Data Not Updated !!.</span>";
                }
            }
        
        }
    }
?>
                <form action="titleslogan.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $sloganResult['title']; ?>" name="title" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $sloganResult['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" class="medium" />
                            </td>
                        </tr>
                            
                        
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
                <div class="rightside">
                    <img src="<?php echo $sloganResult['logo']; ?>" alt="logo">
                </div>
            </div>
<?php }}?>
        </div>
    </div>
    <div class="clear">
    </div>
</div>
<?php include "inc/footer.php";?>