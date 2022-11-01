<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    $userid   = Session::get('userId');
    $userrole = Session::get('userRole');
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Profile</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name     = $fmt->validation($name);
        $username = $fmt->validation($username);
        $email    = $fmt->validation($email);
        $details  = $fmt->validation($details);
        $name     = mysqli_real_escape_string($db->link,$_POST['name']);
        $username = mysqli_real_escape_string($db->link,$_POST['username']);
        $email    = mysqli_real_escape_string($db->link,$_POST['email']);
        $details  = mysqli_real_escape_string($db->link,$_POST['details']);
        

        if($name == "" || $username == "" || $email == "" || $details == ""){
            echo "<span class='error'>Field must not be empty !!.</span>";
        }
        else{
            $userUp = "UPDATE tbl_user
                        SET 
                        name     = '$name', 
                        username = '$username', 
                        email    = '$email', 
                        details  = '$details'
                        WHERE id = '$userid'";
            $userDataUp = $db->update($userUp);
            if($userDataUp){
                echo "<span class='success'>User Data Updated Successfully !!.</span>";
            }else{
                echo "<span class='error'>User Data Not Updated !!.</span>";
            }
        
        }
    }
?>
            <form action="" method="POST">
                <table class="form">
<?php
    $userSql = "SELECT * FROM tbl_user WHERE id = '$userid' AND role = '$userrole'";
    $getUser = $db->select($userSql);
    if ($getUser) {
        $userResult = $getUser->fetch_assoc();
?> 

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $userResult['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $userResult['username'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?php echo $userResult['email'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="details" ><?php echo $userResult['details'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
<?php } else{ ?>                            
                    <tr>
                        <td style="text-align: center;">
                            <p class="error">User Data Not Found !! <br> Please try Again.</p>
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