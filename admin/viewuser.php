<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    if(!isset($_GET['userid']) || $_GET['userid'] == NULL){
        echo "<script>window.location = 'userlist.php';</script>";
    }else{
        $userid = $_GET['userid'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>User Details</h2>
        <div class="block">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<script>window.location = 'userlist.php';</script>";
    }
?>
            <form action="" method="POST">
                <table class="form">
<?php
    $userSql = "SELECT * FROM tbl_user WHERE id = '$userid'";
    $getUser = $db->select($userSql);
    if ($getUser) {
        $userResult = $getUser->fetch_assoc();
?> 

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $userResult['name'];?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $userResult['username'];?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $userResult['email'];?>" class="medium msg" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="msgtext msg" readonly><?php echo $userResult['details'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="OK" />
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